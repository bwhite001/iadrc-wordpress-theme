#!/bin/bash

# VK4WIP Theme - WordPress Docker Initialization Script
# This script installs WordPress, activates the theme, and sets up required plugins

set -e

echo "=========================================="
echo "VK4WIP Theme - WordPress Setup"
echo "=========================================="
echo ""

# Colors for output
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Configuration
SITE_URL="http://localhost:8080"
SITE_TITLE="VK4WIP: Ipswich and District Radio Club"
ADMIN_USER="admin"
ADMIN_PASSWORD="admin123"
ADMIN_EMAIL="admin@vk4wip.local"

echo -e "${BLUE}Step 1: Starting Docker containers...${NC}"
docker-compose up -d
echo -e "${GREEN}✓ Containers started${NC}"
echo ""

echo -e "${BLUE}Step 2: Waiting for database to be ready...${NC}"
sleep 10
echo -e "${GREEN}✓ Database ready${NC}"
echo ""

echo -e "${BLUE}Step 3: Installing WordPress...${NC}"
docker-compose run --rm wpcli core install \
  --url="${SITE_URL}" \
  --title="${SITE_TITLE}" \
  --admin_user="${ADMIN_USER}" \
  --admin_password="${ADMIN_PASSWORD}" \
  --admin_email="${ADMIN_EMAIL}" \
  --skip-email
echo -e "${GREEN}✓ WordPress installed${NC}"
echo ""

echo -e "${BLUE}Step 4: Activating VK4WIP theme...${NC}"
docker-compose run --rm wpcli theme activate vk4wip-theme
echo -e "${GREEN}✓ Theme activated${NC}"
echo ""

echo -e "${BLUE}Step 5: Installing recommended plugins...${NC}"

# Install and activate Contact Form 7
echo "  - Installing Contact Form 7..."
docker-compose run --rm wpcli plugin install contact-form-7 --activate

# Install and activate Advanced Custom Fields (optional but recommended)
echo "  - Installing Advanced Custom Fields..."
docker-compose run --rm wpcli plugin install advanced-custom-fields --activate

# Install and activate Yoast SEO
echo "  - Installing Yoast SEO..."
docker-compose run --rm wpcli plugin install wordpress-seo --activate

echo -e "${GREEN}✓ Plugins installed${NC}"
echo ""

echo -e "${BLUE}Step 6: Creating sample content...${NC}"

# Create sample pages
echo "  - Creating pages..."
docker-compose run --rm wpcli post create \
  --post_type=page \
  --post_title='Membership' \
  --post_status=publish \
  --post_content='Join VK4WIP and become part of our amateur radio community.'

docker-compose run --rm wpcli post create \
  --post_type=page \
  --post_title='Training' \
  --post_status=publish \
  --post_content='Get your amateur radio license with our Foundation, Standard, and Advanced courses.'

docker-compose run --rm wpcli post create \
  --post_type=page \
  --post_title='Repeaters' \
  --post_status=publish \
  --post_content='Access our extensive repeater network covering Southeast Queensland.'

docker-compose run --rm wpcli post create \
  --post_type=page \
  --post_title='WICEN' \
  --post_status=publish \
  --post_content='Support emergency communications and community service events.'

docker-compose run --rm wpcli post create \
  --post_type=page \
  --post_title='Contact' \
  --post_status=publish \
  --post_content='Get in touch with VK4WIP. Club House: 10 Deebing St, Ipswich QLD 4305'

# Create sample blog posts
echo "  - Creating sample blog posts..."
docker-compose run --rm wpcli post create \
  --post_title='Welcome to VK4WIP' \
  --post_status=publish \
  --post_content='Welcome to the new VK4WIP website! We are excited to share news, events, and information about amateur radio in the Ipswich area.'

docker-compose run --rm wpcli post create \
  --post_title='Digital Interest Group Meeting' \
  --post_status=publish \
  --post_content='Join us for our monthly Digital Interest Group meeting on the first Monday of each month at 7:30 PM.'

docker-compose run --rm wpcli post create \
  --post_title='Foundation License Course Starting Soon' \
  --post_status=publish \
  --post_content='Our next Foundation License course is starting soon. Contact our training coordinator for more information.'

# Create sample events
echo "  - Creating sample events..."
docker-compose run --rm wpcli post create \
  --post_type=event \
  --post_title='Digital Interest Group Meeting' \
  --post_status=publish \
  --post_content='Monthly meeting for digital modes enthusiasts. Discuss D-Star, DMR, P25, and more.' \
  --meta_input='{"_vk4wip_event_date":"2025-02-03","_vk4wip_event_time":"19:30","_vk4wip_event_location":"Club House","_vk4wip_event_featured":"1"}'

docker-compose run --rm wpcli post create \
  --post_type=event \
  --post_title='Social Meeting' \
  --post_status=publish \
  --post_content='Casual gathering with presentations and activities for all members.' \
  --meta_input='{"_vk4wip_event_date":"2025-02-10","_vk4wip_event_time":"19:30","_vk4wip_event_location":"Club House","_vk4wip_event_featured":"0"}'

