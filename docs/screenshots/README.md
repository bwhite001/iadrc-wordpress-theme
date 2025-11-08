# VK4WIP Theme Screenshots

This directory contains screenshots of the VK4WIP WordPress theme at various breakpoints for documentation purposes.

## Required Screenshots

### Desktop (1024px+)
- [ ] `desktop-hero.png` - Hero section with badge and gradient
- [ ] `desktop-news-events.png` - News & Events two-column layout
- [ ] `desktop-explore.png` - Explore section with 6 cards and CTA buttons
- [ ] `desktop-repeaters.png` - Repeaters section with dark background
- [ ] `desktop-meetings.png` - Meetings section with 3 cards

### Tablet (768px - 980px)
- [ ] `tablet-hero.png` - Hero section responsive view
- [ ] `tablet-full.png` - Full page layout on tablet

### Mobile (< 720px)
- [ ] `mobile-hero.png` - Hero section mobile view
- [ ] `mobile-menu.png` - Mobile hamburger menu open
- [ ] `mobile-content.png` - Content sections stacked

## How to Capture Screenshots

### Method 1: Browser DevTools (Recommended)

1. **Open the site:**
   ```
   http://localhost:8080
   ```

2. **Open DevTools:**
   - Press `F12` or right-click → Inspect

3. **Enable Device Toolbar:**
   - Press `Ctrl+Shift+M` (Windows/Linux)
   - Press `Cmd+Shift+M` (Mac)
   - Or click the device icon in DevTools

4. **Set viewport size:**
   - **Desktop:** 1920x1080 or 1366x768
   - **Tablet:** 768x1024 or 980x1200
   - **Mobile:** 375x667 (iPhone) or 360x640 (Android)

5. **Capture screenshot:**
   - **Chrome:** DevTools → ⋮ menu → Capture screenshot
   - **Firefox:** DevTools → ⋮ menu → Take a screenshot
   - **Or use:** Browser extension like "Full Page Screen Capture"

6. **Save to this directory** with the appropriate filename

### Method 2: Using Command Line (Linux/Mac)

```bash
# Install screenshot tool (if not already installed)
# Linux: sudo apt-get install scrot
# Mac: brew install screencapture

# Navigate to this directory
cd docs/screenshots

# Take screenshot (example for Linux with scrot)
scrot -u desktop-hero.png

# Or use browser automation tools like Puppeteer
```

### Method 3: Manual Screenshot

1. Open site in browser
2. Resize window to desired width
3. Use OS screenshot tool:
   - **Windows:** Win + Shift + S
   - **Mac:** Cmd + Shift + 4
   - **Linux:** PrtScn or Shift + PrtScn
4. Save to this directory

## Screenshot Specifications

### Image Format
- **Format:** PNG (preferred) or JPG
- **Quality:** High quality, no compression artifacts
- **Color:** RGB color space

### Image Dimensions

**Desktop Screenshots:**
- Width: 1920px or 1366px
- Height: Variable (capture full section or page)

**Tablet Screenshots:**
- Width: 768px or 980px
- Height: Variable

**Mobile Screenshots:**
- Width: 375px or 360px
- Height: Variable

### What to Capture

**Hero Section:**
- Include header/navigation
- Full hero section with badge, title, buttons
- Show gradient overlay effect

**News & Events:**
- Both columns visible (desktop)
- At least 2-3 news items
- At least 2-3 events (or "No Events" state)

**Explore Section:**
- All 6 cards visible
- Both CTA buttons visible
- Show hover state if possible

**Repeaters Section:**
- Dark background clearly visible
- At least 3-4 repeater cards
- Show glass effect on cards

**Meetings Section:**
- All 3 meeting cards visible
- Icons and text readable

**Mobile Menu:**
- Show hamburger icon
- Show menu in open state
- All menu items visible

## Testing Checklist

Before considering screenshots complete:

- [ ] All required screenshots captured
- [ ] Images are high quality and clear
- [ ] Text is readable in all screenshots
- [ ] Colors are accurate
- [ ] No browser UI visible (unless showing mobile menu)
- [ ] Consistent lighting/contrast across screenshots
- [ ] File names match convention exactly
- [ ] All images are in PNG format
- [ ] Images are optimized (< 500KB each)

## Image Optimization

After capturing screenshots, optimize them:

```bash
# Using ImageMagick (if installed)
mogrify -strip -quality 85 -resize 1920x *.png

# Or use online tools:
# - TinyPNG: https://tinypng.com/
# - Squoosh: https://squoosh.app/
# - ImageOptim (Mac): https://imageoptim.com/
```

## Updating Screenshots

When theme design changes:

1. Delete old screenshots
2. Capture new screenshots following this guide
3. Verify all screenshots are updated
4. Update README.md if screenshot descriptions change
5. Commit changes to git

## Notes

- Screenshots should represent the **current production state** of the theme
- Capture screenshots with **real content**, not Lorem Ipsum
- Ensure **no sensitive information** is visible in screenshots
- Use **consistent browser** for all screenshots (preferably Chrome)
- Capture at **100% zoom level** (no browser zoom applied)

## Current Status

**Last Updated:** January 8, 2025  
**Screenshots Status:** 📋 Pending - Manual capture required  
**Browser Used:** TBD  
**Viewport Sizes:** TBD

---

## Quick Reference

### Desktop Breakpoint (1024px+)
```
Viewport: 1920x1080 or 1366x768
Files: desktop-*.png
Status: ⚠️ Pending
```

### Tablet Breakpoint (768px - 980px)
```
Viewport: 768x1024 or 980x1200
Files: tablet-*.png
Status: ⚠️ Pending
```

### Mobile Breakpoint (< 720px)
```
Viewport: 375x667 or 360x640
Files: mobile-*.png
Status: ⚠️ Pending
```

---

**For detailed testing procedures, see:** [MOBILE_TABLET_TESTING.md](../../MOBILE_TABLET_TESTING.md)
