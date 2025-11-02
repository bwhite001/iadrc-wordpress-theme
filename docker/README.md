# Docker Scripts Documentation

This directory contains all Docker-related initialization and development scripts for the VK4WIP WordPress theme.

## Directory Structure

```
docker/
├── scripts/
│   ├── init-wordpress.sh      # Main initialization script (runs inside container)
│   ├── wait-for-wordpress.sh  # Health check utility
│   ├── test-init.sh           # Test initialization
│   └── dev-helpers.sh         # Development utilities
└── README.md                  # This file
```

## Overview

All scripts in this directory are designed to run **inside the wpcli Docker container** after it has started. The wpcli container runs continuously with `tail -f /dev/null`, allowing scripts to be executed inside it using `docker exec`.

## Scripts

### init-wordpress.sh

**Purpose:** Complete WordPress initialization including installation, theme activation, plugin installation, and sample content creation.

**Usage:**
```bash
# From host machine
make init

# Or directly
docker exec vk4wip-wpcli /scripts/init-wordpress.sh
```

**What it does:**
1. Waits for WordPress and database to be ready
2. Installs WordPress core (if not already installed)
3. Activates the VK4WIP theme
4. Installs and activates recommended plugins:
   - Contact Form 7
   - Advanced Custom Fields
   - Yoast SEO
5. Creates sample content:
   - Pages (Membership, Training, Repeaters, WICEN, Contact)
   - Blog posts (3 sample posts)
   - Events (3 sample events)
   - Repeaters (4 sample repeaters)
6. Configures menus
7. Sets up theme settings and permalinks

**Configuration:**
Edit the following variables at the top of the script:
- `SITE_URL` - Default: http://localhost:8080
- `SITE_TITLE` - Default: VK4WIP: Ipswich and District Radio Club
- `ADMIN_USER` - Default: admin
- `ADMIN_PASSWORD` - Default: admin123
- `ADMIN_EMAIL` - Default: admin@vk4wip.local

### wait-for-wordpress.sh

**Purpose:** Utility script to wait for WordPress to be ready before running other commands.

**Usage:**
```bash
docker exec vk4wip-wpcli /scripts/wait-for-wordpress.sh
```

**What it does:**
- Checks if WordPress is installed
- Verifies database connectivity
- Waits up to 60 attempts (2 seconds each)
- Exits with status 0 on success, 1 on failure

### test-init.sh

**Purpose:** Verify that WordPress has been properly initialized.

**Usage:**
```bash
# From host machine
make test-init

# Or directly
docker exec vk4wip-wpcli /scripts/test-init.sh
```

**Tests performed:**
1. WordPress is installed
2. Database connection works
3. VK4WIP theme is active
4. Required plugins are installed and active
5. Sample pages exist
6. Sample posts exist
7. Custom post types are registered (event, repeater)
8. Permalink structure is set
9. Site title and tagline are configured

**Output:**
- Shows pass/fail for each test
- Displays summary of passed and failed tests
- Exits with status 0 if all tests pass, 1 if any fail

### dev-helpers.sh

**Purpose:** Collection of development utilities for managing WordPress.

**Usage:**
```bash
# Show help
make dev-helpers

# Or directly
docker exec vk4wip-wpcli /scripts/dev-helpers.sh [command]
```

**Available commands:**

| Command | Description |
|---------|-------------|
| `reset-content` | Delete all posts, pages, and custom post types |
| `reset-plugins` | Deactivate and delete all plugins |
| `reset-theme` | Switch to default theme |
| `reset-all` | Complete reset (WARNING: destructive) |
| `export-db` | Export database to /tmp/backup.sql |
| `import-db FILE` | Import database from file |
| `list-users` | List all WordPress users |
| `create-user` | Create a new admin user |
| `flush-cache` | Clear all WordPress caches |
| `check-health` | Run WordPress health checks |

**Examples:**
```bash
# Reset all content
docker exec vk4wip-wpcli /scripts/dev-helpers.sh reset-content

# Export database
docker exec vk4wip-wpcli /scripts/dev-helpers.sh export-db

# Check WordPress health
docker exec vk4wip-wpcli /scripts/dev-helpers.sh check-health
```

## Docker Configuration

### docker-compose.yml Changes

The wpcli service has been configured to:

