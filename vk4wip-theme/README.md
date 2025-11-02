# VK4WIP Amateur Radio Club WordPress Theme

A custom WordPress child theme for VK4WIP - Ipswich & District Radio Club, built on the BlogBD foundation.

## Theme Information

- **Theme Name:** VK4WIP Amateur Radio Club Theme
- **Version:** 1.0.0
- **Parent Theme:** BlogBD
- **Author:** VK4WIP Development Team
- **License:** GPL v2 or later

## Features

### Design
- Custom color palette (Blue, Navy, Red, Gold)
- Modern typography (Inter + Montserrat)
- Responsive design (mobile-first approach)
- Card-based layouts
- Custom header with overlapping logo
- Gold menu bar navigation
- Hero section with background images
- Custom footer with club information

### Functionality
- **Custom Post Types:**
  - Events (with date, time, location fields)
  - Repeaters (with frequency, tone, coverage fields)
- **Custom Taxonomies:**
  - Event Categories
  - Repeater Bands
- **Responsive Navigation:**
  - Mobile menu toggle
  - Keyboard navigation support
  - Submenu support
- **Accessibility Features:**
  - ARIA labels
  - Skip links
  - Keyboard navigation
  - Screen reader support

### Components
- News cards
- Event listings
- Repeater information grids
- Explore more cards
- Back-to-top button
- Social media integration

## Installation

### Requirements
- WordPress 6.0 or higher
- PHP 7.4 or higher
- BlogBD parent theme installed

### Steps
1. Download or clone this repository
2. Upload the `vk4wip-theme` folder to `/wp-content/themes/`
3. Ensure BlogBD parent theme is installed and activated
4. Go to WordPress Admin → Appearance → Themes
5. Activate "VK4WIP Amateur Radio Club Theme"

## Recommended Plugins

### Essential
- **Advanced Custom Fields (ACF)** - Enhanced custom field management
- **Elementor** - Page builder for custom layouts
- **Yoast SEO** - SEO optimization

### Optional
- **Contact Form 7** - Contact forms
- **Jetpack** - Security and performance
- **WP Super Cache** - Caching for performance
- **Limit Login Attempts Reloaded** - Security

## Configuration

### After Activation

1. **Set Up Menus:**
   - Go to Appearance → Menus
   - Create a Primary Menu
   - Add pages: Home, About, Meetings, Calendar, Social, On-Air, Training, Members
   - Assign to "Primary Menu" location

2. **Configure Customizer:**
   - Go to Appearance → Customize
   - Set site title: "VK4WIP: Ipswich and District Radio Club, Inc."
   - Set tagline: "Using and promoting Amateur (HAM) Radio in the Ipswich and surrounding areas since 1962"
   - Upload club logo (VK4WIP.png)

3. **Create Sample Content:**
   - Add Events (Events → Add New)
   - Add Repeaters (Repeaters → Add New)
   - Add News Posts (Posts → Add New)

4. **Set Front Page:**
   - Go to Settings → Reading
   - Select "A static page"
   - Choose your home page

## File Structure

```
vk4wip-theme/
├── style.css                          # Theme header and main stylesheet
├── functions.php                      # Theme functions and setup
├── README.md                          # This file
├── TODO.md                            # Development progress tracker
├── assets/
│   ├── css/
│   │   ├── custom-properties.css     # CSS variables
│   │   ├── header.css                # Header styles
│   │   ├── hero.css                  # Hero section styles
│   │   ├── components.css            # Component styles
│   │   ├── footer.css                # Footer styles
│   │   └── responsive.css            # Media queries
│   ├── js/
│   │   ├── navigation.js             # Navigation functionality
│   │   └── theme.js                  # General theme scripts
│   └── images/
│       ├── VK4WIP.png                # Club logo
│       ├── clubhouse_hero_bg.jpg     # Hero background
│       └── website_header_bg_v4.jpg  # Header background
├── inc/
│   ├── custom-post-types.php         # CPT registration
│   ├── custom-fields.php             # Meta boxes
│   ├── customizer.php                # Customizer settings (to be created)
│   └── theme-functions.php           # Helper functions (to be created)
└── template-parts/                    # Template partials (to be created)
```

## Customization

### Colors
Edit CSS custom properties in `assets/css/custom-properties.css`:
```css
:root {
    --brand-blue: #1E5CB3;
    --brand-navy: #0B2D53;
    --brand-red: #E53935;
    --brand-gold: #F4C542;
}
```

### Typography
Fonts are loaded from Google Fonts (Inter and Montserrat). To change:
1. Edit the Google Fonts URL in `functions.php`
2. Update font-family variables in `custom-properties.css`

### Layout
- Wrapper max-width: 1200px (adjustable in `custom-properties.css`)
- Responsive breakpoints: 980px, 720px, 480px

## Custom Post Types

### Events
**Fields:**
- Event Date (date picker)
- Event Time (time picker)
- Event Location (text)
- Featured Event (checkbox)

**Usage:**
```php
// Get event date
$date = vk4wip_get_event_date( $post_id );

// Get event time
$time = vk4wip_get_event_time( $post_id );

// Check if featured
$is_featured = vk4wip_is_featured_event( $post_id );
```

### Repeaters
**Fields:**
- Callsign (text)
- Frequency (text)
- Offset (text)
- CTCSS Tone (text)
- Location (text)
- Coverage Area (textarea)

**Usage:**
```php
// Get formatted frequency display
$frequency = vk4wip_get_repeater_frequency_display( $post_id );
```

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Accessibility

This theme follows WCAG 2.1 AA guidelines:
- Semantic HTML5 markup
- ARIA labels and roles
- Keyboard navigation support
- Skip links
- Color contrast ratios meet AA standards
- Focus indicators
- Screen reader friendly

## Performance

- Minified CSS and JavaScript (production)
- Lazy loading images
- Optimized asset loading
- Mobile-first responsive design
- Efficient CSS custom properties

## Development

### Phase 1: Foundation ✅ COMPLETED
- Child theme structure
- CSS architecture
- JavaScript functionality
- Custom post types
- Meta boxes

### Phase 2: Header (In Progress)
- Custom header template
- Logo integration
- Navigation menu
- Mobile menu

### Upcoming Phases
- Hero section & front page
- Content sections
- Footer template
- Additional templates
- Customizer integration
- Testing & refinement

## Support

For issues, questions, or contributions:
- Website: https://ipswichradioclub.org.au
- Email: info@ipswichradioclub.org.au

## Credits

- **Design Concept:** VK4WIP Club Members
- **Development:** VK4WIP Development Team
- **Parent Theme:** BlogBD by Mehraz Morshed
- **Fonts:** Google Fonts (Inter, Montserrat)

## License

This theme is licensed under the GPL v2 or later.

```
VK4WIP Amateur Radio Club Theme, Copyright 2025 Ipswich & District Radio Club
VK4WIP Amateur Radio Club Theme is distributed under the terms of the GNU GPL
```

## Changelog

### Version 1.0.0 (Current)
- Initial release
- Child theme foundation
- Custom post types (Events, Repeaters)
- CSS architecture with custom properties
- JavaScript functionality
- Responsive design framework
- Meta boxes for custom fields

---

**VK4WIP** - Ipswich & District Radio Club, Inc.  
*Using and promoting Amateur (HAM) Radio since 1962*
