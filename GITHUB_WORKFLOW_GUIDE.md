# GitHub Workflow Guide for VK4WIP Theme

This guide explains how to use the GitHub Actions workflows to automatically build and release your WordPress theme.

---

## 📦 Workflows Included

### 1. **Build Theme Workflow** (`build-theme.yml`)
Automatically builds the theme on every push and pull request.

**Triggers:**
- Push to `main` or `master` branch
- Pull requests to `main` or `master`
- Manual trigger via GitHub Actions UI
- Tag pushes (for releases)

**What it does:**
- Checks out the code
- Extracts version from `style.css`
- Creates clean theme directory
- Removes development files
- Creates zip file
- Uploads as artifact (available for 30 days)
- Creates GitHub release (if triggered by tag)

### 2. **Release Workflow** (`release.yml`)
Creates official releases when you push a version tag.

**Triggers:**
- Push tags matching `v*.*.*` (e.g., `v1.0.0`, `v1.2.3`)

**What it does:**
- Verifies version in `style.css` matches tag
- Creates clean build
- Generates changelog
- Creates GitHub release with:
  - Release notes
  - Installation instructions
  - Downloadable zip file

---

## 🚀 How to Use

### Initial Setup

1. **Push your code to GitHub:**
   ```bash
   git init
   git add .
   git commit -m "Initial commit: VK4WIP WordPress Theme"
   git branch -M main
   git remote add origin https://github.com/YOUR_USERNAME/vk4wip-wordpress-theme.git
   git push -u origin main
   ```

2. **Workflows are automatically enabled** when you push the `.github/workflows/` directory.

---

### Creating a Development Build

**Every time you push to main:**
```bash
git add .
git commit -m "Update theme features"
git push origin main
```

**Result:**
- Workflow runs automatically
- Build artifact available in GitHub Actions tab
- Download zip from: `Actions` → `Build WordPress Theme` → Latest run → `Artifacts`

---

### Creating an Official Release

#### Step 1: Update Version Number

Edit `vk4wip-theme/style.css`:
```css
Version: 1.0.1
```

#### Step 2: Commit Changes
```bash
git add vk4wip-theme/style.css
git commit -m "Bump version to 1.0.1"
git push origin main
```

#### Step 3: Create and Push Tag
```bash
# Create tag (must match version in style.css)
git tag -a v1.0.1 -m "Release version 1.0.1"

# Push tag to GitHub
git push origin v1.0.1
```

#### Step 4: Release is Created Automatically
- Go to GitHub → Releases
- New release appears with:
  - Version number
  - Installation instructions
  - Downloadable zip file
  - Changelog (if CHANGELOG.md exists)

---

## 📋 Version Numbering

