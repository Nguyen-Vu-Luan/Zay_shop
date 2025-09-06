#!/bin/sh
set -e

echo "🚀 Starting Laravel container..."

# Clear cache trước để tránh lỗi cũ
php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Cache lại
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Chạy migrate nếu muốn (comment nếu không cần auto)
# php artisan migrate --force

echo "✅ Laravel is ready!"

exec "$@"
