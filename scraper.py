import requests
from bs4 import BeautifulSoup
import json
import string
import re
import time

BASE_URL = "https://ratemyserver.net/index.php"

def get_soup(url, params=None):
    """Fetches a webpage and returns a BeautifulSoup object."""
    try:
        time.sleep(0.1)
        response = requests.get(url, params=params, timeout=15)
        response.raise_for_status()
        return BeautifulSoup(response.text, 'html.parser')
    except requests.exceptions.RequestException as e:
        print(f"Error fetching {url} with params {params}: {e}")
        return None

def parse_item_page(soup):
    """Parses an item's detail page using regex on the text content."""
    item_data = {}

    # Get name from the <title> tag for reliability
    title_tag = soup.find('title')
    if title_tag:
        item_data['name'] = title_tag.text.split('-')[0].strip()

    text = soup.get_text(separator='|')

    # Aggressively clean the text
    text = re.sub(r'[\r\n\t]+', '', text) # Remove newlines and tabs
    text = re.sub(r'\|(\s*\|)+', '|', text) # Collapse multiple pipes

    # Item ID
    id_match = re.search(r'Item ID# (\d+)', text)
    if id_match:
        item_data['item_id'] = int(id_match.group(1))
    else:
        return None # Can't proceed without an ID

    # Regex for fields that follow the "|Label|Value|" pattern
    fields_to_extract = ["Type", "Class", "Buy", "Sell", "Weight", "Pre/Suffix", "Required Lvl", "Applicable Jobs"]
    for field in fields_to_extract:
        match = re.search(rf'\|{re.escape(field)}\|([^|]+)\|', text)
        if match:
            key = field.lower().replace(' ', '_').replace('/', '_')
            value = match.group(1).strip()
            item_data[key] = value

    # Item Script and Description are between two known labels
    script_desc_text = re.search(r'Description\|(.*)\|Dropped By', text, re.DOTALL)
    if script_desc_text:
        script_desc_text = script_desc_text.group(1)

        desc_match = re.search(r'(.*)\|Item Script', script_desc_text)
        if desc_match:
            item_data['description'] = desc_match.group(1).replace('|', ' ').strip()

        script_match = re.search(r'Item Script\|(.*)', script_desc_text)
        if script_match:
            item_data['item_script'] = script_match.group(1).replace('|', ' ').strip()


    # Dropped By
    dropped_by_match = re.search(r'\|Dropped By\|(.*?)\|back to top', text, re.DOTALL)
    if dropped_by_match:
        monsters_text = dropped_by_match.group(1).replace('|', ' ').strip()
        # Find all monster names and their drop rates
        monsters = re.findall(r'([a-zA-Z\s/]+)\((\d+\.\d+%)\)', monsters_text)
        if monsters:
            item_data['dropped_by'] = [{'name': name.strip(), 'rate': rate} for name, rate in monsters]

    return item_data

def test_parse_single_page():
    """Fetches and parses a single known item page for debugging."""
    print("--- Running single page test ---")
    test_url = "https://ratemyserver.net/index.php?page=re_item_db&item_id=4140"
    soup = get_soup(test_url)
    if soup:
        item_data = parse_item_page(soup)
        print("--- Test Page Parse Result ---")
        print(json.dumps(item_data, indent=2))
        print("------------------------------")
        if item_data and item_data.get('name') == 'Abysmal Knight Card' and item_data.get('type') == 'Card' and item_data.get('class') == 'Weapon Card':
            print("Single page test PASSED.")
            return True
        else:
            print("Single page test FAILED.")
            return False
    else:
        print("Failed to fetch test page.")
        return False

def main():
    """Main function to scrape all items."""
    if not test_parse_single_page():
        print("Aborting scrape due to failed test.")
        return

    item_urls = set()
    print("\nCollecting all item URLs...")

    for letter in string.ascii_lowercase:
        print(f"Scanning letter '{letter}'...")
        page_num = 1
        while True:
            params = {'page': 'item_db', 'list': 1, 'letter': letter, 'page_num': page_num}
            soup = get_soup(BASE_URL, params)
            if not soup: break

            links_on_page = soup.find_all('a', href=re.compile(r'page=(re_)?item_db&item_id='))
            if not links_on_page: break

            for a in links_on_page:
                item_urls.add(f"https://ratemyserver.net/{a['href']}")

            next_page_link = soup.find('a', string='>')
            if not next_page_link: break

            page_num += 1

    print(f"Found {len(item_urls)} unique item URLs. Now scraping details...")
    all_items = []
    for i, full_url in enumerate(list(item_urls)):
        print(f"Scraping item {i+1}/{len(item_urls)}: {full_url}")
        item_soup = get_soup(full_url)
        if item_soup:
            item_data = parse_item_page(item_soup)
            if item_data:
                all_items.append(item_data)

    with open('item_db.json', 'w') as f:
        json.dump(all_items, f, indent=4)

    print(f"\nScraping complete. Successfully scraped {len(all_items)} items.")
    print("Data saved to item_db.json")

if __name__ == '__main__':
    main()
