#!/bin/bash

# VK4WIP Theme - WordPress Initialization Script
# This script runs INSIDE the wpcli container after it's up
# It installs WordPress, activates the theme, and sets up required plugins

set -e

echo "=========================================="
echo "VK4WIP Theme - WordPress Setup"
echo "=========================================="
echo ""

# Colors for output
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Configuration
SITE_URL="http://localhost:8080"
SITE_TITLE="VK4WIP: Ipswich and District Radio Club"
ADMIN_USER="admin"
ADMIN_PASSWORD="admin123"
ADMIN_EMAIL="admin@vk4wip.local"

echo -e "${BLUE}Step 1: Waiting for WordPress to be ready...${NC}"
# Wait for WordPress core files and database
MAX_ATTEMPTS=30
ATTEMPT=0
while [ $ATTEMPT -lt $MAX_ATTEMPTS ]; do
    if wp db check 2>/dev/null; then
        echo -e "${GREEN}✓ Database is accessible${NC}"
        break
    fi
    ATTEMPT=$((ATTEMPT + 1))
    echo -n "."
    sleep 2
done

if [ $ATTEMPT -eq $MAX_ATTEMPTS ]; then
    echo -e "\n${RED}✗ Database not accessible after $MAX_ATTEMPTS attempts${NC}"
    exit 1
fi
echo ""

echo -e "${BLUE}Step 2: Installing WordPress...${NC}"
# Check if WordPress is already installed
if wp core is-installed 2>/dev/null; then
    echo -e "${YELLOW}⚠ WordPress is already installed, skipping...${NC}"
else
    wp core install \
      --url="${SITE_URL}" \
      --title="${SITE_TITLE}" \
      --admin_user="${ADMIN_USER}" \
      --admin_password="${ADMIN_PASSWORD}" \
      --admin_email="${ADMIN_EMAIL}" \
      --skip-email
    echo -e "${GREEN}✓ WordPress installed${NC}"
fi
echo ""

echo -e "${BLUE}Step 3: Activating VK4WIP theme...${NC}"
wp theme activate vk4wip-theme
echo -e "${GREEN}✓ Theme activated${NC}"
echo ""

echo -e "${BLUE}Step 4: Installing recommended plugins...${NC}"

# Install and activate Contact Form 7
echo "  - Installing Contact Form 7..."
if wp plugin is-installed contact-form-7 2>/dev/null; then
    echo "    Already installed, activating..."
    wp plugin activate contact-form-7 2>/dev/null || true
else
    wp plugin install contact-form-7 --activate
fi

# Install and activate Advanced Custom Fields
echo "  - Installing Advanced Custom Fields..."
if wp plugin is-installed advanced-custom-fields 2>/dev/null; then
    echo "    Already installed, activating..."
    wp plugin activate advanced-custom-fields 2>/dev/null || true
else
    wp plugin install advanced-custom-fields --activate
fi

# Install and activate Yoast SEO
echo "  - Installing Yoast SEO..."
if wp plugin is-installed wordpress-seo 2>/dev/null; then
    echo "    Already installed, activating..."
    wp plugin activate wordpress-seo 2>/dev/null || true
else
    wp plugin install wordpress-seo --activate
fi

echo -e "${GREEN}✓ Plugins installed${NC}"
echo ""

echo -e "${BLUE}Step 5: Creating sample content...${NC}"

# Create sample pages
echo "  - Creating pages..."
wp post create \
  --post_type=page \
  --post_title='Membership' \
  --post_status=publish \
  --post_content='Join VK4WIP and become part of our amateur radio community.' 2>/dev/null || echo "    Page may already exist"

wp post create \
  --post_type=page \
  --post_title='Training' \
  --post_status=publish \
  --post_content='Get your amateur radio license with our Foundation, Standard, and Advanced courses.' 2>/dev/null || echo "    Page may already exist"

wp post create \
  --post_type=page \
  --post_title='Repeaters' \
  --post_status=publish \
  --post_content='Access our extensive repeater network covering Southeast Queensland.' 2>/dev/null || echo "    Page may already exist"

