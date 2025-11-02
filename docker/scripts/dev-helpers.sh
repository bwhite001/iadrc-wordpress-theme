#!/bin/bash

# VK4WIP Theme - Development Helper Functions
# This script provides useful development utilities

# Colors for output
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to display help
show_help() {
    echo "=========================================="
    echo "VK4WIP Theme - Development Helpers"
    echo "=========================================="
    echo ""
    echo "Available commands:"
    echo ""
    echo "  reset-content     - Delete all posts, pages, and custom post types"
    echo "  reset-plugins     - Deactivate and delete all plugins"
    echo "  reset-theme       - Switch to default theme"
    echo "  reset-all         - Complete reset (WARNING: destructive)"
    echo "  export-db         - Export database to /tmp/backup.sql"
    echo "  import-db FILE    - Import database from file"
    echo "  list-users        - List all WordPress users"
    echo "  create-user       - Create a new admin user"
    echo "  flush-cache       - Clear all WordPress caches"
    echo "  check-health      - Run WordPress health checks"
    echo ""
}

# Function to reset content
reset_content() {
    echo -e "${YELLOW}⚠ Resetting all content...${NC}"
    
    # Delete all posts
    wp post delete $(wp post list --post_type=post --format=ids) --force 2>/dev/null || true
    
    # Delete all pages
    wp post delete $(wp post list --post_type=page --format=ids) --force 2>/dev/null || true
    
    # Delete all events
    wp post delete $(wp post list --post_type=event --format=ids) --force 2>/dev/null || true
    
    # Delete all repeaters
    wp post delete $(wp post list --post_type=repeater --format=ids) --force 2>/dev/null || true
    
    echo -e "${GREEN}✓ Content reset complete${NC}"
}

# Function to reset plugins
reset_plugins() {
    echo -e "${YELLOW}⚠ Resetting plugins...${NC}"
    
    # Deactivate all plugins
    wp plugin deactivate --all 2>/dev/null || true
    
    # Delete all plugins except default ones
    wp plugin delete $(wp plugin list --field=name --status=inactive) 2>/dev/null || true
    
    echo -e "${GREEN}✓ Plugins reset complete${NC}"
}

# Function to reset theme
reset_theme() {
    echo -e "${YELLOW}⚠ Resetting theme...${NC}"
    
    # Switch to default theme
    wp theme activate twentytwentyfour 2>/dev/null || wp theme activate twentytwentythree 2>/dev/null || true
    
    echo -e "${GREEN}✓ Theme reset complete${NC}"
}

# Function to complete reset
reset_all() {
    echo -e "${RED}⚠⚠⚠ WARNING: This will delete ALL WordPress data! ⚠⚠⚠${NC}"
    echo -e "${YELLOW}Press Ctrl+C to cancel, or wait 5 seconds to continue...${NC}"
    sleep 5
    
    reset_content
    reset_plugins
    reset_theme
    
    # Delete all menus
    wp menu delete $(wp menu list --format=ids) 2>/dev/null || true
    
    # Reset options
    wp option update blogname "WordPress Site"
    wp option update blogdescription ""
    
    echo -e "${GREEN}✓ Complete reset finished${NC}"
}

# Function to export database
export_db() {
    local backup_file="${1:-/tmp/backup-$(date +%Y%m%d-%H%M%S).sql}"
    echo -e "${BLUE}Exporting database to ${backup_file}...${NC}"
    wp db export "$backup_file"
    echo -e "${GREEN}✓ Database exported to ${backup_file}${NC}"
}

# Function to import database
import_db() {
    local import_file="$1"
    
    if [ -z "$import_file" ]; then
        echo -e "${RED}✗ Please specify a file to import${NC}"
        echo "Usage: import-db /path/to/backup.sql"
        return 1
    fi
    
    if [ ! -f "$import_file" ]; then
        echo -e "${RED}✗ File not found: ${import_file}${NC}"
        return 1
    fi
    
    echo -e "${YELLOW}⚠ Importing database from ${import_file}...${NC}"
    wp db import "$import_file"
    echo -e "${GREEN}✓ Database imported${NC}"
}

# Function to list users
list_users() {
    echo -e "${BLUE}WordPress Users:${NC}"
    wp user list --format=table
}

# Function to create user
create_user() {
    echo -e "${BLUE}Creating new admin user...${NC}"
    read -p "Username: " username
    read -p "Email: " email
    
    wp user create "$username" "$email" --role=administrator --prompt=pass
    echo -e "${GREEN}✓ User created${NC}"
}

# Function to flush cache
flush_cache() {
    echo -e "${BLUE}Flushing all caches...${NC}"
    wp cache flush
    wp rewrite flush
    wp transient delete --all
    echo -e "${GREEN}✓ Caches flushed${NC}"
}

# Function to check health
check_health() {
    echo -e "${BLUE}Running WordPress health checks...${NC}"
    echo ""
    
    echo "WordPress Version:"
    wp core version
    echo ""
    
    echo "Database Status:"
    wp db check
    echo ""
    
    echo "Active Theme:"
    wp theme list --status=active --format=table
    echo ""
    
    echo "Active Plugins:"
    wp plugin list --status=active --format=table
    echo ""
    
    echo "Site URL:"
    wp option get siteurl
    echo ""
    
    echo "Home URL:"
    wp option get home
    echo ""
}

# Main script logic
case "${1:-help}" in
    reset-content)
        reset_content
        ;;
    reset-plugins)
        reset_plugins
        ;;
    reset-theme)
        reset_theme
        ;;
    reset-all)
        reset_all
        ;;
    export-db)
        export_db "$2"
        ;;
    import-db)
        import_db "$2"
        ;;
    list-users)
        list_users
        ;;
    create-user)
        create_user
        ;;
    flush-cache)
        flush_cache
        ;;
    check-health)
        check_health
        ;;
    help|*)
        show_help
        ;;
esac
