#!/usr/bin/env bash
# 一键初始化脚本
set -e

# 0. 进入專案根目录（若腳本位於根目錄可忽略）
# cd "$(dirname "$0")"

echo "==> Installing composer dependencies"
composer install --no-dev --prefer-dist -o

# 若有 .env.example 則自動複製
if [ -f .env.example ] && [ ! -f .env ]; then
  cp .env.example .env
fi

# 1. 生成應用 key（如果項目有相關命令，可自行取消註解）
# php yii key/generate

# 2. 執行所有遷移
echo "==> Running database migrations"
php yii migrate --interactive=0

# 3. (可選)導入演示數據
# echo "==> Seeding demo data"
# php yii db/seed --interactive=0

echo "✓ Project initialized successfully."

