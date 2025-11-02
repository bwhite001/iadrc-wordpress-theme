# VK4WIP WordPress Theme - Phase 3 Implementation Plan

## Overview

Phase 3 focuses on creating the visual frontend templates that bring your design to life. Based on analysis of the current VK4WIP website and modern amateur radio club best practices, this phase will create custom page templates, content sections, and specialized functionality.

---

## Current Website Analysis

### Existing Pages
1. **Home** - News, events, general information
2. **Membership** - Join the club, benefits, pricing
3. **Foundation Course** - License training information
4. **History** - Club history since 1962
5. **On Air** - Nets, frequencies, operating info
6. **Social** - Meeting schedules and info
7. **Calendar** - Event calendar
8. **Repeaters** - Extensive repeater directory with filterable table
9. **WICEN** - Emergency communications
10. **Trading** - Member marketplace
11. **Archived Website** - Legacy content

### Meeting Schedule
- **Digital Interest Group** - 1st Monday, 7:30pm
- **Social Meeting** - 2nd Monday, 7:30pm  
- **Business Meeting** - 4th Monday, 7:30pm

### Key Features to Implement
- Filterable repeater directory (Output, Input, CTCSS, Callsign, Site, Mode)
- Event calendar with multiple meeting types
- News/blog posts with featured images
- Training course information
- Member trading marketplace
- WICEN community service events

---

## Design Inspiration from Best Practices

### What Makes Great Amateur Radio Club Websites

Based on research of top radio websites and club sites[27][28][29][32]:

#### Eye-Catching Elements
1. **Bold Hero Sections** - Large background images with clear CTAs
2. **Modern Color Schemes** - Moving away from 1990s designs
3. **Easy Navigation** - Clear menu structure for all audiences
4. **Visual Storytelling** - Photos of members, events, equipment
5. **Mobile-First Design** - Responsive on all devices
6. **Quick Access to Key Info** - Repeaters, nets, meetings front and center

#### Content That Works
1. **"New to Amateur Radio?" Section** - Welcoming newcomers
2. **Event Highlights** - Upcoming activities prominently displayed
3. **Active News Feed** - Recent posts show the club is alive
4. **Clear Call-to-Actions** - "Join Now", "Get Licensed", "Contact Us"
5. **Member Benefits** - Why join this club?
6. **Community Photos** - Real people doing real radio activities

#### Common Pitfalls to Avoid
- Outdated copyright dates or "last updated" notices
- Jargon-heavy content without explanations
- Hard-to-find meeting information
- Sites that only cater to existing members
- No mobile optimization
- Broken links or outdated event listings

---

## Phase 3 Template Files

### Priority 1: CRITICAL (Build First)

#### 1. `front-page.php` - Custom Homepage
**Purpose:** Main landing page that welcomes all visitors

**Sections:**
```php
- Hero Section with Next Meeting/Event
  └─ Dynamic content from latest Event post
  └─ Or manually set via Customizer
  └─ Background: clubhouse_hero_bg.jpg or meeting banners
  
- Latest News Cards (2-3 posts)
  └─ Grid layout with featured images
  └─ Excerpt text
  └─ Date badges
  └─ "Read More" links
  
- Upcoming Events List
  └─ Next 3-5 events from Events CPT
  └─ Date/time/location displayed
  └─ "View Calendar" CTA
  
- Explore More Grid (4 cards)
  └─ Membership
  └─ Training/Foundation Course
  └─ Repeaters
  └─ WICEN
  
- Repeaters & Nets Quick Info (4 cards)
  └─ VK4RAI 146.900 MHz
  └─ VK4RWM 438.375 MHz
  └─ Net times
  └─ Digital modes (D-Star, DMR, P25, C4FM)
```

**Design Elements:**
- Use abstract_background.jpg for section backgrounds
- Meeting banners for event highlights
- Card-based layouts from design concept
- Clear CTAs in brand colors (blue, red, gold)

---

#### 2. `template-parts/hero-section.php` - Dynamic Hero
**Purpose:** Reusable hero component

**Features:**
- Pull latest Event or featured post
- Display event date badge
- Show event title and description
- CTA button ("Learn More", "Register", etc.)
- Background image support (clubhouse or meeting banners)
- Gradient overlay for text readability

**Customizer Options:**
- Hero title override
- Hero description override
- Hero CTA text and link
- Background image selection

---

#### 3. `template-parts/news-cards.php` - Latest News Display
**Purpose:** Display recent blog posts in card format

