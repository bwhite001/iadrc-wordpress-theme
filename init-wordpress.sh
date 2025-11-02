#!/bin/bash

# VK4WIP Theme - WordPress Initialization Wrapper Script
# This is a legacy wrapper that calls the containerized initialization script
# 
# RECOMMENDED: Use 'make init' instead of running this script directly
#
# This script is kept for backward compatibility but the actual initialization
# now runs inside the wpcli container for better efficiency and reliability.

set -e

echo "=========================================="
echo "VK4WIP Theme - WordPress Setup (Legacy)"
echo "=========================================="
echo ""

# Colors for output
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${YELLOW}⚠️  NOTE: This is the legacy initialization script.${NC}"
echo -e "${YELLOW}   For better performance, use: ${GREEN}make init${NC}"
echo ""
echo -e "${BLUE}Starting Docker containers...${NC}"

# Start containers
docker-compose up -d

echo -e "${GREEN}✓ Containers started${NC}"
echo ""

echo -e "${BLUE}Waiting for containers to be ready...${NC}"
sleep 15
echo -e "${GREEN}✓ Containers ready${NC}"
echo ""

echo -e "${BLUE}Running initialization inside wpcli container...${NC}"
echo ""

# Run the containerized initialization script
if docker exec vk4wip-wpcli /scripts/init-wordpress.sh; then
    echo ""
    echo "=========================================="
    echo -e "${GREEN}✓ Initialization Complete!${NC}"
    echo "=========================================="
    echo ""
    echo -e "${YELLOW}Next time, you can use:${NC}"
    echo -e "  ${GREEN}make start${NC}  # Start containers"
    echo -e "  ${GREEN}make init${NC}   # Initialize WordPress"
    echo ""
else
    echo ""
    echo -e "${RED}✗ Initialization failed!${NC}"
    echo ""
    echo -e "${YELLOW}Troubleshooting:${NC}"
    echo "  1. Check logs: ${GREEN}make logs${NC}"
    echo "  2. Verify containers: ${GREEN}make status${NC}"
    echo "  3. Try manual init: ${GREEN}make init${NC}"
    echo ""
    exit 1
fi
