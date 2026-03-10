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

There are no JS build steps — `source/js/mu-cos-posters.js` is copied as-is to `js/`.

## Architecture

This is a **WordPress plugin** that provides two shortcodes for Marshall University's College of Science poster printing service.

### Shortcodes

- `[mucos-poster-calculator]` — Interactive Alpine.js cost calculator. Fetches pricing from `https://netapps.marshall.edu/cosweb/posters/getPrices.php?w=[width]&h=[height]` based on user-entered dimensions.
- `[mucos-poster-prices]` — Static pricing table. Fetches media info from `https://netapps.marshall.edu/cosweb/posters/getMedia.php`.

Both shortcodes are registered in `mu-cos-posters.php`.

### Frontend

- **Tailwind CSS v4** — CSS-first config lives in `source/css/mu-cos-posters.css`. Uses `mcp:` prefix on all utility classes to avoid WordPress conflicts (e.g., `mcp:flex`, `mcp:text-lg`). Compiles to `css/mu-cos-posters.css`.
- **Alpine.js** — All interactivity via `x-data`, `x-model`, etc. Data component `muCosPosters` is defined in `source/js/mu-cos-posters.js`.

### PHP Standards

WordPress Coding Standards are enforced by PHPCS (`phpcs.xml.dist`). A pre-commit hook (via `lefthook.yml`) runs `composer lint` automatically.