**Features:**
- 2-3 column grid layout
- Featured image thumbnails
- Post date and author
- Excerpt (150 words)
- Category/tag display
- "Read More" link
- Fallback for posts without images

**Responsive:**
- Desktop: 3 columns
- Tablet: 2 columns
- Mobile: 1 column stacked

---

#### 4. `template-parts/events-list.php` - Upcoming Events
**Purpose:** Display next events from Events CPT

**Features:**
- Date badges (styled like meeting banners)
- Event title and description
- Location information
- Time display
- Registration/RSVP button if applicable
- "View Full Calendar" CTA
- Empty state: "No upcoming events scheduled"

**Query:**
```php
$events = new WP_Query([
    'post_type' => 'event',
    'posts_per_page' => 5,
    'meta_key' => 'event_date',
    'orderby' => 'meta_value',
    'order' => 'ASC',
    'meta_query' => [[
        'key' => 'event_date',
        'value' => date('Y-m-d'),
        'compare' => '>=',
        'type' => 'DATE'
    ]]
]);
```

---

### Priority 2: HIGH PRIORITY (Build Second)

#### 5. `page-repeaters.php` - Filterable Repeater Directory
**Purpose:** Comprehensive repeater listing with filters

**Custom Post Type:** `repeater`
**Custom Fields:**
- Output Frequency
- Input Frequency
- CTCSS Tone
- Callsign
- Site Location
- Mode (Analogue, Digital, APRS, P25, DMR, etc.)
- Status (On/Off)
- Notes
- Linked System (boolean)

**Features:**
- Search box for callsign/frequency
- Filter dropdowns:
  - Site Location
  - Mode
  - Band (6m, 2m, 70cm)
- Sortable table columns
- Highlight linked repeater systems
- Color-coded by mode
- Mobile-responsive card layout

**Table Structure:**
```
| Output | Input | CTCSS | Callsign | Site | Mode | Status | Notes |
```

**JavaScript:**
- DataTables or custom jQuery for filtering/sorting
- AJAX filtering for better UX
- Export to CSV button (optional)

---

#### 6. `archive-event.php` - Events Archive
**Purpose:** All events listing with filters

**Features:**
- Grid or list view toggle
- Filter by:
  - Event category (Meeting, WICEN, Training, Contest, Social)
  - Date range
  - Upcoming vs. Past
- Date badges on cards
- Pagination
- Search functionality

**Layout Options:**
- **Grid View:** Cards with images, 3 columns
- **List View:** Rows with date, title, location, excerpt

---

#### 7. `single-event.php` - Single Event Page
**Purpose:** Full event details

**Content Sections:**
- Hero image (if set) or default banner
- Event date/time/location prominently displayed
- Full description
- Map embed (optional - Google Maps)
- Registration button/form
- "Add to Calendar" buttons (Google, Outlook, iCal)
- Related events sidebar
- Social sharing buttons

**Sidebar Widgets:**
- Upcoming events
- Event categories
- Recent news
- Contact information

---

### Priority 3: MEDIUM PRIORITY (Build Third)

#### 8. `page-calendar.php` - Calendar Display
**Purpose:** Visual calendar of all events

**Options:**
- Month view calendar
- List view (same as archive)
- Day view for selected date

**Recommended Plugin Integration:**
- The Events Calendar (by Modern Tribe)
- OR custom implementation with FullCalendar.js

**Features:**
- Color-coded by event type
- Click event to view details
- Month/week/day navigation
- Filter by event category
- Export to iCal

**Meeting Schedule Display:**
- Recurring meetings section
- "1st Monday: Digital Interest Group"
- "2nd Monday: Social Meeting"
- "4th Monday: Business Meeting"

---

#### 9. `page-membership.php` - Membership Information
**Purpose:** Convince visitors to join

**Sections:**
1. **Hero Section**
   - "Join VK4WIP Today"
   - Membership benefits
   - CTA: "Become a Member"

2. **Membership Benefits**
   - Grid of benefit cards with icons
   - Access to repeaters
   - Training courses
   - Club events
   - Equipment loan scheme
   - Voting rights
   - Newsletter subscription

3. **Membership Types & Pricing**
   - Table or cards:
     - Full Member: $XX/year
     - Associate Member: $XX/year
     - Junior Member: $XX/year
     - Life Member: (by nomination)

4. **How to Join**
   - Step-by-step process
   - Contact information
   - Membership form (Contact Form 7)

5. **FAQs**
   - Common questions about membership

