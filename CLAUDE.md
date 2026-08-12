# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

**CSS (Tailwind):**
- `npm run dev` - Watch and recompile CSS during development
- `npm run build` - Minify and compile CSS for production

**PHP linting/analysis:**
- `composer lint` - Check PHP against WordPress Coding Standards (PHPCS)
- `composer format` - Auto-fix PHP formatting (PHPCBF)
- `composer analyse` - Run PHPStan static analysis (level 5)

There are no JS build steps — `source/js/herd-cos-posters.js` must be manually copied to `js/` when changed.

## Architecture

This is a **WordPress plugin** that provides two shortcodes for Marshall University's College of Science poster printing service.

### Shortcodes

- `[mucos-poster-calculator]` — Interactive Alpine.js cost calculator. Fetches pricing from `https://netapps.marshall.edu/cosweb/posters/getPrices.php?w=[width]&h=[height]` based on user-entered dimensions.
- `[mucos-poster-prices]` — Static pricing table. Fetches media info from `https://netapps.marshall.edu/cosweb/posters/getMedia.php`.

Both shortcodes are registered in `herd-cos-posters.php`.

### Frontend

- **Tailwind CSS v4** — CSS-first config lives in `source/css/herd-cos-posters.css`. Uses `mcp:` prefix on all utility classes to avoid WordPress conflicts (e.g., `mcp:flex`, `mcp:text-lg`). Compiles to `css/herd-cos-posters.css`. Note: the HTML output in the shortcodes currently uses unprefixed classes (e.g., `flex`, `w-1/2`) that come from the WordPress theme's CSS — new classes added to shortcode HTML should use the `mcp:` prefix.
- **Alpine.js** — The plugin does **not** enqueue Alpine.js; it is provided by the WordPress theme. The `[mucos-poster-calculator]` shortcode uses inline `x-data` in the PHP output rather than the `HerdCosPosters` component defined in `source/js/herd-cos-posters.js`.

### PHP Standards

WordPress Coding Standards are enforced by PHPCS (`phpcs.xml.dist`). A pre-commit hook (via `lefthook.yml`) runs `composer lint` automatically.
