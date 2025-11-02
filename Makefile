# VK4WIP WordPress Theme - Development Makefile
# Quick commands for Docker development environment

.PHONY: help start stop restart logs clean install theme-activate plugin-install db-backup db-restore shell wp

# Default target
.DEFAULT_GOAL := help

# Colors
BLUE := \033[0;34m
GREEN := \033[0;32m
YELLOW := \033[1;33m
RED := \033[0;31m
NC := \033[0m

help: ## Show this help message
	@echo "$(BLUE)VK4WIP WordPress Theme - Development Commands$(NC)"
	@echo ""
	@echo "$(GREEN)Usage:$(NC)"
	@echo "  make [command]"
	@echo ""
	@echo "$(GREEN)Available commands:$(NC)"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  $(BLUE)%-20s$(NC) %s\n", $$1, $$2}'
	@echo ""

start: ## Start WordPress development environment
	@echo "$(GREEN)🚀 Starting WordPress development environment...$(NC)"
	@docker-compose up -d
	@echo "$(GREEN)✓ Environment started!$(NC)"
	@echo ""
	@echo "$(BLUE)Access points:$(NC)"
	@echo "  WordPress:  http://localhost:8080"
	@echo "  phpMyAdmin: http://localhost:8081"
	@echo ""

stop: ## Stop WordPress development environment
	@echo "$(YELLOW)🛑 Stopping WordPress development environment...$(NC)"
	@docker-compose down
	@echo "$(GREEN)✓ Environment stopped!$(NC)"

restart: ## Restart WordPress development environment
	@echo "$(YELLOW)🔄 Restarting WordPress development environment...$(NC)"
	@docker-compose restart
	@echo "$(GREEN)✓ Environment restarted!$(NC)"

logs: ## Show WordPress logs (Ctrl+C to exit)
	@docker-compose logs -f wordpress

logs-all: ## Show all container logs (Ctrl+C to exit)
	@docker-compose logs -f

clean: ## Stop and remove all containers, volumes, and data (⚠️  DESTRUCTIVE)
	@echo "$(RED)⚠️  WARNING: This will delete all WordPress data!$(NC)"
	@read -p "Are you sure? [y/N] " -n 1 -r; \
	echo; \
	if [[ $$REPLY =~ ^[Yy]$$ ]]; then \
		echo "$(YELLOW)🗑️  Cleaning up...$(NC)"; \
		docker-compose down -v; \
		echo "$(GREEN)✓ Cleanup complete!$(NC)"; \
	else \
		echo "$(BLUE)Cancelled.$(NC)"; \
	fi

install: ## Run initial WordPress installation
	@echo "$(GREEN)📦 Installing WordPress...$(NC)"
	@./docker-setup.sh

theme-activate: ## Activate VK4WIP theme
	@echo "$(GREEN)🎨 Activating VK4WIP theme...$(NC)"
	@docker-compose run --rm wpcli theme activate vk4wip-theme
	@echo "$(GREEN)✓ Theme activated!$(NC)"

theme-list: ## List all installed themes
	@docker-compose run --rm wpcli theme list

plugin-install: ## Install recommended plugins (ACF, Elementor, Yoast SEO)
	@echo "$(GREEN)🔌 Installing recommended plugins...$(NC)"
	@docker-compose run --rm wpcli plugin install advanced-custom-fields --activate
	@docker-compose run --rm wpcli plugin install elementor --activate
	@docker-compose run --rm wpcli plugin install wordpress-seo --activate
	@echo "$(GREEN)✓ Plugins installed!$(NC)"

plugin-list: ## List all installed plugins
	@docker-compose run --rm wpcli plugin list

db-export: ## Export database to backup file
	@echo "$(GREEN)💾 Exporting database...$(NC)"
	@mkdir -p backups
	@docker-compose run --rm wpcli db export /var/www/html/wp-content/themes/vk4wip-theme/../../backups/backup-$$(date +%Y%m%d-%H%M%S).sql
	@echo "$(GREEN)✓ Database exported to backups/$(NC)"

db-import: ## Import database from backup file (specify FILE=path/to/backup.sql)
	@if [ -z "$(FILE)" ]; then \
		echo "$(RED)❌ Please specify backup file: make db-import FILE=backups/backup.sql$(NC)"; \
		exit 1; \
	fi
	@echo "$(GREEN)📥 Importing database from $(FILE)...$(NC)"
	@docker-compose run --rm wpcli db import $(FILE)
	@echo "$(GREEN)✓ Database imported!$(NC)"

shell: ## Open bash shell in WordPress container
	@docker-compose exec wordpress bash

wp: ## Run WP-CLI command (e.g., make wp ARGS="user list")
	@docker-compose run --rm wpcli $(ARGS)

user-create: ## Create admin user (specify USER=username EMAIL=email@example.com)
	@if [ -z "$(USER)" ] || [ -z "$(EMAIL)" ]; then \
		echo "$(RED)❌ Usage: make user-create USER=admin EMAIL=admin@example.com$(NC)"; \
		exit 1; \
	fi
	@echo "$(GREEN)👤 Creating user $(USER)...$(NC)"
	@docker-compose run --rm wpcli user create $(USER) $(EMAIL) --role=administrator --user_pass=$$(openssl rand -base64 12)
	@echo "$(GREEN)✓ User created! Check output above for password.$(NC)"

status: ## Show status of all containers
	@docker-compose ps

build: ## Rebuild containers (use after changing docker-compose.yml)
	@echo "$(GREEN)🔨 Rebuilding containers...$(NC)"
	@docker-compose build
	@echo "$(GREEN)✓ Rebuild complete!$(NC)"

update: ## Update WordPress core to latest version
	@echo "$(GREEN)⬆️  Updating WordPress...$(NC)"
	@docker-compose run --rm wpcli core update
	@echo "$(GREEN)✓ WordPress updated!$(NC)"

cache-clear: ## Clear WordPress cache
	@echo "$(GREEN)🗑️  Clearing cache...$(NC)"
	@docker-compose run --rm wpcli cache flush
	@echo "$(GREEN)✓ Cache cleared!$(NC)"

rewrite-flush: ## Flush rewrite rules (fixes permalink issues)
	@echo "$(GREEN)🔄 Flushing rewrite rules...$(NC)"
	@docker-compose run --rm wpcli rewrite flush
	@echo "$(GREEN)✓ Rewrite rules flushed!$(NC)"

debug-on: ## Enable WordPress debug mode
	@echo "$(GREEN)🐛 Enabling debug mode...$(NC)"
	@docker-compose run --rm wpcli config set WP_DEBUG true --raw
	@docker-compose run --rm wpcli config set WP_DEBUG_LOG true --raw
	@docker-compose run --rm wpcli config set WP_DEBUG_DISPLAY false --raw
	@echo "$(GREEN)✓ Debug mode enabled! Check wp-content/debug.log$(NC)"

debug-off: ## Disable WordPress debug mode
	@echo "$(GREEN)🐛 Disabling debug mode...$(NC)"
	@docker-compose run --rm wpcli config set WP_DEBUG false --raw
	@echo "$(GREEN)✓ Debug mode disabled!$(NC)"

quick-setup: start ## Quick setup: Start environment and activate theme
	@sleep 5
	@echo "$(GREEN)⏳ Waiting for WordPress to be ready...$(NC)"
	@sleep 10
	@$(MAKE) theme-activate
	@echo ""
	@echo "$(GREEN)✅ Quick setup complete!$(NC)"
	@echo "$(BLUE)Visit http://localhost:8080 to complete WordPress installation$(NC)"
