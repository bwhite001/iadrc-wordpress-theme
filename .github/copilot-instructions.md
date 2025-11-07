# VK4WIP WordPress Theme - AI Coding Instructions

## Project Overview
Custom WordPress theme for VK4WIP Amateur Radio Club, built with Docker-based development workflow. The theme features custom post types (Events, Repeaters), extensive WordPress Customizer integration, and modular CSS architecture.

## Architecture & Structure

### Theme Organization
- **Core**: `vk4wip-theme/` - WordPress theme root (mounted as volume in Docker)
- **Assets**: Modular CSS in `assets/css/` (custom-properties, header, hero, components, footer, responsive)
- **Includes**: PHP modules in `inc/` (custom-post-types, custom-fields, customizer, theme-functions)
- **Templates**: `template-parts/` for reusable components (hero-section, events-list, news-cards, etc.)

### Key Design Pattern: CSS Custom Properties
All styling uses CSS variables defined in `assets/css/custom-properties.css`:
```css
--brand-blue: #1E5CB3;
--brand-navy: #0B2D53;
--brand-red: #E53935;
--brand-gold: #F4C542;
```
**Always reference these variables** - never hardcode colors.

### Custom Post Types
Two CPTs with prefixed meta fields (prevent conflicts):
- **Events**: Meta fields `_vk4wip_event_date`, `_vk4wip_event_time`, `_vk4wip_event_location`, `_vk4wip_event_featured`
- **Repeaters**: Meta fields `_vk4wip_repeater_callsign`, `_vk4wip_repeater_frequency`, `_vk4wip_repeater_offset`, etc.

Access via helper functions in `inc/theme-functions.php`:
```php
vk4wip_get_upcoming_events($count)
vk4wip_get_featured_event()
vk4wip_format_event_date($post_id)
```

### WordPress Customizer Integration
20+ theme settings in `inc/customizer.php` organized by section:
- Hero Section (title, description, CTA, background)
- Homepage Display (news count, events count, show/hide sections)
- Contact Info (phone, email, address, ABN)
- Social Media (Facebook, Twitter/X)

Access with `get_theme_mod('vk4wip_setting_name', 'default')` - see `front-page.php` for examples.

## Development Workflow

### Docker Environment (Primary Workflow)
```bash
# Start development (use Make for convenience)
make start              # Starts WordPress + MySQL + phpMyAdmin
make theme-activate     # Activates theme after first start
make logs              # View WordPress logs

# Access points:
# - WordPress: http://localhost:8080
# - phpMyAdmin: http://localhost:8081
```

**Important**: Theme directory is live-mounted - CSS/PHP changes reflect immediately (browser refresh only).

### File Editing Guidelines
1. **CSS Changes**: Edit files in `assets/css/` - enqueued in dependency order via `functions.php`
2. **PHP Logic**: Add functions to `inc/theme-functions.php` or create new include files
3. **Templates**: Use `get_template_part()` pattern - see `front-page.php` for reference
4. **Custom Fields**: Register in `inc/custom-fields.php` using WordPress meta box API

### Version Management
Version is single source of truth in `vk4wip-theme/style.css`:
```css
Version: 1.0.0
```
Increment here for releases. GitHub Actions reads this for automated builds.

## Common Tasks

### Adding New Custom Post Type
1. Register in `inc/custom-post-types.php` following existing Events/Repeaters pattern
2. Add meta fields in `inc/custom-fields.php`
3. Create helper functions in `inc/theme-functions.php`
4. Add template part in `template-parts/`

### Adding Customizer Option
1. Add setting/control in `inc/customizer.php` within appropriate section
2. Use `get_theme_mod('vk4wip_new_setting')` in templates
3. Include default value as second parameter for backwards compatibility

### Styling New Components
1. Create new CSS file in `assets/css/` (e.g., `new-component.css`)
2. Use existing custom properties from `custom-properties.css`
3. Enqueue in `functions.php` via `vk4wip_enqueue_styles()` with proper dependencies
4. Add responsive rules in `responsive.css` following existing breakpoints (980px, 720px, 480px)

## Testing & Debugging

### Local Testing
```bash
# Check WordPress logs
make logs

# Access database
# Navigate to http://localhost:8081 (phpMyAdmin)

# WP-CLI commands
docker-compose run --rm wpcli theme list
docker-compose run --rm wpcli post list --post_type=event
```

### Production Build
```bash
# GitHub Actions automatically builds on push to main
# Manual release: update version in style.css, then:
git tag -a v1.0.1 -m "Release 1.0.1"
git push origin v1.0.1
```

## Critical Conventions

### File Naming
- PHP: Lowercase with hyphens (`custom-post-types.php`)
- CSS: Lowercase with hyphens (`custom-properties.css`)
- Functions: Prefix with `vk4wip_` to avoid conflicts
- Meta fields: Prefix with `_vk4wip_` (underscore hides from custom fields UI)

### WordPress Best Practices
- **Always sanitize**: Use `esc_html()`, `esc_url()`, `sanitize_text_field()`
- **Always escape output**: Use `esc_html_e()`, `esc_attr()` in templates
- **Check capabilities**: Use `current_user_can()` for admin functions
- **i18n ready**: Use `__()`, `_e()` with text domain `'vk4wip-theme'`

### CSS Architecture
- Mobile-first: Base styles, then `@media (min-width: ...)` for larger screens
- Component-based: Each component gets its own class (`.card`, `.hero-section`, `.event-badge`)
- No inline styles: All styling via CSS files (exception: dynamic backgrounds from Customizer)

## Dependencies & Requirements

### Runtime
- PHP 7.4+ (8.1+ recommended)
- WordPress 5.8+ (6.4+ recommended)
- MySQL 5.7+ / MariaDB 10.3+

### Development
- Docker 20.10+
- Docker Compose 2.0+
- No Node.js required (pure PHP/CSS theme)

### Recommended Plugins (Optional)
- Advanced Custom Fields (ACF) - Enhanced field UI
- Yoast SEO - SEO optimization
- Contact Form 7 - Contact forms

## Documentation References
- `README.md` - Installation & feature overview
- `DOCKER_GUIDE.md` - Detailed Docker workflow
- `GITHUB_WORKFLOW_GUIDE.md` - CI/CD and release process
- `website/development_notes/VK4WIP-theme-dev-doc.md` - Original design spec
- `theme_design_spec.json` - Design system reference (colors, typography, breakpoints)