6. **Testimonials** (optional)
   - Member quotes about the club

---

#### 10. `page-training.php` - License Courses
**Purpose:** License training information

**Sections:**
1. **Hero Section**
   - "Get Your Amateur Radio License"
   - Image of training session
   - CTA: "Enroll Now"

2. **Course Cards**
   - **Foundation License**
     - Description
     - Duration
     - Topics covered
     - Exam info
     - Next course dates
     - Enroll button
   
   - **Standard License**
     - Same structure
   
   - **Advanced License**
     - Same structure

3. **Course Schedule**
   - Upcoming course dates
   - Times and locations
   - Contact training coordinator

4. **Trainer Information**
   - Greg Walker VK4GJW
   - Contact: 0428 999 640
   - Photo (if available)

5. **What You'll Learn**
   - Accordion or tabs with course content

6. **Success Stories**
   - Recently licensed members
   - Photos from past courses

7. **Contact Form**
   - "Interested in a course? Contact us!"

---

## Additional Template Files

### 11. `page-wicen.php` - WICEN Page
**Purpose:** Emergency communications info

**Content:**
- What is WICEN?
- Upcoming WICEN events
- How to get involved
- Contact WICEN coordinator
- Past events gallery

### 12. `page-trading.php` - Member Trading
**Purpose:** Buy/sell marketplace

**Features:**
- Listings from custom post type or form submissions
- Categories: For Sale, Wanted, Free
- Contact seller button
- Image gallery
- Member-only submission form

### 13. `page-history.php` - Club History
**Purpose:** Historical information

**Features:**
- Timeline of club milestones
- Historical photos
- Founding members
- Major achievements
- Silent Keys memorial (if desired)

### 14. `page-contact.php` - Contact Page
**Purpose:** Contact information

**Features:**
- Contact Form 7 integration
- Club address and map
- Office bearers and contact details
- Social media links
- Meeting times and location

---

## Template Parts Library

Create reusable components in `template-parts/`:

```
template-parts/
├── hero-section.php
├── news-cards.php
├── events-list.php
├── repeater-card.php
├── event-card.php
├── membership-card.php
├── course-card.php
├── cta-section.php
├── testimonial.php
├── breadcrumbs.php
└── social-share.php
```

---

## CSS Enhancements

### New CSS Files for Phase 3

#### `assets/css/front-page.css`
- Hero section styling
- News cards grid
- Events list
- Explore more grid
- Repeaters quick info

#### `assets/css/repeaters.css`
- Filterable table styling
- Filter controls
- Mobile card layout
- Status indicators
- Mode color coding

#### `assets/css/calendar.css`
- Calendar grid
- Event badges
- Month navigation
- Responsive calendar layout

#### `assets/css/cards.css`
- Generic card component
- Event cards
- News cards
- Repeater cards
- Course cards

---

## JavaScript Enhancements

### New JS Files for Phase 3

#### `assets/js/repeaters.js`
```javascript
// Repeater filtering and sorting
- Initialize DataTables or custom filter
- Site filter dropdown
- Mode filter dropdown
- Band filter dropdown
- Search functionality
- Export to CSV
```

#### `assets/js/calendar.js`
```javascript
// Calendar functionality
- Initialize FullCalendar (if using)
- Event click handlers
- Month/week/day view switching
- Filter by category
```

#### `assets/js/forms.js`
```javascript
// Enhanced form interactions
- Form validation
- Dynamic field showing/hiding
- AJAX form submissions
- Success/error messaging
```

---

## Customizer Additions

### Phase 3 Customizer Options

```php
// Front Page Settings
- Hero Title
- Hero Description
- Hero CTA Text
- Hero CTA Link
- Hero Background Image
- Featured Events (select posts)
- Number of news cards to show

// Repeater Settings
- Default filter view
- Show/hide columns
- Enable CSV export

// Calendar Settings
- Default view (month/list)
- Event categories to display
- Integration with external calendars

// Contact Information
- Training Coordinator Name
- Training Coordinator Phone
- Training Coordinator Email
- WICEN Coordinator Email
- Club Phone
- Club Address
```

---

## Content Migration Plan

### Step 1: Content Audit
- Review all pages on current site
- Identify content that needs updating
- Note any outdated information

### Step 2: Create Pages
- Create WordPress pages for each section
- Assign appropriate templates
- Add page content

### Step 3: Create Events
- Add recurring meetings as Events
- Add upcoming community events
- Add WICEN events
- Add training course dates

