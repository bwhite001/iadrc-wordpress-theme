# VK4WIP Amateur Radio Club WordPress Theme Development Documentation

## Project Overview

**Theme Name:** VK4WIP Amateur Radio Club Theme  
**Base Template:** BlogBD WordPress Theme  
**Development Type:** Custom WordPress Theme Extension  
**Target Audience:** Amateur Radio Club Website  

## Design Analysis from Concept Files

### Visual Assets Provided
- **VK4WIP.jpg**: Club logo featuring transmission tower with lightning bolts
- **clubhouse_hero_bg.jpg**: Night-time clubhouse photograph for hero section background
- **website_header_bg_v4.jpg**: Abstract blue/red/gold geometric background for header
- **concept1_v2_wc.html**: Complete HTML/CSS mockup with full layout and styling

### Color Palette

#### Primary Brand Colors
```css
--brand-blue: #1E5CB3   /* Primary brand color */
--brand-navy: #0B2D53   /* Dark accent */
--brand-red:  #E53935   /* Alert/highlight color */
--brand-gold: #F4C542   /* Secondary accent */
```

#### Neutral Colors
```css
--ink:       #222A35   /* Primary text */
--muted:     #6B778C   /* Secondary text */
--paper:     #F7F8FB   /* Background */
--white:     #fff      /* Pure white */
--border:    #E0E6F0   /* Dividers/borders */
```

### Typography System

**Primary Font (Body Text):**
```css
font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
```

**Secondary Font (Headings):**
```css
font-family: Montserrat, sans-serif;
```

### Layout Structure Analysis

#### Header Component
- **Structure**: Site branding + Navigation + Member login
- **Elements**:
  - Club logo (VK4WIP.jpg)
  - Site title and tagline
  - Primary navigation menu
  - Member login button
- **Background**: website_header_bg_v4.jpg with overlay
- **Layout**: Flexbox with centered wrapper

#### Hero Section
- **Layout**: Two-column responsive grid
- **Left Column**:
  - Kicker text
  - Main heading (H1)
  - Description paragraph
  - Call-to-action button
- **Right Column**:
  - Featured image
  - Date badge overlay
- **Background**: clubhouse_hero_bg.jpg

#### Content Sections
1. **Latest News** - Two-column card layout
2. **Upcoming Events** - List with date badges
3. **Explore More** - Four-column card grid
4. **Repeaters & Nets** - Four-column technical card grid

#### Footer Component
- Multi-column layout
- Brand section with logo
- Quick links
- Contact information
- Parking/location details

### Responsive Breakpoints
```css
@media (max-width: 980px) { /* Tablet */ }
@media (max-width: 720px) { /* Mobile Large */ }
@media (max-width: 900px) { /* Mobile */ }
```

## WordPress Theme Development Plan

### Phase 1: BlogBD Base Theme Setup

#### 1.1 Environment Setup
- Install fresh WordPress development environment
- Download and install BlogBD base theme
- Create child theme structure
- Set up local development tools

#### 1.2 Theme File Structure
```
vk4wip-theme/
├── style.css
├── functions.php
├── index.php
├── header.php
├── footer.php
├── single.php
├── page.php
├── archive.php
├── 404.php
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
├── template-parts/
│   ├── hero-section.php
│   ├── news-cards.php
│   ├── events-list.php
│   └── repeater-cards.php
└── inc/
    ├── customizer.php
    ├── custom-post-types.php
    └── theme-functions.php
```

### Phase 2: Custom Styling Implementation

#### 2.1 CSS Variables Setup
Create `assets/css/custom-properties.css`:
```css
:root {
  /* Brand Colors */
  --brand-blue: #1E5CB3;
  --brand-navy: #0B2D53;
  --brand-red: #E53935;
  --brand-gold: #F4C542;
  
  /* Neutral Palette */
  --ink: #222A35;
  --muted: #6B778C;
  --paper: #F7F8FB;
  --white: #fff;
  --border: #E0E6F0;
  
  /* Background Images */
  --hero-image: url('./assets/images/clubhouse_hero_bg.jpg');
  --header-bg: url('./assets/images/website_header_bg_v4.jpg');
}
```

#### 2.2 Typography Implementation
```css
/* Primary font loading */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&display=swap');

body {
  font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
  color: var(--ink);
  background-color: var(--paper);
}

h1, h2, h3, h4, h5, h6 {
  font-family: Montserrat, sans-serif;
  font-weight: 600;
}
```

