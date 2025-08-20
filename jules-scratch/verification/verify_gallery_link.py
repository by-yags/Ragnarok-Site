from playwright.sync_api import Page, expect

def test_gallery_link_on_login_page(page: Page):
    """
    This test verifies that the 'Gallery' link on the login page is correct.
    """
    # 1. Arrange: Go to the login page.
    # The dev server should be running on localhost. I'll try port 3000, a common default.
    page.goto("http://localhost:3000/login")

    # 2. Act: Find the "Gallery" link.
    gallery_link = page.get_by_role("link", name="Gallery")

    # 3. Assert: Confirm the link is correct.
    # The href should be '/gallery'.
    expect(gallery_link).to_have_attribute("href", "/gallery")

    # 4. Screenshot: Capture the final result for visual verification.
    page.screenshot(path="jules-scratch/verification/login_page_with_gallery_link.png")