### Step 4: Create Repeater Entries
- Add all repeaters from existing site
- Populate custom fields
- Verify accuracy of information

### Step 5: Import News/Blog Posts
- Export from old site (if applicable)
- Import to WordPress
- Add featured images
- Assign categories

### Step 6: Configure Menus
- Create Primary Menu
- Add all pages in logical order
- Configure footer menus

---

## Testing Checklist for Phase 3

### Desktop Testing (1920px, 1366px)
- [ ] Hero section displays correctly
- [ ] News cards grid (3 columns)
- [ ] Events list readable
- [ ] Repeater table functional
- [ ] All filters work
- [ ] Forms submit correctly
- [ ] Images load properly
- [ ] No horizontal scrolling

### Tablet Testing (980px, 720px)
- [ ] Hero section responsive
- [ ] News cards adapt (2 columns)
- [ ] Events list readable
- [ ] Repeater table becomes cards
- [ ] Filters still accessible
- [ ] Forms responsive
- [ ] Touch targets adequate size

### Mobile Testing (480px, 320px)
- [ ] Hero section stacks properly
- [ ] News cards single column
- [ ] Events list mobile-friendly
- [ ] Repeater cards stack
- [ ] Filters in mobile menu
- [ ] Forms easy to complete
- [ ] All text readable
- [ ] No content cutoff

### Functionality Testing
- [ ] Event filtering works
- [ ] Repeater filtering works
- [ ] Search functionality works
- [ ] Calendar navigation works
- [ ] Forms validate correctly
- [ ] Forms submit successfully
- [ ] Contact Form 7 working
- [ ] Links all working
- [ ] Images optimized

### Content Testing
- [ ] All pages have content
- [ ] Events display correctly
- [ ] Repeaters display correctly
- [ ] News posts display
- [ ] No lorem ipsum text
- [ ] All dates correct
- [ ] Contact info accurate

### SEO Testing
- [ ] Page titles set
- [ ] Meta descriptions set
- [ ] H1 tags on all pages
- [ ] Images have alt text
- [ ] URLs are clean
- [ ] Yoast SEO configured
- [ ] XML sitemap generated

---

## Implementation Timeline

### Week 1: Homepage Foundation
- Day 1-2: `front-page.php` structure
- Day 3: Hero section template part
- Day 4: News cards template part
- Day 5: Events list template part
- Testing and refinements

### Week 2: Repeater Directory
- Day 1-2: `page-repeaters.php` template
- Day 3: Repeater custom fields
- Day 4: Filtering functionality
- Day 5: Testing and styling

### Week 3: Events System
- Day 1-2: `archive-event.php` and `single-event.php`
- Day 3: Event custom fields
- Day 4: Calendar page template
- Day 5: Testing and refinements

### Week 4: Content Pages
- Day 1: Membership page template
- Day 2: Training page template
- Day 3: Additional pages (WICEN, Trading, etc.)
- Day 4-5: Content migration and testing

### Week 5: Polish and Launch
- Day 1-2: Cross-browser testing
- Day 3: Mobile optimization
- Day 4: Performance optimization
- Day 5: Final review and launch

---

## Success Metrics

### User Engagement
- Time on site
- Pages per session
- Bounce rate
- Return visitor rate

### Functional Success
- Event registrations
- Training course inquiries
- Membership applications
- Repeater directory usage

### Technical Success
- Page load speed < 3 seconds
- Mobile usability score > 90
- SEO score > 85
- No 404 errors
- Cross-browser compatibility

---

## Next Steps

1. **Review this plan** with stakeholders
2. **Prioritize templates** based on immediate needs
3. **Begin implementation** with Priority 1 templates
4. **Test incrementally** after each template
5. **Gather feedback** from club members
6. **Iterate and improve** based on usage

---

## Resources and References

### WordPress Documentation
- Custom Post Types
- Custom Fields
- Template Hierarchy
- Customizer API

### Design Inspiration
- Modern radio websites (Radio Tulum, Beat Radio, Australian Country Radio)
- Amateur radio best practices (Essex Ham guide)
- Community websites with events/calendars

### Plugins to Consider
- Advanced Custom Fields (ACF) - Custom fields
- The Events Calendar - Event management
- Contact Form 7 - Forms
- TablePress - Static table management (alternative to custom repeater)

---

**Phase 3 Ready to Begin!** 🚀

This comprehensive plan provides a clear roadmap for creating all necessary templates, features, and functionality to bring the VK4WIP theme to life.