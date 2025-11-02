# VK4WIP Amateur Radio Club WordPress Theme

A modern, responsive WordPress theme designed specifically for the VK4WIP (Ipswich and District Amateur Radio Club). Built with amateur radio enthusiasts in mind, featuring custom post types for events and repeaters, a dynamic homepage, and comprehensive club management features.

![VK4WIP Theme](vk4wip-theme/screenshot.png)

---

## 📋 Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
  - [Local Development (Docker)](#local-development-docker)
  - [Production WordPress Site](#production-wordpress-site)
- [Configuration](#configuration)
- [Testing](#testing)
- [Deployment](#deployment)
- [Theme Structure](#theme-structure)
- [Customization](#customization)
- [Troubleshooting](#troubleshooting)
- [Support](#support)

---

## ✨ Features

### Homepage
- **Dynamic Hero Section** - Showcases featured events or custom content
- **Latest News Cards** - Grid layout of recent blog posts
- **Upcoming Events** - List of next club events with date badges
- **Explore Section** - Quick links to Membership, Training, Repeaters, WICEN
- **Repeater Quick Info** - Display key repeater technical details
- **Meeting Schedule** - Recurring meeting information

### Custom Post Types
- **Events** - Full event management with date, time, location, featured flag
- **Repeaters** - Technical repeater information (callsign, frequency, offset, tone, location)

### Customizer Settings (20+)
- Hero section configuration
- Homepage display options
- Contact information
- Social media links

### Design
- **Fully Responsive** - Mobile-first design
- **Accessible** - WCAG 2.1 AA compliant
- **Modern UI** - Card-based layouts, smooth animations
- **Brand Colors** - Blue (#003366), Red (#CC0000), Gold (#D4AF37)

---

## 🔧 Requirements

### Minimum Requirements
- **WordPress:** 5.8 or higher
- **PHP:** 7.4 or higher
- **MySQL:** 5.7 or higher (or MariaDB 10.3+)

### Recommended
- **WordPress:** 6.4 or higher
- **PHP:** 8.1 or higher
- **MySQL:** 8.0 or higher

### For Local Development
- **Docker:** 20.10 or higher
- **Docker Compose:** 2.0 or higher

### Recommended Plugins
- **Contact Form 7** - Contact forms
- **Advanced Custom Fields (ACF)** - Enhanced custom fields (optional)
- **Yoast SEO** - SEO optimization
- **The Events Calendar** - Advanced event management (optional)

---

## 📦 Installation

### Local Development (Docker)

#### Quick Start (Automated)

1. **Clone the repository:**
   ```bash
   git clone https://github.com/yourusername/vk4wip-theme.git
   cd vk4wip-theme
   ```

2. **Run the initialization script:**
   ```bash
   chmod +x init-wordpress.sh
   ./init-wordpress.sh
   ```

   This script will:
   - Start Docker containers
   - Install WordPress
   - Activate the VK4WIP theme
   - Install recommended plugins
   - Create sample content (pages, posts, events, repeaters)
   - Configure menus and settings

3. **Access your site:**
   - **Frontend:** http://localhost:8080
   - **Admin:** http://localhost:8080/wp-admin
   - **Username:** admin
   - **Password:** admin123

#### Manual Setup

1. **Start Docker containers:**
   ```bash
   docker-compose up -d
   ```

2. **Wait for database to initialize (10-15 seconds):**
   ```bash
   sleep 15
   ```

3. **Install WordPress:**
   ```bash
   docker-compose run --rm wpcli core install \
     --url="http://localhost:8080" \
     --title="VK4WIP: Ipswich and District Radio Club" \
     --admin_user="admin" \
     --admin_password="admin123" \
     --admin_email="admin@vk4wip.local" \
     --skip-email
   ```

4. **Activate the theme:**
   ```bash
   docker-compose run --rm wpcli theme activate vk4wip-theme
   ```

5. **Install plugins:**
   ```bash
   docker-compose run --rm wpcli plugin install contact-form-7 --activate
   docker-compose run --rm wpcli plugin install advanced-custom-fields --activate
   docker-compose run --rm wpcli plugin install wordpress-seo --activate
   ```

6. **Set permalink structure:**
   ```bash
   docker-compose run --rm wpcli rewrite structure '/%postname%/'
   docker-compose run --rm wpcli rewrite flush
   ```

#### Docker Commands

**Start containers:**
```bash
docker-compose up -d
```

**Stop containers:**
```bash
docker-compose down
```

**View logs:**
```bash
docker-compose logs -f wordpress
```

**Access WP-CLI:**
```bash
docker-compose run --rm wpcli [command]
```

**Reset everything (WARNING: Deletes all data):**
```bash
docker-compose down -v
rm -rf wordpress_data mysql_data
```

---

### Production WordPress Site

#### Method 1: Upload via WordPress Admin (Recommended)

1. **Create theme ZIP file:**
   ```bash
   cd vk4wip-theme
   zip -r ../vk4wip-theme.zip . -x "*.git*" "node_modules/*" "*.DS_Store"
   cd ..
   ```

2. **Upload to WordPress:**
   - Login to WordPress Admin
   - Go to **Appearance → Themes**
   - Click **Add New → Upload Theme**
   - Choose `vk4wip-theme.zip`
   - Click **Install Now**
   - Click **Activate**

#### Method 2: FTP/SFTP Upload

1. **Connect to your server via FTP/SFTP**

2. **Upload the theme folder:**
   - Upload `vk4wip-theme` folder to `/wp-content/themes/`

3. **Activate via WordPress Admin:**
   - Login to WordPress Admin
   - Go to **Appearance → Themes**
   - Find "VK4WIP Amateur Radio Club Theme"
   - Click **Activate**

#### Method 3: SSH/Command Line

1. **Connect to your server via SSH:**
   ```bash
   ssh user@yourserver.com
   ```

2. **Navigate to themes directory:**
   ```bash
   cd /path/to/wordpress/wp-content/themes/
   ```

3. **Upload theme (using git, rsync, or scp):**
   ```bash
   # Using git
   git clone https://github.com/yourusername/vk4wip-theme.git
   
   # Or using rsync from local machine
   rsync -avz vk4wip-theme/ user@yourserver.com:/path/to/wordpress/wp-content/themes/vk4wip-theme/
   ```

4. **Set correct permissions:**
   ```bash
   chown -R www-data:www-data vk4wip-theme
   find vk4wip-theme -type d -exec chmod 755 {} \;
   find vk4wip-theme -type f -exec chmod 644 {} \;
   ```

5. **Activate via WP-CLI (if available):**
   ```bash
   wp theme activate vk4wip-theme
   ```

---

## ⚙️ Configuration

### Initial Setup

1. **Login to WordPress Admin:**
   - Navigate to your-site.com/wp-admin
   - Login with your credentials

2. **Configure Site Identity:**
   - Go to **Appearance → Customize → Site Identity**
   - Set **Site Title:** "VK4WIP: Ipswich and District Radio Club"
   - Set **Tagline:** "Using and promoting Amateur (HAM) Radio in the Ipswich and surrounding areas since 1962"
   - Upload club logo (optional)

3. **Configure Hero Section:**
   - Go to **Appearance → Customize → Hero Section**
   - Set hero title, description, CTA text and link
   - Upload background image (recommended: 1920x1080px)
   - Toggle "Use Featured Event in Hero" if desired

4. **Configure Homepage Display:**
   - Go to **Appearance → Customize → Homepage Display**
   - Set number of news cards (1-6)
   - Set number of events (1-10)
   - Toggle explore and repeaters sections

5. **Add Contact Information:**
   - Go to **Appearance → Customize → Contact Information**
   - Add club phone, email, address
   - Add training coordinator details
   - Add WICEN coordinator email

6. **Add Social Media Links:**
   - Go to **Appearance → Customize → Social Media**
   - Add Facebook, Twitter, YouTube, Instagram URLs

7. **Create Navigation Menu:**
   - Go to **Appearance → Menus**
   - Create a new menu called "Primary Menu"
   - Add pages: Home, About, Membership, Training, Repeaters, Events, WICEN, Contact
   - Assign to "Primary Menu" location
   - Save menu

8. **Configure Permalinks:**
   - Go to **Settings → Permalinks**
   - Select "Post name" structure
   - Save changes

### Creating Content

#### Create Events

1. Go to **Events → Add New**
2. Enter event title (e.g., "Digital Interest Group Meeting")
3. Add event description in the content editor
4. Fill in **Event Details** meta box:
   - Event Date
   - Event Time
   - Event Location
   - Check "Featured Event" to display in hero section
5. Add featured image (recommended: 1200x600px)
6. Assign event category if needed
7. Click **Publish**

#### Create Repeaters

1. Go to **Repeaters → Add New**
2. Enter repeater title (e.g., "VK4RAI 2m Repeater")
3. Add description in the content editor
4. Fill in **Repeater Technical Details** meta box:
   - Callsign (e.g., VK4RAI)
   - Frequency (e.g., 146.900)
   - Offset (e.g., -600 kHz)
   - CTCSS Tone (e.g., 91.5)
   - Location (e.g., The Knobby)
   - Coverage Area
5. Assign band taxonomy (2m, 70cm, etc.)
6. Click **Publish**

#### Create Blog Posts

1. Go to **Posts → Add New**
2. Enter post title
3. Add content in the editor
4. Add featured image (recommended: 1200x600px)
5. Assign categories
6. Click **Publish**

#### Create Pages

Create these essential pages:

1. **Membership** - Club membership information
2. **Training** - License course information
3. **Repeaters** - Full repeater directory (will use custom template in Phase 4)
4. **WICEN** - Emergency communications information
5. **Contact** - Contact form and information

---

## 🧪 Testing

### Automated Testing (Local Development)

After running `init-wordpress.sh`, the theme is automatically tested with sample content.

### Manual Testing Checklist

#### Desktop Testing (1920x1080, 1366x768)

- [ ] Homepage loads without errors
- [ ] Hero section displays correctly
- [ ] News cards in 3-column grid
- [ ] Events list shows upcoming events
- [ ] Explore cards display (4 columns)
- [ ] Repeater cards show technical info
- [ ] Meeting schedule visible
- [ ] All hover effects work smoothly
- [ ] All links are functional
- [ ] Images load properly
- [ ] No horizontal scrolling

#### Tablet Testing (768px - 979px)

- [ ] Hero section responsive
- [ ] News cards adjust to 2 columns
- [ ] Events list readable
- [ ] Explore cards adjust (2 columns)
- [ ] Repeater cards adjust
- [ ] Meeting cards adjust
- [ ] Touch targets adequate (44px minimum)
- [ ] Navigation menu accessible

#### Mobile Testing (<720px)

- [ ] Hero section stacks vertically
- [ ] News cards single column
- [ ] Events list mobile-friendly
- [ ] Explore cards single column
- [ ] Repeater cards single column
- [ ] Meeting cards single column
- [ ] All text readable
- [ ] No content cutoff
- [ ] Mobile menu toggle works
- [ ] Touch-friendly buttons

#### Functionality Testing

- [ ] Theme activates without errors
- [ ] Customizer opens and settings save
- [ ] Featured event displays in hero
- [ ] News cards show latest posts
- [ ] Events list shows upcoming events
- [ ] Empty states display when no content
- [ ] Social media icons work
- [ ] Menu navigation works
- [ ] Footer displays correctly
- [ ] Widget areas functional

#### WordPress Integration

- [ ] No PHP errors in debug.log
- [ ] No JavaScript console errors
- [ ] CSS files load correctly
- [ ] Template parts load
- [ ] Events CPT works
- [ ] Repeaters CPT works
- [ ] Meta boxes display and save
- [ ] Featured images work
- [ ] Permalinks work

#### Browser Testing

Test in these browsers:
- [ ] Chrome/Chromium (latest)
- [ ] Firefox (latest)
- [ ] Safari (latest)
- [ ] Edge (latest)
- [ ] Mobile Safari (iOS)
- [ ] Chrome Mobile (Android)

#### Performance Testing

- [ ] Page load time < 3 seconds
- [ ] Images optimized
- [ ] CSS minified (for production)
- [ ] JavaScript minified (for production)
- [ ] No render-blocking resources
- [ ] Lighthouse score > 90

#### Accessibility Testing

- [ ] Keyboard navigation works
- [ ] Screen reader friendly
- [ ] Color contrast meets WCAG 2.1 AA
- [ ] ARIA labels present
- [ ] Focus indicators visible
- [ ] Alt text on images
- [ ] Semantic HTML structure

### Testing Tools

**Local Testing:**
```bash
# Check PHP syntax
find vk4wip-theme -name "*.php" -exec php -l {} \;

# Check for WordPress coding standards (requires PHP_CodeSniffer)
phpcs --standard=WordPress vk4wip-theme/

# Validate CSS
npx stylelint "vk4wip-theme/assets/css/**/*.css"
```

**Browser Testing:**
- Chrome DevTools (F12)
- Firefox Developer Tools (F12)
- Lighthouse (Chrome DevTools → Lighthouse)
- WAVE Accessibility Tool (browser extension)

---

## 🚀 Deployment

### Pre-Deployment Checklist

- [ ] All content created and reviewed
- [ ] Featured images added to posts/events
- [ ] Customizer settings configured
- [ ] Menus created and assigned
- [ ] Contact forms tested
- [ ] All links verified
- [ ] SEO settings configured (Yoast)
- [ ] Analytics code added (if needed)
- [ ] Backup created

### Production Deployment Steps

#### 1. Prepare Production Environment

**Update wp-config.php for production:**
```php
// Disable debug mode
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);

// Security keys (generate at https://api.wordpress.org/secret-key/1.1/salt/)
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
// ... add all security keys

// Force SSL (if using HTTPS)
define('FORCE_SSL_ADMIN', true);
```

#### 2. Upload Theme

Choose one of the installation methods above (ZIP upload, FTP, or SSH).

#### 3. Install Required Plugins

```bash
# Via WP-CLI (if available)
wp plugin install contact-form-7 --activate
wp plugin install wordpress-seo --activate

# Or install via WordPress Admin → Plugins → Add New
```

#### 4. Configure Production Settings

1. **Permalinks:**
   - Settings → Permalinks → Post name
   - Save changes

2. **Reading Settings:**
   - Settings → Reading
   - Set "Your homepage displays" to "A static page"
   - Homepage: Select "Home" or let it use front-page.php
   - Posts page: Select "News" or "Blog"

3. **Discussion Settings:**
   - Settings → Discussion
   - Configure comment settings as needed

4. **Media Settings:**
   - Settings → Media
   - Verify image sizes are appropriate

#### 5. Optimize for Production

**Enable Caching:**
- Install a caching plugin (W3 Total Cache, WP Super Cache, or WP Rocket)
- Configure caching settings

**Optimize Images:**
- Install image optimization plugin (Smush, ShortPixel, or Imagify)
- Optimize existing images

**Minify Assets:**
- Install Autoptimize or similar plugin
- Enable CSS/JS minification

**CDN Setup (Optional):**
- Configure CDN for static assets
- Update URLs in settings

#### 6. Security Hardening

**Install Security Plugin:**
```bash
wp plugin install wordfence --activate
# Or use Sucuri, iThemes Security, etc.
```

**Security Measures:**
- Change default admin username
- Use strong passwords
- Enable two-factor authentication
- Limit login attempts
- Hide WordPress version
- Disable file editing in admin
- Regular backups

**Add to wp-config.php:**
```php
// Disable file editing
define('DISALLOW_FILE_EDIT', true);

// Limit post revisions
define('WP_POST_REVISIONS', 5);

// Set auto-save interval
define('AUTOSAVE_INTERVAL', 300);
```

#### 7. Setup Backups

**Automated Backups:**
- Install UpdraftPlus or BackupBuddy
- Configure daily backups
- Store backups off-site (Dropbox, Google Drive, S3)

**Manual Backup:**
```bash
# Backup files
tar -czf vk4wip-backup-$(date +%Y%m%d).tar.gz /path/to/wordpress

# Backup database
mysqldump -u username -p database_name > vk4wip-db-$(date +%Y%m%d).sql
```

#### 8. Setup Monitoring

**Uptime Monitoring:**
- UptimeRobot (free)
- Pingdom
- StatusCake

**Error Monitoring:**
- Enable error logging
- Monitor error logs regularly
- Set up email alerts for critical errors

#### 9. SSL Certificate

**Install SSL Certificate:**
```bash
# Using Let's Encrypt (Certbot)
sudo certbot --apache -d yourdomain.com -d www.yourdomain.com
```

**Update WordPress URLs:**
```bash
wp search-replace 'http://yourdomain.com' 'https://yourdomain.com' --all-tables
```

#### 10. Final Checks

- [ ] Test all pages and functionality
- [ ] Verify SSL certificate
- [ ] Check mobile responsiveness
- [ ] Test contact forms
- [ ] Verify analytics tracking
- [ ] Check page load speed
- [ ] Test from different locations
- [ ] Verify backup system working

### Post-Deployment

1. **Submit to Search Engines:**
   - Google Search Console
   - Bing Webmaster Tools

2. **Setup Analytics:**
   - Google Analytics
   - Configure goals and events

3. **Monitor Performance:**
   - Check daily for first week
   - Review analytics weekly
   - Monitor uptime

4. **Regular Maintenance:**
   - Update WordPress core monthly
   - Update plugins weekly
   - Update theme as needed
   - Review backups weekly
   - Check security logs weekly

---

## 📁 Theme Structure

```
vk4wip-theme/
├── style.css                          # Main theme stylesheet (required)
├── functions.php                      # Theme functions and setup
├── header.php                         # Header template
├── footer.php                         # Footer template
├── index.php                          # Main template file
├── front-page.php                     # Custom homepage template
├── screenshot.png                     # Theme thumbnail
├── README.md                          # This file
│
├── assets/                            # Theme assets
│   ├── css/                           # Stylesheets
│   │   ├── custom-properties.css      # CSS variables
│   │   ├── header.css                 # Header styles
│   │   ├── hero.css                   # Hero section styles
│   │   ├── components.css             # Component styles
│   │   ├── footer.css                 # Footer styles
│   │   ├── front-page.css             # Homepage styles
│   │   └── responsive.css             # Responsive styles
│   │
│   ├── js/                            # JavaScript files
│   │   ├── navigation.js              # Navigation functionality
│   │   └── theme.js                   # General theme scripts
│   │
│   └── images/                        # Theme images
│       ├── VK4WIP.png                 # Club logo
│       ├── clubhouse_hero_bg.jpg      # Hero background
│       └── website_header_bg_v4.jpg   # Header background
│
├── inc/                               # PHP includes
│   ├── customizer.php                 # Customizer settings
│   ├── theme-functions.php            # Helper functions
│   ├── custom-post-types.php          # Events & Repeaters CPTs
│   └── custom-fields.php              # Meta boxes
│
└── template-parts/                    # Reusable template parts
    ├── hero-section.php               # Hero component
    ├── news-cards.php                 # News grid
    ├── events-list.php                # Events list
    ├── explore-cards.php              # Explore section
    └── repeater-cards.php             # Repeater info
```

---

## 🎨 Customization

### CSS Custom Properties

The theme uses CSS custom properties for easy customization. Edit `assets/css/custom-properties.css`:

```css
:root {
    /* Brand Colors */
    --color-primary: #003366;        /* Blue */
    --color-secondary: #CC0000;      /* Red */
    --color-accent: #D4AF37;         /* Gold */
    
    /* Typography */
    --font-heading: 'Montserrat', sans-serif;
    --font-body: 'Inter', sans-serif;
    
    /* Spacing */
    --spacing-xs: 0.5rem;
    --spacing-sm: 1rem;
    --spacing-md: 1.5rem;
    --spacing-lg: 2rem;
    --spacing-xl: 3rem;
}
```

### Adding Custom Sections

To add a new section to the homepage:

1. **Create template part:**
   ```php
   // template-parts/custom-section.php
   <section class="custom-section">
       <div class="container">
           <h2>Custom Section</h2>
           <!-- Your content here -->
       </div>
   </section>
   ```

2. **Add to front-page.php:**
   ```php
   <?php get_template_part( 'template-parts/custom', 'section' ); ?>
   ```

3. **Add styles:**
   ```css
   /* assets/css/front-page.css */
   .custom-section {
       padding: var(--spacing-section) 0;
   }
   ```

### Child Theme

To create a child theme for customizations:

1. **Create child theme directory:**
   ```bash
   mkdir vk4wip-child
   cd vk4wip-child
   ```

2. **Create style.css:**
   ```css
   /*
   Theme Name: VK4WIP Child
   Template: vk4wip-theme
   */
   ```

3. **Create functions.php:**
   ```php
   <?php
   function vk4wip_child_enqueue_styles() {
       wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
   }
   add_action('wp_enqueue_scripts', 'vk4wip_child_enqueue_styles');
   ```

---

## 🔧 Troubleshooting

### Common Issues

#### Theme doesn't activate
**Problem:** Error message when activating theme  
**Solution:**
- Check PHP version (minimum 7.4)
- Check error logs: `wp-content/debug.log`
- Verify all required files exist
- Check file permissions (644 for files, 755 for directories)

#### Homepage doesn't display correctly
**Problem:** Homepage shows blog posts instead of custom layout  
**Solution:**
- Verify `front-page.php` exists
- Check Settings → Reading → Homepage displays
- Clear cache (browser and WordPress)
- Deactivate conflicting plugins

#### Customizer settings don't save
**Problem:** Changes in Customizer don't persist  
**Solution:**
- Check file permissions on wp-content
- Disable caching plugins temporarily
- Check for JavaScript errors in console
- Verify database connection

#### Events/Repeaters don't appear
**Problem:** Custom post types not showing  
**Solution:**
- Go to Settings → Permalinks → Save Changes (flush rewrite rules)
- Verify custom post types are registered (check inc/custom-post-types.php)
- Check if posts are published (not draft)

#### Images not loading
**Problem:** Featured images or assets don't display  
**Solution:**
- Check file paths in code
- Verify images exist in assets/images/
- Check file permissions
- Clear browser cache
- Check for mixed content (HTTP/HTTPS)

#### CSS not loading
**Problem:** Styles not applied to pages  
**Solution:**
- Check functions.php enqueue statements
- Verify CSS files exist
- Clear cache (browser and WordPress)
- Check for CSS syntax errors
- Inspect page source to verify CSS URLs

#### Mobile menu not working
**Problem:** Menu toggle doesn't open on mobile  
**Solution:**
- Check if navigation.js is loading
- Check for JavaScript errors in console
- Verify jQuery is loaded
- Clear cache

### Debug Mode

Enable WordPress debug mode in `wp-config.php`:

```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
define('SCRIPT_DEBUG', true);
```

Check logs at: `wp-content/debug.log`

### Getting Help

1. **Check documentation:** Review this README and PHASE3_COMPLETION_SUMMARY.md
2. **Search issues:** Check GitHub issues for similar problems
3. **Enable debug mode:** Check error logs for specific errors
4. **Create issue:** Open a GitHub issue with:
   - WordPress version
   - PHP version
   - Theme version
   - Error messages
   - Steps to reproduce

---

## 📞 Support

### Documentation
- **README.md** - This file
- **PHASE3_COMPLETION_SUMMARY.md** - Detailed implementation guide
- **TODO.md** - Development progress tracker

### Resources
- **WordPress Codex:** https://codex.wordpress.org/
- **WordPress Developer Resources:** https://developer.wordpress.org/
- **Theme Handbook:** https://developer.wordpress.org/themes/

### Contact
- **Website:** https://ipswichradioclub.org.au
- **Email:** info@vk4wip.org.au
- **GitHub:** https://github.com/yourusername/vk4wip-theme

---

## 📝 License

This theme is licensed under the GNU General Public License v2 or later.

---

## 🙏 Credits

**Developed for:** VK4WIP - Ipswich and District Amateur Radio Club, Inc.

**Design Assets:**
- Club logo and branding
- Meeting banners
- Clubhouse photography

**Built with:**
- WordPress
- PHP
- CSS3
- JavaScript
- Docker

---

## 📅 Changelog

### Version 1.0.0 (January 2025)
- ✅ Initial release
- ✅ Custom homepage with 6 sections
- ✅ Events custom post type
- ✅ Repeaters custom post type
- ✅ 20+ Customizer settings
- ✅ Fully responsive design
- ✅ WCAG 2.1 AA accessibility
- ✅ Docker development environment

---

## 🚧 Roadmap

### Phase 4 (Planned)
- [ ] Repeater directory page with filtering
- [ ] Event archive template
- [ ] Single event template
- [ ] Calendar view

### Phase 5 (Planned)
- [ ] Content page templates (Membership, Training, WICEN)
- [ ] Search functionality
- [ ] 404 template

### Phase 6 (Planned)
- [ ] Member area
- [ ] Trading marketplace
- [ ] Photo gallery

---

**Last Updated:** January 2025  
**Version:** 1.0.0  
**Status:** Production Ready
