#!/usr/bin/env python
from playwright.sync_api import Page, expect

def test_auth_pages(page: Page):
    print("Navigating to login page...")
    page.goto("http://localhost:5173/login")
    print("Login page loaded.")
    expect(page).to_have_title("Log in to your account")
    print("Taking login page screenshot...")
    page.screenshot(path="jules-scratch/verification/login.png")
    print("Login page screenshot taken.")

    print("Navigating to register page...")
    page.goto("http://localhost:5173/register")
    print("Register page loaded.")
    expect(page).to_have_title("Create an account")
    print("Taking register page screenshot...")
    page.screenshot(path="jules-scratch/verification/register.png")
    print("Register page screenshot taken.")