Follow [Semantic Versioning](https://semver.org/):

- **Major** (1.0.0 → 2.0.0): Breaking changes
- **Minor** (1.0.0 → 1.1.0): New features, backwards compatible
- **Patch** (1.0.0 → 1.0.1): Bug fixes, backwards compatible

**Examples:**
- `v1.0.0` - Initial release
- `v1.0.1` - Bug fix
- `v1.1.0` - New feature (Phase 3 complete)
- `v1.2.0` - Another feature (Phase 4 complete)
- `v2.0.0` - Major redesign

---

## 🔍 Checking Build Status

### Via GitHub Web Interface:
1. Go to your repository on GitHub
2. Click `Actions` tab
3. See all workflow runs
4. Click on a run to see details
5. Download artifacts from successful builds

### Via Command Line:
```bash
# Install GitHub CLI
# https://cli.github.com/

# Check workflow status
gh run list

# View specific run
gh run view RUN_ID

# Download artifact
gh run download RUN_ID
```

---

## 📥 Downloading Built Theme

### From GitHub Actions (Development Builds):
1. Go to `Actions` tab
2. Click on latest `Build WordPress Theme` run
3. Scroll to `Artifacts` section
4. Download `vk4wip-theme-X.X.X.zip`

### From Releases (Official Releases):
1. Go to `Releases` tab (or `Code` → `Releases`)
2. Click on desired version
3. Download `vk4wip-theme-X.X.X.zip` from Assets
4. Install in WordPress

---

## 🛠️ Customizing Workflows

### Change Build Triggers

Edit `.github/workflows/build-theme.yml`:
```yaml
on:
  push:
    branches:
      - main
      - develop  # Add more branches
  pull_request:
    branches:
      - main
```

### Add Build Steps

Add steps before creating zip:
```yaml
- name: Run tests
  run: |
    # Add your test commands
    phpunit
    npm test

- name: Minify CSS
  run: |
    npm install -g csso-cli
    csso vk4wip-theme/assets/css/*.css
```

### Change Artifact Retention

Default is 30 days. Change in workflow:
```yaml
- name: Upload artifact
  uses: actions/upload-artifact@v4
  with:
    retention-days: 90  # Keep for 90 days
```

---

## 📝 Creating a Changelog

Create `CHANGELOG.md` in root directory:

```markdown
# Changelog

All notable changes to VK4WIP Theme will be documented in this file.

## [1.0.1] - 2025-01-XX

### Added
- Custom hero section
- Events listing on homepage
- Repeater information cards

### Fixed
- Mobile menu toggle issue
- Logo positioning on tablet

### Changed
- Updated color scheme
- Improved responsive design

## [1.0.0] - 2025-01-XX

### Added
- Initial release
- Custom header with overlapping logo
- Gold menu bar
- Custom footer
- Events and Repeaters custom post types
```

The release workflow will automatically include this in release notes.

---

## 🐛 Troubleshooting

### Build Fails

**Check workflow logs:**
1. Go to `Actions` tab
2. Click failed run
3. Click on failed job
4. Expand failed step
5. Read error message

**Common issues:**
- Version mismatch between tag and style.css
- Missing files
- Syntax errors in workflow YAML

### Version Mismatch Error

```
Error: Version in style.css (1.0.0) doesn't match tag (1.0.1)
```

**Fix:**
1. Update version in `style.css`
2. Commit and push
3. Delete and recreate tag:
   ```bash
   git tag -d v1.0.1
   git push origin :refs/tags/v1.0.1
   git tag -a v1.0.1 -m "Release 1.0.1"
   git push origin v1.0.1
   ```

### Workflow Not Running

**Check:**
1. Workflows are in `.github/workflows/` directory
2. YAML syntax is correct (use YAML validator)
3. GitHub Actions are enabled in repository settings
4. You have push access to repository

---

## 🔐 Security Notes

### GitHub Token

Workflows use `GITHUB_TOKEN` automatically provided by GitHub.
- No setup required
- Scoped to repository
- Expires after workflow run

### Secrets

If you need to add secrets (API keys, etc.):
1. Go to repository `Settings`
2. Click `Secrets and variables` → `Actions`
3. Click `New repository secret`
4. Add secret name and value
5. Use in workflow: `${{ secrets.SECRET_NAME }}`

---

## 📊 Workflow Status Badge

Add to README.md:

```markdown
![Build Status](https://github.com/YOUR_USERNAME/vk4wip-wordpress-theme/workflows/Build%20WordPress%20Theme/badge.svg)
```

Replace `YOUR_USERNAME` with your GitHub username.

---

## 🎯 Quick Reference

### Create Development Build
```bash
git add .
git commit -m "Your changes"
git push origin main
```
→ Download from Actions tab

### Create Release
```bash
# 1. Update version in style.css
# 2. Commit and push
git add vk4wip-theme/style.css
git commit -m "Bump version to X.X.X"
git push origin main

# 3. Create and push tag
git tag -a vX.X.X -m "Release X.X.X"
git push origin vX.X.X
```
→ Download from Releases tab

### Delete Tag (if mistake)
```bash
# Local
git tag -d vX.X.X

# Remote
git push origin :refs/tags/vX.X.X
```

---

## 📚 Additional Resources

- [GitHub Actions Documentation](https://docs.github.com/en/actions)
- [Workflow Syntax](https://docs.github.com/en/actions/reference/workflow-syntax-for-github-actions)
- [GitHub CLI](https://cli.github.com/)
- [Semantic Versioning](https://semver.org/)

---

## ✅ Checklist for First Release

- [ ] Code pushed to GitHub
- [ ] Workflows in `.github/workflows/` directory
- [ ] Version in `style.css` is correct
- [ ] CHANGELOG.md created (optional)
- [ ] README.md updated
- [ ] Tag created and pushed
- [ ] Release appears in Releases tab
- [ ] Zip file downloads correctly
- [ ] Theme installs in WordPress

---

**Need help?** Check workflow logs in Actions tab or create an issue in the repository.
