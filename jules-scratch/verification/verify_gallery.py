from playwright.sync_api import sync_playwright

def run(playwright):
    browser = playwright.chromium.launch()
    page = browser.new_page()
    page.goto("http://localhost:5173/gallery")

    # Click on the first thumbnail
    page.locator(".thumbnail").first.click()

    # Wait for the modal to be visible
    page.wait_for_selector(".modal", state="visible")

    page.screenshot(path="jules-scratch/verification/gallery.png")
    browser.close()

with sync_playwright() as playwright:
    run(playwright)
