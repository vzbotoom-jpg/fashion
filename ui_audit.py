import asyncio
from playwright.async_api import async_playwright
import os

async def run_audit():
    async with async_playwright() as p:
        browser = await p.chromium.launch()
        context = await browser.new_context()
        page = await context.new_page()

        # Viewports
        viewports = {
            "desktop": {"width": 1280, "height": 800},
            "tablet": {"width": 768, "height": 1024},
            "mobile": {"width": 375, "height": 667}
        }

        # Pages to audit (corrected URLs based on route:list)
        pages = {
            "home": "http://127.0.0.1:8000/",
            "products": "http://127.0.0.1:8000/products",
            "product_detail": "http://127.0.0.1:8000/products/celana-jeans-slim",
            "cart": "http://127.0.0.1:8000/customer/cart",
            "checkout": "http://127.0.0.1:8000/customer/checkout",
            "about": "http://127.0.0.1:8000/about",
            "contact": "http://127.0.0.1:8000/contact",
            "orders": "http://127.0.0.1:8000/customer/my-orders"
        }

        # Login first
        print("Logging in...")
        await page.goto("http://127.0.0.1:8000/login")
        await page.fill("input[name='email']", "customer@example.com")
        await page.fill("input[name='password']", "password")
        await page.click("button[type='submit']")
        await page.wait_for_url("http://127.0.0.1:8000/")

        # Add item to cart to ensure Cart/Checkout aren't empty
        print("Adding item to cart for audit...")
        await page.goto(pages["product_detail"])
        try:
            # Wait for any size buttons and click the first one if present
            size_btn = await page.query_selector("button.size-option, .size-selector button, input[name='size_id'] + label")
            if size_btn:
                await size_btn.click()

            # Click add to cart
            add_to_cart_btn = await page.query_selector("button:has-text('Tambah ke Keranjang'), button:has-text('Add to Cart')")
            if add_to_cart_btn:
                await add_to_cart_btn.click()
                await asyncio.sleep(2) # Wait for AJAX
        except Exception as e:
            print(f"Warning during add to cart: {e}")

        for vp_name, vp_size in viewports.items():
            print(f"Auditing {vp_name}...")
            await page.set_viewport_size(vp_size)

            for page_name, url in pages.items():
                print(f"  - {page_name}...")
                try:
                    await page.goto(url)
                    await asyncio.sleep(1.5) # Wait for animations/Alpine
                    await page.screenshot(path=f"audit_{page_name}_{vp_name}.png", full_page=True)
                except Exception as e:
                    print(f"Error auditing {page_name} on {vp_name}: {e}")

        await browser.close()

if __name__ == "__main__":
    asyncio.run(run_audit())