#### 2.3 Component Styles
- Header styling with background image
- Hero section layout and styling
- Card component styles
- Grid systems for content sections
- Footer layout and styling

### Phase 3: Custom Components Development

#### 3.1 Header Customization
**File: `header.php`**
```php
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="wrapper header-top">
        <div class="brandmark">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/VK4WIP.jpg" 
                 alt="VK4WIP Club Logo" class="club-logo">
            <div class="title-block">
                <div class="site-title"><?php bloginfo('name'); ?></div>
                <div class="site-tagline"><?php bloginfo('description'); ?></div>
            </div>
        </div>
        
        <nav class="main-nav">
            <?php wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class' => 'nav-menu'
            )); ?>
        </nav>
        
        <div class="header-actions">
            <a href="/member-login" class="link-btn">Member Login</a>
        </div>
    </div>
</header>
```

#### 3.2 Hero Section Template Part
**File: `template-parts/hero-section.php`**
```php
<section class="hero full-width">
    <div class="wrapper hero-inner">
        <div class="hero-grid">
            <div class="hero-left">
                <div class="kicker">Next Meeting</div>
                <h1>Tuesday 10th December</h1>
                <p>We'll share demos on SSTV, APRS and AllStar. Visitors welcome — bring anything you're tinkering with.</p>
                <div class="hero-cta">
                    <a href="#" class="link-btn">Learn More</a>
                </div>
            </div>
            <div class="hero-right">
                <!-- Dynamic featured image or default -->
                <div class="date">10 Dec</div>
            </div>
        </div>
    </div>
</section>
```

#### 3.3 Card Component Template
**File: `template-parts/content-card.php`**
```php
<div class="card">
    <?php if (has_post_thumbnail()): ?>
        <div class="card-image">
            <?php the_post_thumbnail('medium'); ?>
        </div>
    <?php endif; ?>
    
    <div class="card-content">
        <?php if (get_post_type() === 'event'): ?>
            <div class="date"><?php echo get_field('event_date'); ?></div>
        <?php endif; ?>
        
        <h3 class="title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        
        <div class="excerpt">
            <?php the_excerpt(); ?>
        </div>
        
        <a href="<?php the_permalink(); ?>" class="read-more">Read More →</a>
    </div>
</div>
```

### Phase 4: Custom Post Types and Fields

#### 4.1 Custom Post Types
**File: `inc/custom-post-types.php`**
```php
<?php
// Register Events Post Type
function register_events_post_type() {
    $args = array(
        'public' => true,
        'label' => 'Events',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-calendar-alt',
        'has_archive' => true,
    );
    register_post_type('event', $args);
}
add_action('init', 'register_events_post_type');

// Register Repeaters Post Type
function register_repeaters_post_type() {
    $args = array(
        'public' => true,
        'label' => 'Repeaters',
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-radio',
    );
    register_post_type('repeater', $args);
}
add_action('init', 'register_repeaters_post_type');
```

#### 4.2 Custom Fields (Advanced Custom Fields)
```php
// Event Fields
- event_date (Date Picker)
- event_time (Time Picker)  
- event_location (Text)
- featured_event (True/False)

// Repeater Fields
- frequency (Text)
- band (Select: 2m, 70cm, etc.)
- tone (Text)
- coverage_area (Text)
- net_times (Repeater - Time, Day)
```

### Phase 5: Page Templates

#### 5.1 Front Page Template
**File: `front-page.php`**
```php
<?php get_header(); ?>

<?php get_template_part('template-parts/hero-section'); ?>

<main class="site-main">
    <!-- Latest News Section -->
    <section class="section">
        <div class="wrapper">
            <h2>Latest News</h2>
            <div class="twocol">
                <?php
                $news_query = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 4
                ));
                
                while ($news_query->have_posts()) {
                    $news_query->the_post();
                    get_template_part('template-parts/content-card');
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section class="section band">
        <div class="wrapper">
            <h2>Upcoming Events</h2>
            <?php
            $events_query = new WP_Query(array(
                'post_type' => 'event',
                'meta_key' => 'event_date',
                'orderby' => 'meta_value',
                'order' => 'ASC',
                'posts_per_page' => 5
            ));
            
            get_template_part('template-parts/events-list', null, array('query' => $events_query));
            ?>
        </div>
    </section>

    <!-- More sections... -->
</main>

<?php get_footer(); ?>
```