1. **Run continuously:** Uses `tail -f /dev/null` instead of exiting after one command
2. **Mount scripts:** Scripts directory is mounted at `/scripts` (read-only)
3. **Cache directory:** WP-CLI cache is persisted in a volume to avoid permission issues
4. **Home directory:** Set to `/var/www` to ensure WP-CLI can write cache files

```yaml
wpcli:
  image: wordpress:cli
  container_name: vk4wip-wpcli
  volumes:
    - ./docker/scripts:/scripts:ro
    - wpcli_cache:/var/www/.wp-cli/cache
  environment:
    HOME: /var/www
  command: ["tail -f /dev/null"]
```

## Makefile Commands

New commands added to the Makefile:

| Command | Description |
|---------|-------------|
| `make init` | Initialize WordPress inside container (recommended) |
| `make test-init` | Test WordPress initialization |
| `make dev-helpers` | Show development helper commands |
| `make wpcli-shell` | Open shell in wpcli container |

## Workflow

### Initial Setup

1. Start the Docker environment:
   ```bash
   make start
   ```

2. Wait for containers to be ready (~15 seconds)

3. Initialize WordPress:
   ```bash
   make init
   ```

4. Verify initialization:
   ```bash
   make test-init
   ```

5. Access WordPress:
   - Frontend: http://localhost:8080
   - Admin: http://localhost:8080/wp-admin
   - Credentials: admin / admin123

### Development Workflow

1. Make changes to theme files in `vk4wip-theme/`
2. Changes are immediately reflected (live-mounted)
3. Refresh browser to see changes
4. Check logs if needed: `make logs`

### Testing Changes

1. Reset content if needed:
   ```bash
   docker exec vk4wip-wpcli /scripts/dev-helpers.sh reset-content
   ```

2. Re-run initialization:
   ```bash
   make init
   ```

3. Test the changes:
   ```bash
   make test-init
   ```

### Debugging

1. Enable debug mode:
   ```bash
   make debug-on
   ```

2. Check logs:
   ```bash
   make logs
   ```

3. Access wpcli shell:
   ```bash
   make wpcli-shell
   ```

4. Run WP-CLI commands directly:
   ```bash
   wp plugin list
   wp theme list
   wp post list
   ```

## Troubleshooting

### Container Not Running

**Problem:** `docker exec` fails with "container not running"

**Solution:**
```bash
make status  # Check container status
make start   # Start containers if stopped
```

### Permission Issues

**Problem:** WP-CLI cache permission errors

**Solution:** The wpcli_cache volume should handle this automatically. If issues persist:
```bash
docker-compose down -v  # Remove volumes
make start              # Restart
```

### Scripts Not Found

**Problem:** `/scripts/init-wordpress.sh: not found`

**Solution:**
```bash
# Ensure scripts are executable
chmod +x docker/scripts/*.sh

# Restart containers to remount
make restart
```

### WordPress Not Ready

**Problem:** Initialization fails with database errors

**Solution:**
```bash
# Wait longer for WordPress to be ready
sleep 20

# Check WordPress container logs
make logs

# Verify database is running
docker-compose ps
```

## Best Practices

1. **Always use `make init`** instead of the old `./init-wordpress.sh` for new setups
2. **Test after changes** using `make test-init`
3. **Backup before major changes** using `make db-export`
4. **Use dev-helpers** for common tasks instead of manual WP-CLI commands
5. **Check logs** when troubleshooting: `make logs`
6. **Keep scripts executable** with `chmod +x docker/scripts/*.sh`

## Migration from Old Setup

If you were using the old `init-wordpress.sh` in the root directory:

1. Stop containers: `make stop`
2. Update docker-compose.yml (already done)
3. Start containers: `make start`
4. Use new command: `make init` instead of `./init-wordpress.sh`

The old script is kept for backward compatibility but marked as legacy.

## Contributing

When adding new scripts:

1. Place them in `docker/scripts/`
2. Make them executable: `chmod +x docker/scripts/your-script.sh`
3. Add documentation to this README
4. Add Makefile target if appropriate
5. Test inside the wpcli container

## Support

For issues or questions:
- Check logs: `make logs`
- Run health check: `docker exec vk4wip-wpcli /scripts/dev-helpers.sh check-health`
- See main README.md and DOCKER_GUIDE.md
