#!/bin/bash

# Wait for WordPress to be ready
# This script checks if WordPress is installed and the database is accessible

set -e

echo "Waiting for WordPress to be ready..."

MAX_ATTEMPTS=60
ATTEMPT=0

while [ $ATTEMPT -lt $MAX_ATTEMPTS ]; do
    # Check if WordPress is installed
    if wp core is-installed 2>/dev/null; then
        echo "✓ WordPress is ready!"
        exit 0
    fi
    
    # Check if we can at least connect to the database
    if wp db check 2>/dev/null; then
        echo "✓ Database is accessible, WordPress core files are ready"
        exit 0
    fi
    
    ATTEMPT=$((ATTEMPT + 1))
    echo -n "."
    sleep 2
done

echo ""
echo "✗ WordPress failed to become ready after $MAX_ATTEMPTS attempts"
exit 1
