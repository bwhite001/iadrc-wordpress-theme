# Docker Development Environment Guide

Complete guide for using Docker to develop and test the VK4WIP WordPress theme.

---

## 🚀 Quick Start

### Option 1: Automated Setup (Recommended)
```bash
# Run the setup script
./docker-setup.sh
```

### Option 2: Using Make Commands
```bash
# Start environment
make start

# Wait 10 seconds, then activate theme
make theme-activate
```

### Option 3: Manual Docker Compose
```bash
# Start containers
docker-compose up -d

# Wait for WordPress to be ready
sleep 15

# Activate theme
docker-compose run --rm wpcli theme activate vk4wip-theme
```

---

## 📦 What's Included

### Services

1. **WordPress** (http://localhost:8080)
   - Latest WordPress version
   - Debug mode enabled
   - Theme auto-mounted (live changes)
   - Persistent data storage

2. **MySQL Database** (internal)
   - MySQL 8.0
   - Persistent data storage
   - Health checks enabled

3. **phpMyAdmin** (http://localhost:8081)
   - Database management interface
   - Visual query builder
   - Import/export tools

4. **WP-CLI** (command-line)
   - WordPress command-line interface
   - Theme/plugin management
   - Database operations

---

## 🎯 Common Tasks

### Starting Development

```bash
# Start everything
make start

# Or with docker-compose
docker-compose up -d
```

**Access:**
- WordPress: http://localhost:8080
- phpMyAdmin: http://localhost:8081

### Stopping Development

```bash
# Stop containers (keeps data)
make stop

# Or with docker-compose
docker-compose down
```

### Viewing Logs

```bash
# WordPress logs only
make logs

# All container logs
make logs-all

# Or with docker-compose
docker-compose logs -f wordpress
```

### Restarting Services

```bash
# Restart all services
make restart

# Restart specific service
docker-compose restart wordpress
```

---

## 🎨 Theme Development

### Live Changes

**Your theme files are live-mounted!** Changes are reflected immediately:

```bash
# Edit any file in vk4wip-theme/
vim vk4wip-theme/style.css

# Refresh browser - changes appear instantly!
```

### Activating Theme

```bash
# Using Make
make theme-activate

# Using WP-CLI directly
docker-compose run --rm wpcli theme activate vk4wip-theme

# Via WordPress admin
# Go to Appearance → Themes → Activate VK4WIP
```

### Checking Theme Status

```bash
# List all themes
make theme-list

# Or with WP-CLI
docker-compose run --rm wpcli theme list
```

---

## 🔌 Plugin Management

### Install Recommended Plugins

```bash
# Install ACF, Elementor, Yoast SEO
make plugin-install
```

### Install Individual Plugins

```bash
# Using WP-CLI
docker-compose run --rm wpcli plugin install advanced-custom-fields --activate
docker-compose run --rm wpcli plugin install elementor --activate
docker-compose run --rm wpcli plugin install wordpress-seo --activate
docker-compose run --rm wpcli plugin install contact-form-7 --activate
```

### List Installed Plugins

```bash
# Using Make
make plugin-list

# Using WP-CLI
docker-compose run --rm wpcli plugin list
```

---

## 👤 User Management

### Create Admin User

```bash
# Using Make (generates random password)
make user-create USER=admin EMAIL=admin@example.com

# Using WP-CLI with specific password
docker-compose run --rm wpcli user create admin admin@example.com \
  --role=administrator --user_pass=YourPassword123
```

### List Users

```bash
docker-compose run --rm wpcli user list
```

### Reset Password

```bash
docker-compose run --rm wpcli user update admin --user_pass=NewPassword123
```

---

## 💾 Database Management

### Export Database

```bash
# Using Make (creates timestamped backup)
make db-export

# Backup saved to: backups/backup-YYYYMMDD-HHMMSS.sql
```

### Import Database

```bash
# Using Make
make db-import FILE=backups/backup-20250115-120000.sql

# Using WP-CLI directly
docker-compose run --rm wpcli db import /path/to/backup.sql
```

### Access Database via phpMyAdmin

1. Open http://localhost:8081
2. Login:
   - **Server:** db
   - **Username:** wordpress
   - **Password:** wordpress_pass
3. Select `wordpress` database

### Direct MySQL Access

```bash
# Connect to MySQL
docker-compose exec db mysql -u wordpress -pwordpress_pass wordpress

# Run SQL query
docker-compose exec db mysql -u wordpress -pwordpress_pass wordpress \
  -e "SELECT * FROM wp_posts LIMIT 5;"
```

---

## 🐛 Debugging

### Enable Debug Mode

```bash
# Using Make
make debug-on

# Debug log location: wp-content/debug.log
```

### View Debug Log

```bash
# Tail debug log
docker-compose exec wordpress tail -f /var/www/html/wp-content/debug.log

# View last 50 lines
docker-compose exec wordpress tail -n 50 /var/www/html/wp-content/debug.log
```

### Disable Debug Mode

```bash
make debug-off
```

### Check PHP Errors

```bash
# View PHP error log
docker-compose exec wordpress tail -f /var/log/apache2/error.log
```

---

## 🔧 Advanced Commands

### WP-CLI Commands

```bash
# General format
make wp ARGS="command arguments"

# Examples:
make wp ARGS="user list"
make wp ARGS="post list"
make wp ARGS="option get siteurl"
make wp ARGS="cache flush"
make wp ARGS="rewrite flush"
```

### Shell Access

```bash
# Open bash shell in WordPress container
make shell

# Or with docker-compose
docker-compose exec wordpress bash

# Once inside:
cd wp-content/themes/vk4wip-theme
ls -la
```

### Clear Cache

```bash
# Clear WordPress object cache
make cache-clear

# Or with WP-CLI
docker-compose run --rm wpcli cache flush
```

### Fix Permalinks

```bash
# Flush rewrite rules
make rewrite-flush

# Or with WP-CLI
docker-compose run --rm wpcli rewrite flush
```

### Update WordPress

```bash
# Update to latest version
make update

# Or with WP-CLI
docker-compose run --rm wpcli core update
```

---

## 🗑️ Cleanup

### Stop and Keep Data

```bash
# Stop containers, keep all data
make stop
```

### Remove Everything (⚠️ DESTRUCTIVE)

```bash
# Remove containers, volumes, and all data
make clean

# Or with docker-compose
docker-compose down -v
```

### Remove Only Containers

```bash
# Keep volumes (data persists)
docker-compose down
```

---

## 📊 Monitoring

### Check Container Status

```bash
# Using Make
make status

# Using docker-compose
docker-compose ps

# Using docker
docker ps
```

### Resource Usage

```bash
# Show resource usage
docker stats

# Show disk usage
docker system df
```

### Health Checks

```bash
# Check if WordPress is responding
curl -I http://localhost:8080

# Check if database is ready
docker-compose exec db mysqladmin ping -h localhost -u root -pwordpress_root_pass
```

---

## 🔐 Security Notes

### Default Credentials

**Database:**
- Database: `wordpress`
- Username: `wordpress`
- Password: `wordpress_pass`
- Root Password: `wordpress_root_pass`

**WordPress:**
- Set during installation at http://localhost:8080

**⚠️ WARNING:** These are development credentials only!  
**Never use these in production!**

### Changing Credentials

Edit `docker-compose.yml`:

```yaml
environment:
  MYSQL_ROOT_PASSWORD: your_secure_root_password
  MYSQL_DATABASE: wordpress
  MYSQL_USER: wordpress
  MYSQL_PASSWORD: your_secure_password
```

Then rebuild:
```bash
docker-compose down -v
docker-compose up -d
```

---

## 🚨 Troubleshooting

### Port Already in Use

**Error:** `Bind for 0.0.0.0:8080 failed: port is already allocated`

**Solution:**
```bash
# Find what's using port 8080
lsof -i :8080

# Kill the process or change port in docker-compose.yml
ports:
  - "8090:80"  # Use port 8090 instead
```

### WordPress Not Loading

**Check logs:**
```bash
make logs
```

**Common fixes:**
```bash
# Restart containers
make restart

# Check if database is ready
docker-compose exec db mysqladmin ping -h localhost -u root -pwordpress_root_pass

# Rebuild containers
docker-compose down
docker-compose up -d --build
```

### Theme Not Appearing

**Check theme is mounted:**
```bash
docker-compose exec wordpress ls -la /var/www/html/wp-content/themes/

# Should show vk4wip-theme directory
```

**Activate theme:**
```bash
make theme-activate
```

### Permission Issues

**Fix file permissions:**
```bash
# On host machine
sudo chown -R $USER:$USER vk4wip-theme/

# Inside container
docker-compose exec wordpress chown -R www-data:www-data /var/www/html/wp-content/themes/vk4wip-theme
```

### Database Connection Error

**Check database is running:**
```bash
docker-compose ps db

# Should show "Up" status
```

**Restart database:**
```bash
docker-compose restart db
```

### Out of Memory

**Increase Docker memory:**
- Docker Desktop → Settings → Resources → Memory
- Increase to at least 4GB

---

## 📝 Development Workflow

### Typical Development Session

```bash
# 1. Start environment
make start

# 2. Activate theme (first time only)
make theme-activate

# 3. Install plugins (first time only)
make plugin-install

# 4. Open in browser
open http://localhost:8080

# 5. Edit theme files
vim vk4wip-theme/style.css

# 6. Refresh browser to see changes

# 7. View logs if needed
make logs

# 8. Stop when done
make stop
```

### Testing Changes

```bash
# 1. Make changes to theme files
# 2. Refresh browser (changes are live!)
# 3. Check debug log if issues
docker-compose exec wordpress tail -f /var/www/html/wp-content/debug.log
```

### Before Committing

```bash
# 1. Test theme activation
make theme-activate

# 2. Check for PHP errors
make logs

# 3. Test responsive design
# Open http://localhost:8080 and resize browser

# 4. Export database (optional)
make db-export

# 5. Stop environment
make stop
```

---

## 🎓 Learning Resources

### WP-CLI Documentation
- https://wp-cli.org/
- https://developer.wordpress.org/cli/commands/

### Docker Documentation
- https://docs.docker.com/
- https://docs.docker.com/compose/

### WordPress Development
- https://developer.wordpress.org/
- https://developer.wordpress.org/themes/

---

## 💡 Tips & Tricks

### Faster Startup

```bash
# Keep containers running between sessions
# Just stop/start instead of down/up
make stop   # When done
make start  # Next session
```

### Multiple Environments

```bash
# Copy docker-compose.yml
cp docker-compose.yml docker-compose-dev.yml

# Edit ports in docker-compose-dev.yml
# Then use:
docker-compose -f docker-compose-dev.yml up -d
```

### Backup Before Major Changes

```bash
# Export database
make db-export

# Copy uploads folder
docker cp vk4wip-wordpress:/var/www/html/wp-content/uploads ./backups/uploads-$(date +%Y%m%d)
```

### Quick Reset

```bash
# Nuclear option - start fresh
make clean
make start
# Complete WordPress installation again
```

---

## 📞 Getting Help

### Check Logs First
```bash
make logs
```

### Common Commands
```bash
make help  # Show all available commands
```

### Docker Issues
```bash
docker-compose ps      # Check container status
docker-compose logs    # View all logs
docker system prune    # Clean up Docker
```

---

## ✅ Checklist

### First Time Setup
- [ ] Docker installed
- [ ] Docker Compose installed
- [ ] Run `./docker-setup.sh` or `make start`
- [ ] Complete WordPress installation at http://localhost:8080
- [ ] Activate VK4WIP theme
- [ ] Install recommended plugins
- [ ] Create test content

### Daily Development
- [ ] `make start` - Start environment
- [ ] Edit theme files
- [ ] Refresh browser to see changes
- [ ] `make logs` - Check for errors
- [ ] `make stop` - Stop when done

### Before Deployment
- [ ] Test all features
- [ ] Check responsive design
- [ ] Review debug log
- [ ] Export database backup
- [ ] Test theme activation
- [ ] Verify custom post types work

---

**Happy Developing! 🚀**
