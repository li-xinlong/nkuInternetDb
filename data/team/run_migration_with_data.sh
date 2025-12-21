#!/bin/bash
# 标记结构迁移为已执行，然后运行数据迁移

cd "$(dirname "$0")"

echo "=== 步骤1: 标记结构迁移为已执行 ==="
php yii migrate/mark m130524_201442_init --interactive=0
php yii migrate/mark m190124_110200_add_verification_token_column_to_user_table --interactive=0
php yii migrate/mark m251220_031659_create_war_memorial_tables --interactive=0

echo ""
echo "=== 步骤2: 运行剩余迁移（主要是数据迁移）==="
php yii migrate --interactive=0

echo ""
echo "=== 完成 ==="