wp post create \
  --post_type=page \
  --post_title='WICEN' \
  --post_status=publish \
  --post_content='Support emergency communications and community service events.' 2>/dev/null || echo "    Page may already exist"

wp post create \
  --post_type=page \
  --post_title='Contact' \
  --post_status=publish \
  --post_content='Get in touch with VK4WIP. Club House: 10 Deebing St, Ipswich QLD 4305' 2>/dev/null || echo "    Page may already exist"

# Create sample blog posts
echo "  - Creating sample blog posts..."
wp post create \
  --post_title='Welcome to VK4WIP' \
  --post_status=publish \
  --post_content='Welcome to the new VK4WIP website! We are excited to share news, events, and information about amateur radio in the Ipswich area.' 2>/dev/null || echo "    Post may already exist"

wp post create \
  --post_title='Digital Interest Group Meeting' \
  --post_status=publish \
  --post_content='Join us for our monthly Digital Interest Group meeting on the first Monday of each month at 7:30 PM.' 2>/dev/null || echo "    Post may already exist"

wp post create \
  --post_title='Foundation License Course Starting Soon' \
  --post_status=publish \
  --post_content='Our next Foundation License course is starting soon. Contact our training coordinator for more information.' 2>/dev/null || echo "    Post may already exist"

# Create sample events
echo "  - Creating sample events..."
wp post create \
  --post_type=event \
  --post_title='Digital Interest Group Meeting' \
  --post_status=publish \
  --post_content='Monthly meeting for digital modes enthusiasts. Discuss D-Star, DMR, P25, and more.' \
  --meta_input='{"_vk4wip_event_date":"2025-02-03","_vk4wip_event_time":"19:30","_vk4wip_event_location":"Club House","_vk4wip_event_featured":"1"}' 2>/dev/null || echo "    Event may already exist"

wp post create \
  --post_type=event \
  --post_title='Social Meeting' \
  --post_status=publish \
  --post_content='Casual gathering with presentations and activities for all members.' \
  --meta_input='{"_vk4wip_event_date":"2025-02-10","_vk4wip_event_time":"19:30","_vk4wip_event_location":"Club House","_vk4wip_event_featured":"0"}' 2>/dev/null || echo "    Event may already exist"

wp post create \
  --post_type=event \
  --post_title='Business Meeting' \
  --post_status=publish \
  --post_content='Monthly business meeting for club planning and member discussions.' \
  --meta_input='{"_vk4wip_event_date":"2025-02-24","_vk4wip_event_time":"19:30","_vk4wip_event_location":"Club House","_vk4wip_event_featured":"0"}' 2>/dev/null || echo "    Event may already exist"

# Create sample repeaters
echo "  - Creating sample repeaters..."
wp post create \
  --post_type=repeater \
  --post_title='VK4RAI 2m Repeater' \
  --post_status=publish \
  --post_content='Primary 2m repeater covering Ipswich and surrounding areas.' \
  --meta_input='{"_vk4wip_repeater_callsign":"VK4RAI","_vk4wip_repeater_frequency":"146.900","_vk4wip_repeater_offset":"-600 kHz","_vk4wip_repeater_tone":"91.5","_vk4wip_repeater_location":"The Knobby","_vk4wip_repeater_coverage":"Ipswich, Brisbane West"}' 2>/dev/null || echo "    Repeater may already exist"

wp post create \
  --post_type=repeater \
  --post_title='VK4RWM 70cm Repeater' \
  --post_status=publish \
  --post_content='70cm repeater with excellent coverage of the Ipswich region.' \
  --meta_input='{"_vk4wip_repeater_callsign":"VK4RWM","_vk4wip_repeater_frequency":"438.375","_vk4wip_repeater_offset":"-5 MHz","_vk4wip_repeater_tone":"91.5","_vk4wip_repeater_location":"Raymonds Hill","_vk4wip_repeater_coverage":"Ipswich, Scenic Rim"}' 2>/dev/null || echo "    Repeater may already exist"