### Phase 6: Customizer Integration

#### 6.1 Theme Customizer Options
**File: `inc/customizer.php`**
```php
<?php
function vk4wip_customize_register($wp_customize) {
    // Club Information Section
    $wp_customize->add_section('club_info', array(
        'title' => 'Club Information',
        'priority' => 30,
    ));
    
    // Club callsign
    $wp_customize->add_setting('club_callsign', array(
        'default' => 'VK4WIP',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('club_callsign', array(
        'label' => 'Club Callsign',
        'section' => 'club_info',
        'type' => 'text',
    ));
    
    // Meeting information
    $wp_customize->add_setting('meeting_info', array(
        'default' => 'Tuesdays 7:30 PM',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('meeting_info', array(
        'label' => 'Meeting Information',
        'section' => 'club_info',
        'type' => 'text',
    ));
}
add_action('customize_register', 'vk4wip_customize_register');
```

### Phase 7: Functions and Enqueue Setup

#### 7.1 Main Functions File
**File: `functions.php`**
```php
<?php
// Enqueue styles and scripts
function vk4wip_enqueue_assets() {
    // Enqueue parent theme styles
    wp_enqueue_style('blogbd-style', get_template_directory_uri() . '/style.css');
    
    // Enqueue custom styles
    wp_enqueue_style('vk4wip-style', get_stylesheet_directory_uri() . '/assets/css/style.css', array('blogbd-style'), '1.0.0');
    
    // Enqueue custom JavaScript
    wp_enqueue_script('vk4wip-script', get_stylesheet_directory_uri() . '/assets/js/theme.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'vk4wip_enqueue_assets');

// Theme setup
function vk4wip_theme_setup() {
    // Add theme support
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('title-tag');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => 'Primary Menu',
        'footer' => 'Footer Menu',
    ));
    
    // Add image sizes
    add_image_size('card-thumbnail', 300, 200, true);
    add_image_size('hero-image', 600, 400, true);
}
add_action('after_setup_theme', 'vk4wip_theme_setup');

// Include additional files
require_once get_stylesheet_directory() . '/inc/custom-post-types.php';
require_once get_stylesheet_directory() . '/inc/customizer.php';
```

## Implementation Timeline

### Week 1: Foundation
- Set up development environment
- Install BlogBD base theme
- Create child theme structure
- Implement basic color palette and typography

### Week 2: Layout Components
- Build header component with logo integration
- Create hero section template
- Implement card component system
- Build footer layout

### Week 3: Content Types
- Set up custom post types (Events, Repeaters)
- Configure custom fields
- Build content query templates
- Test data entry workflow

### Week 4: Pages and Templates
- Create front page template
- Build archive templates
- Implement single post templates
- Add customizer integration

### Week 5: Responsive and Polish
- Implement responsive design
- Cross-browser testing
- Performance optimization
- Final styling refinements

## Testing and Quality Assurance

### Browser Compatibility
- Chrome/Chromium (primary)
- Firefox
- Safari
- Edge

### Device Testing
- Desktop (1920x1080, 1366x768)
- Tablet (iPad, Surface)
- Mobile (iPhone, Android)

### WordPress Compatibility
- WordPress 6.0+
- PHP 8.0+
- Common plugins (Yoast SEO, Contact Form 7, etc.)

### Performance Goals
- Page load time < 3 seconds
- Lighthouse score > 90
- Mobile-friendly rating
- SEO optimized structure

## Maintenance and Updates

### Version Control
- Git repository setup
- Staging environment
- Production deployment process

### Documentation
- Theme customization guide
- Content management instructions
- Troubleshooting guide

### Future Enhancements
- Member portal integration
- Event calendar plugin
- Contest/award tracking
- Photo gallery system

## Conclusion

This development document provides a comprehensive roadmap for converting the VK4WIP Amateur Radio Club HTML concept into a fully functional WordPress theme based on the BlogBD template. The implementation focuses on maintaining the visual design integrity while adding robust content management capabilities suitable for an amateur radio club website.

Key success factors include:
- Faithful recreation of the color palette and typography
- Responsive grid layouts for optimal viewing
- Custom post types for specialized content
- User-friendly customization options
- Performance-optimized code structure

The modular approach ensures maintainability and allows for future feature additions as the club's needs evolve.