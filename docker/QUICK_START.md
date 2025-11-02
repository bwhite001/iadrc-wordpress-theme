# Quick Start Guide - Containerized WordPress Initialization

## TL;DR

```bash
# Start containers
make start

# Initialize WordPress (runs inside container)
make init

# Test initialization
make test-init

# Access WordPress
open http://localhost:8080
```

## What Changed?

### Before (Old Method)
- Scripts ran from host machine
- Each WP-CLI command spawned a new container
- Commands: `./init-wordpress.sh`
- Inefficient and slower

### After (New Method)
- Scripts run inside the wpcli container
- Container stays running continuously
- Commands: `make init`
- Faster and more efficient
- Better caching support

## New Workflow

### 1. Start Environment
```bash
make start
```
This starts all Docker containers including the wpcli container which now runs continuously.

### 2. Initialize WordPress
```bash
make init
```
This executes `/scripts/init-wordpress.sh` inside the running wpcli container.

### 3. Verify Setup
```bash
make test-init
```
Runs automated tests to verify everything is working.

### 4. Development
```bash
# Open shell in wpcli container
make wpcli-shell

# Inside the container, you can run wp commands directly:
wp plugin list
wp theme list
wp post list
```

## Available Commands

### Container Management
```bash
make start          # Start all containers
make stop           # Stop all containers
make restart        # Restart all containers
make status         # Show container status
```

### WordPress Initialization
```bash
make init           # Initialize WordPress (NEW - recommended)
make test-init      # Test initialization
make install        # Legacy method (still works)
```

### Development Tools
```bash
make wpcli-shell    # Open shell in wpcli container
make dev-helpers    # Show development utilities
make logs           # View WordPress logs
make logs-all       # View all container logs
```

### Theme & Plugins
```bash
make theme-activate # Activate VK4WIP theme
make theme-list     # List all themes
make plugin-install # Install recommended plugins
make plugin-list    # List all plugins
```

### Database
```bash
make db-export      # Export database
make db-import FILE=backup.sql  # Import database
```

### Debugging
```bash
make debug-on       # Enable debug mode
make debug-off      # Disable debug mode
make cache-clear    # Clear WordPress cache
make rewrite-flush  # Fix permalink issues
```

## Script Locations

All Docker scripts are now in `docker/scripts/`:

- `init-wordpress.sh` - Main initialization (runs in container)
- `test-init.sh` - Test suite
- `wait-for-wordpress.sh` - Health check utility
- `dev-helpers.sh` - Development utilities

## Running Scripts Manually

If you need to run scripts directly:

```bash
# From host machine
docker exec vk4wip-wpcli /scripts/init-wordpress.sh
docker exec vk4wip-wpcli /scripts/test-init.sh
docker exec vk4wip-wpcli /scripts/dev-helpers.sh check-health

# From inside wpcli container
make wpcli-shell
/scripts/init-wordpress.sh
```

## Troubleshooting

### Container Not Running
```bash
make status  # Check if containers are running
make start   # Start if stopped
```

### Scripts Not Found
```bash
# Ensure scripts are executable
chmod +x docker/scripts/*.sh

# Restart to remount
make restart
```

### Permission Errors
The wpcli container now has a dedicated cache volume to prevent permission issues:
```bash
# If issues persist, clean and restart
make clean  # WARNING: Deletes all data
make start
make init
```

### WordPress Not Ready
```bash
# Wait longer after starting
make start
sleep 20
make init
```

## Benefits of New Approach

✅ **Faster** - No container startup overhead for each command  
✅ **Efficient** - Reuses running container  
✅ **Better Caching** - WP-CLI cache persisted in volume  
✅ **Cleaner** - All scripts organized in docker/ folder  
✅ **Testable** - Automated test suite included  
✅ **Flexible** - Easy to add new scripts  

## Migration Notes

If you were using the old `./init-wordpress.sh`:

1. It still works (kept for backward compatibility)
2. But it now calls the containerized version
3. Recommended to use `make init` instead
4. All functionality is the same, just faster

## Examples

### Fresh Setup
```bash
# Clone repo
git clone <repo-url>
cd iadrc-wordpress-theme

# Start and initialize
make start
sleep 15
make init

# Verify
make test-init

# Access
open http://localhost:8080
```

### Reset and Reinitialize
```bash
# Reset content
docker exec vk4wip-wpcli /scripts/dev-helpers.sh reset-content

# Reinitialize
make init

# Test
make test-init
```

### Development Cycle
```bash
# Start environment
make start

# Make changes to theme files
# (changes are live-mounted, no restart needed)

# Test changes in browser
open http://localhost:8080

# Check for errors
make logs

# Run WP-CLI commands as needed
make wpcli-shell
wp cache flush
```

## Need Help?

- Full documentation: `docker/README.md`
- Docker guide: `DOCKER_GUIDE.md`
- Main README: `README.md`
- Show all commands: `make help`