wp post create \
  --post_type=repeater \
  --post_title='VK4RBX 70cm Repeater' \
  --post_status=publish \
  --post_content='70cm repeater providing coverage to southern areas.' \
  --meta_input='{"_vk4wip_repeater_callsign":"VK4RBX","_vk4wip_repeater_frequency":"439.975","_vk4wip_repeater_offset":"-5 MHz","_vk4wip_repeater_tone":"91.5","_vk4wip_repeater_location":"Spring Mountain","_vk4wip_repeater_coverage":"Ipswich South, Logan"}' 2>/dev/null || echo "    Repeater may already exist"

wp post create \
  --post_type=repeater \
  --post_title='VK4RIL 6m Repeater' \
  --post_status=publish \
  --post_content='6m repeater for long-distance communications.' \
  --meta_input='{"_vk4wip_repeater_callsign":"VK4RIL","_vk4wip_repeater_frequency":"53.850","_vk4wip_repeater_offset":"-1 MHz","_vk4wip_repeater_tone":"91.5","_vk4wip_repeater_location":"Ipswich","_vk4wip_repeater_coverage":"Wide area coverage"}' 2>/dev/null || echo "    Repeater may already exist"

echo -e "${GREEN}✓ Sample content created${NC}"
echo ""

echo -e "${BLUE}Step 6: Setting up menus...${NC}"
# Create primary menu
MENU_EXISTS=$(wp menu list --format=count 2>/dev/null || echo "0")
if [ "$MENU_EXISTS" -eq "0" ]; then
    wp menu create "Primary Menu"
    wp menu location assign primary-menu primary

    # Add pages to menu
    wp menu item add-post primary-menu 1 --title="Home" 2>/dev/null || true
    wp menu item add-post primary-menu 2 --title="Membership" 2>/dev/null || true
    wp menu item add-post primary-menu 3 --title="Training" 2>/dev/null || true
    wp menu item add-post primary-menu 4 --title="Repeaters" 2>/dev/null || true
    wp menu item add-custom primary-menu "Events" /events 2>/dev/null || true
    wp menu item add-post primary-menu 5 --title="WICEN" 2>/dev/null || true
    wp menu item add-post primary-menu 6 --title="Contact" 2>/dev/null || true
    echo -e "${GREEN}✓ Menus configured${NC}"
else
    echo -e "${YELLOW}⚠ Menu already exists, skipping...${NC}"
fi
echo ""

echo -e "${BLUE}Step 7: Configuring theme settings...${NC}"
# Set site tagline
wp option update blogdescription "Using and promoting Amateur (HAM) Radio in the Ipswich and surrounding areas since 1962"

# Set permalink structure
wp rewrite structure '/%postname%/'
wp rewrite flush

echo -e "${GREEN}✓ Theme settings configured${NC}"
echo ""

echo "=========================================="
echo -e "${GREEN}✓ WordPress Setup Complete!${NC}"
echo "=========================================="
echo ""
echo -e "${YELLOW}Access your site:${NC}"
echo "  Frontend: ${SITE_URL}"
echo "  Admin:    ${SITE_URL}/wp-admin"
echo ""
echo -e "${YELLOW}Login credentials:${NC}"
echo "  Username: ${ADMIN_USER}"
echo "  Password: ${ADMIN_PASSWORD}"
echo ""
echo -e "${YELLOW}What's been set up:${NC}"
echo "  ✓ WordPress installed and configured"
echo "  ✓ VK4WIP theme activated"
echo "  ✓ Contact Form 7 plugin installed"
echo "  ✓ Advanced Custom Fields plugin installed"
echo "  ✓ Yoast SEO plugin installed"
echo "  ✓ Sample pages created (Membership, Training, Repeaters, WICEN, Contact)"
echo "  ✓ Sample blog posts created (3 posts)"
echo "  ✓ Sample events created (3 events)"
echo "  ✓ Sample repeaters created (4 repeaters)"
echo "  ✓ Primary menu configured"
echo ""