docker-compose run --rm wpcli post create \
  --post_type=event \
  --post_title='Business Meeting' \
  --post_status=publish \
  --post_content='Monthly business meeting for club planning and member discussions.' \
  --meta_input='{"_vk4wip_event_date":"2025-02-24","_vk4wip_event_time":"19:30","_vk4wip_event_location":"Club House","_vk4wip_event_featured":"0"}'

# Create sample repeaters
echo "  - Creating sample repeaters..."
docker-compose run --rm wpcli post create \
  --post_type=repeater \
  --post_title='VK4RAI 2m Repeater' \
  --post_status=publish \
  --post_content='Primary 2m repeater covering Ipswich and surrounding areas.' \
  --meta_input='{"_vk4wip_repeater_callsign":"VK4RAI","_vk4wip_repeater_frequency":"146.900","_vk4wip_repeater_offset":"-600 kHz","_vk4wip_repeater_tone":"91.5","_vk4wip_repeater_location":"The Knobby","_vk4wip_repeater_coverage":"Ipswich, Brisbane West"}'

docker-compose run --rm wpcli post create \
  --post_type=repeater \
  --post_title='VK4RWM 70cm Repeater' \
  --post_status=publish \
  --post_content='70cm repeater with excellent coverage of the Ipswich region.' \
  --meta_input='{"_vk4wip_repeater_callsign":"VK4RWM","_vk4wip_repeater_frequency":"438.375","_vk4wip_repeater_offset":"-5 MHz","_vk4wip_repeater_tone":"91.5","_vk4wip_repeater_location":"Raymonds Hill","_vk4wip_repeater_coverage":"Ipswich, Scenic Rim"}'

docker-compose run --rm wpcli post create \
  --post_type=repeater \
  --post_title='VK4RBX 70cm Repeater' \
  --post_status=publish \
  --post_content='70cm repeater providing coverage to southern areas.' \
  --meta_input='{"_vk4wip_repeater_callsign":"VK4RBX","_vk4wip_repeater_frequency":"439.975","_vk4wip_repeater_offset":"-5 MHz","_vk4wip_repeater_tone":"91.5","_vk4wip_repeater_location":"Spring Mountain","_vk4wip_repeater_coverage":"Ipswich South, Logan"}'

docker-compose run --rm wpcli post create \
  --post_type=repeater \
  --post_title='VK4RIL 6m Repeater' \
  --post_status=publish \
  --post_content='6m repeater for long-distance communications.' \
  --meta_input='{"_vk4wip_repeater_callsign":"VK4RIL","_vk4wip_repeater_frequency":"53.850","_vk4wip_repeater_offset":"-1 MHz","_vk4wip_repeater_tone":"91.5","_vk4wip_repeater_location":"Ipswich","_vk4wip_repeater_coverage":"Wide area coverage"}'

echo -e "${GREEN}✓ Sample content created${NC}"
echo ""

echo -e "${BLUE}Step 7: Setting up menus...${NC}"
# Create primary menu
docker-compose run --rm wpcli menu create "Primary Menu"
docker-compose run --rm wpcli menu location assign primary-menu primary

# Add pages to menu
docker-compose run --rm wpcli menu item add-post primary-menu 1 --title="Home"
docker-compose run --rm wpcli menu item add-post primary-menu 2 --title="Membership"
docker-compose run --rm wpcli menu item add-post primary-menu 3 --title="Training"
docker-compose run --rm wpcli menu item add-post primary-menu 4 --title="Repeaters"
docker-compose run --rm wpcli menu item add-custom primary-menu "Events" /events
docker-compose run --rm wpcli menu item add-post primary-menu 5 --title="WICEN"
docker-compose run --rm wpcli menu item add-post primary-menu 6 --title="Contact"

echo -e "${GREEN}✓ Menus configured${NC}"
echo ""

echo -e "${BLUE}Step 8: Configuring theme settings...${NC}"
# Set site tagline
docker-compose run --rm wpcli option update blogdescription "Using and promoting Amateur (HAM) Radio in the Ipswich and surrounding areas since 1962"

# Set permalink structure
docker-compose run --rm wpcli rewrite structure '/%postname%/'
docker-compose run --rm wpcli rewrite flush

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
echo -e "${YELLOW}Next steps:${NC}"
echo "  1. Visit ${SITE_URL} to see your homepage"
echo "  2. Login to ${SITE_URL}/wp-admin"
echo "  3. Go to Appearance → Customize to configure theme settings"
echo "  4. Add featured images to posts and events"
echo "  5. Customize hero section, contact info, and social media links"
echo ""
echo -e "${BLUE}To stop the containers:${NC}"
echo "  docker-compose down"
echo ""
echo -e "${BLUE}To restart the containers:${NC}"
echo "  docker-compose up -d"
echo ""
echo "=========================================="
