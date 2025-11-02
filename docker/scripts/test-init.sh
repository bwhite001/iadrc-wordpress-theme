#!/bin/bash

# VK4WIP Theme - WordPress Initialization Test Script
# This script verifies that WordPress has been properly initialized

set -e

echo "=========================================="
echo "VK4WIP Theme - Testing WordPress Setup"
echo "=========================================="
echo ""

# Colors for output
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

TESTS_PASSED=0
TESTS_FAILED=0

# Helper function to run tests
run_test() {
    local test_name="$1"
    local test_command="$2"
    
    echo -n "Testing: ${test_name}... "
    
    if eval "$test_command" > /dev/null 2>&1; then
        echo -e "${GREEN}✓ PASS${NC}"
        TESTS_PASSED=$((TESTS_PASSED + 1))
        return 0
    else
        echo -e "${RED}✗ FAIL${NC}"
        TESTS_FAILED=$((TESTS_FAILED + 1))
        return 1
    fi
}

echo -e "${BLUE}Running WordPress initialization tests...${NC}"
echo ""

# Test 1: WordPress is installed
run_test "WordPress is installed" "wp core is-installed"

# Test 2: Database connection
run_test "Database connection" "wp db check"

# Test 3: VK4WIP theme is active
run_test "VK4WIP theme is active" "wp theme list --status=active --field=name | grep -q 'vk4wip-theme'"

# Test 4: Contact Form 7 plugin is installed and active
run_test "Contact Form 7 plugin" "wp plugin list --status=active --field=name | grep -q 'contact-form-7'"

# Test 5: Advanced Custom Fields plugin is installed and active
run_test "Advanced Custom Fields plugin" "wp plugin list --status=active --field=name | grep -q 'advanced-custom-fields'"

# Test 6: Yoast SEO plugin is installed and active
run_test "Yoast SEO plugin" "wp plugin list --status=active --field=name | grep -q 'wordpress-seo'"

# Test 7: Sample pages exist
run_test "Sample pages created" "[ \$(wp post list --post_type=page --format=count) -ge 5 ]"

# Test 8: Sample posts exist
run_test "Sample posts created" "[ \$(wp post list --post_type=post --format=count) -ge 3 ]"

# Test 9: Custom post types registered
run_test "Event post type registered" "wp post-type list --field=name | grep -q 'event'"
run_test "Repeater post type registered" "wp post-type list --field=name | grep -q 'repeater'"

# Test 10: Permalink structure
run_test "Permalink structure set" "wp rewrite list --format=count | grep -q '[0-9]'"

# Test 11: Site options
run_test "Site title set" "wp option get blogname | grep -q 'VK4WIP'"
run_test "Site tagline set" "wp option get blogdescription | grep -q 'Amateur'"

echo ""
echo "=========================================="
echo -e "${BLUE}Test Results${NC}"
echo "=========================================="
echo -e "${GREEN}Passed: ${TESTS_PASSED}${NC}"
echo -e "${RED}Failed: ${TESTS_FAILED}${NC}"
echo ""

if [ $TESTS_FAILED -eq 0 ]; then
    echo -e "${GREEN}✓ All tests passed! WordPress is properly initialized.${NC}"
    exit 0
else
    echo -e "${RED}✗ Some tests failed. Please check the initialization.${NC}"
    exit 1
fi
