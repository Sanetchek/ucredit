#!/bin/bash

# Ucredit Theme Development Script
# This script helps with common development tasks

echo "🎨 Ucredit Theme Development Script"
echo "=================================="

case "$1" in
    "css")
        echo "📝 Compiling CSS..."
        npm run compile:css
        echo "✅ CSS compilation complete!"
        ;;
    "rtl")
        echo "🔄 Generating RTL CSS..."
        npm run compile:rtl
        echo "✅ RTL CSS generation complete!"
        ;;
    "js")
        echo "⚡ Minifying JavaScript..."
        npm run minify:js
        echo "✅ JavaScript minification complete!"
        ;;
    "watch")
        echo "👀 Starting CSS watch mode..."
        npm run watch:css
        ;;
    "watch:js")
        echo "⚡ Starting JavaScript watch mode..."
        npm run watch:js
        ;;
    "watch:rtl")
        echo "🔄 Starting RTL CSS watch mode..."
        npm run watch:rtl
        ;;
    "watch:all")
        echo "👀 Starting CSS and JS watch mode..."
        npm run watch:all
        ;;
    "watch:full")
        echo "🚀 Starting full watch mode (CSS, RTL, JS)..."
        npm run watch:full
        ;;
    "build"|"all")
        echo "🚀 Building all assets..."
        npm run build:all
        echo "✅ All assets built successfully!"
        ;;
    "dev")
        echo "🛠️  Building for development..."
        npm run dev
        echo "✅ Development build complete!"
        ;;
    *)
        echo "Usage: ./dev.sh [command]"
        echo ""
        echo "Available commands:"
        echo "  css         - Compile SCSS to CSS"
        echo "  rtl         - Generate RTL CSS"
        echo "  js          - Minify JavaScript"
        echo "  watch       - Watch CSS changes"
        echo "  watch:js    - Watch JavaScript changes"
        echo "  watch:rtl   - Watch RTL CSS changes"
        echo "  watch:all   - Watch CSS and JS changes"
        echo "  watch:full  - Watch all assets (CSS, RTL, JS)"
        echo "  build       - Build all assets"
        echo "  dev         - Development build"
        echo ""
        echo "Examples:"
        echo "  ./dev.sh css         # Compile CSS only"
        echo "  ./dev.sh watch:js    # Watch JavaScript changes"
        echo "  ./dev.sh watch:all   # Watch CSS and JS"
        echo "  ./dev.sh watch:full  # Watch everything"
        echo "  ./dev.sh build       # Build everything"
        ;;
esac