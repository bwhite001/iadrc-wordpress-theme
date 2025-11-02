#!/bin/bash

# VK4WIP WordPress Theme - Docker Development Setup Script
# This script sets up a complete WordPress development environment

set -e

echo "🚀 VK4WIP WordPress Theme - Docker Setup"
echo "=========================================="
echo ""

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Check if Docker is installed
if ! command -v docker &> /dev/null; then
    echo -e "${RED}❌ Docker is not installed. Please install Docker first.${NC}"
    echo "Visit: https://docs.docker.com/get-docker/"
    exit 1
fi

# Check if Docker Compose is installed
if ! command -v docker-compose &> /dev/null && ! docker compose version &> /dev/null; then
    echo -e "${RED}❌ Docker Compose is not installed. Please install Docker Compose first.${NC}"
    echo "Visit: https://docs.docker.com/compose/install/"
    exit 1
fi

echo -e "${GREEN}✓ Docker is installed${NC}"
echo -e "${GREEN}✓ Docker Compose is installed${NC}"
echo ""

# Check if vk4wip-theme directory exists
if [ ! -d "vk4wip-theme" ]; then
    echo -e "${RED}❌ vk4wip-theme directory not found!${NC}"
    echo "Please run this script from the project root directory."
    exit 1
fi

echo -e "${GREEN}✓ Theme directory found${NC}"
echo ""

# Stop any existing containers
echo -e "${BLUE}🛑 Stopping any existing containers...${NC}"
docker-compose down 2>/dev/null || true
echo ""

# Start containers
echo -e "${BLUE}🐳 Starting Docker containers...${NC}"
docker-compose up -d

# Wait for WordPress to be ready
echo ""
echo -e "${YELLOW}⏳ Waiting for WordPress to be ready...${NC}"
sleep 10

# Check if WordPress is responding
MAX_ATTEMPTS=30
ATTEMPT=0
while [ $ATTEMPT -lt $MAX_ATTEMPTS ]; do
    if curl -s http://localhost:8080 > /dev/null; then
        echo -e "${GREEN}✓ WordPress is ready!${NC}"
        break
    fi
    ATTEMPT=$((ATTEMPT + 1))
    echo -n "."
    sleep 2
done

if [ $ATTEMPT -eq $MAX_ATTEMPTS ]; then
    echo -e "${RED}❌ WordPress failed to start. Check logs with: docker-compose logs wordpress${NC}"
    exit 1
fi

echo ""
echo ""
echo -e "${GREEN}=========================================="
echo "✅ Setup Complete!"
echo "==========================================${NC}"
echo ""
echo -e "${BLUE}📍 Access Points:${NC}"
echo ""
echo -e "  ${GREEN}WordPress:${NC}     http://localhost:8080"
echo -e "  ${GREEN}phpMyAdmin:${NC}    http://localhost:8081"
echo ""
echo -e "${BLUE}🔐 Database Credentials:${NC}"
echo ""
echo -e "  ${GREEN}Database:${NC}      wordpress"
echo -e "  ${GREEN}Username:${NC}      wordpress"
echo -e "  ${GREEN}Password:${NC}      wordpress_pass"
echo -e "  ${GREEN}Root Password:${NC} wordpress_root_pass"
echo ""
echo -e "${BLUE}📝 Next Steps:${NC}"
echo ""
echo "  1. Open http://localhost:8080 in your browser"
echo "  2. Complete WordPress installation:"
echo "     - Site Title: VK4WIP: Ipswich and District Radio Club, Inc."
echo "     - Username: admin (or your choice)"
echo "     - Password: (choose a strong password)"
echo "     - Email: your@email.com"
echo ""
echo "  3. After installation:"
echo "     - Go to Appearance → Themes"
echo "     - Activate 'VK4WIP Amateur Radio Club Theme'"
echo ""
echo -e "${BLUE}🛠️  Useful Commands:${NC}"
echo ""
echo "  ${GREEN}View logs:${NC}           docker-compose logs -f wordpress"
echo "  ${GREEN}Stop containers:${NC}     docker-compose down"
echo "  ${GREEN}Restart:${NC}             docker-compose restart"
echo "  ${GREEN}Clean everything:${NC}    docker-compose down -v"
echo "  ${GREEN}WP-CLI:${NC}              docker-compose run --rm wpcli [command]"
echo ""
echo -e "${BLUE}🔧 WP-CLI Examples:${NC}"
echo ""
echo "  ${GREEN}# Activate theme${NC}"
echo "  docker-compose run --rm wpcli theme activate vk4wip-theme"
echo ""
echo "  ${GREEN}# Create admin user${NC}"
echo "  docker-compose run --rm wpcli user create admin admin@example.com --role=administrator"
echo ""
echo "  ${GREEN}# Install plugins${NC}"
echo "  docker-compose run --rm wpcli plugin install advanced-custom-fields --activate"
echo ""
echo -e "${YELLOW}⚠️  Note: Theme files are live-mounted. Changes are reflected immediately!${NC}"
echo ""
