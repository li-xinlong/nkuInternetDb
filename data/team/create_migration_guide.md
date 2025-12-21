# Yii2 数据库迁移使用指南

## 快速开始

### 1. 创建表结构迁移

```bash
cd /home/ys/Desktop/nkuInternetDb/data/team
php yii migrate/create create_your_table_name
```

这会生成一个迁移文件，文件名格式：`m日期时间_create_your_table_name.php`

### 2. 创建数据迁移

```bash
php yii migrate/create insert_your_data_name
```

## 迁移文件结构（基于项目现有模式）

### 表结构迁移模板

参考：`console/migrations/example_create_new_table.php`

```php
<?php

use yii\db\Migration;

class m251220_120000_create_your_table extends Migration
{
    public function safeUp()
    {
        // 检查表是否已存在
        $checkTable = function($tableName) {
            $rawName = $this->db->schema->getRawTableName($tableName);
            return $this->db->getTableSchema($rawName, true) !== null;
        };
        
        if ($checkTable('{{%your_table}}')) {
            echo "表 your_table 已存在，跳过创建\n";
        } else {
            $this->createTable('{{%your_table}}', [
                'id' => $this->primaryKey(),
                'name' => $this->string(100)->notNull()->comment('名称'),
                'status' => $this->tinyInteger()->defaultValue(1)->comment('状态'),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ]);
            
            // 创建索引
            $this->createIndex('idx-your_table-name', '{{%your_table}}', 'name');
        }
    }

    public function safeDown()
    {
        $this->dropTable('{{%your_table}}');
    }
}
```

### 数据迁移模板（从SQL文件导入）

参考：`console/migrations/example_insert_data.php` 和 `m251220_100000_insert_test_data.php`

**步骤1：创建迁移文件**
```bash
php yii migrate/create insert_your_table_data
```

**步骤2：创建SQL数据文件**
在 `console/migrations/` 目录下创建 `your_table_data.sql`，内容格式：

```sql
-- 你的表数据
INSERT INTO `your_table` (`name`, `status`, `created_at`, `updated_at`) VALUES
('数据1', 1, UNIX_TIMESTAMP(), UNIX_TIMESTAMP()),
('数据2', 1, UNIX_TIMESTAMP(), UNIX_TIMESTAMP());
```

**步骤3：在迁移文件中读取SQL文件**
迁移文件会自动读取同目录下的 `your_table_data.sql` 文件并执行。

## 运行迁移

```bash
# 运行所有未应用的迁移
cd /home/ys/Desktop/nkuInternetDb/data/team
php yii migrate --interactive=0

# 或者使用脚本（会自动标记已存在的表）
bash run_migration_with_data.sh
```

## 回滚迁移

```bash
# 回滚最后一个迁移
php yii migrate/down

# 回滚指定数量的迁移
php yii migrate/down 3
```

## 标记迁移为已执行（表已存在时）

如果表已经通过其他方式创建（如直接导入SQL），可以标记迁移为已执行：

```bash
php yii migrate/mark m251220_120000_create_your_table --interactive=0
```

## 最佳实践

1. **表结构迁移和数据迁移分开**
   - 先创建表结构迁移：`create_xxx_table`
   - 再创建数据迁移：`insert_xxx_data`

2. **大量数据使用SQL文件**
   - 超过50条数据建议使用SQL文件
   - SQL文件放在 `console/migrations/` 目录下
   - 文件名与迁移文件对应：`xxx_data.sql`

3. **检查表是否存在**
   - 使用 `$checkTable()` 函数检查表是否存在
   - 避免重复创建导致错误

4. **使用 safeUp() 和 safeDown()**
   - 支持事务回滚
   - 更安全可靠

5. **迁移文件命名规范**
   - 表结构：`create_表名_table` 或 `create_表名`
   - 数据：`insert_表名_data` 或 `insert_数据描述`
   - 修改表：`add_字段名_to_表名`

## 示例：完整流程

假设要创建一个 `product` 表和导入数据：

```bash
# 1. 创建表结构迁移
php yii migrate/create create_product_table

# 2. 编辑生成的迁移文件，定义表结构
# 文件：m251220_120000_create_product_table.php

# 3. 创建数据迁移
php yii migrate/create insert_product_data

# 4. 创建SQL数据文件
# 文件：console/migrations/product_data.sql

# 5. 编辑数据迁移文件，读取SQL文件
# 文件：m251220_120001_insert_product_data.php

# 6. 运行迁移
php yii migrate --interactive=0
```

## 参考文件

- 表结构迁移示例：`console/migrations/example_create_new_table.php`
- 数据迁移示例：`console/migrations/example_insert_data.php`
- 实际表结构迁移：`console/migrations/m251220_031659_create_war_memorial_tables.php`
- 实际数据迁移：`console/migrations/m251220_100000_insert_test_data.php`
- 数据SQL文件：`console/migrations/insert_data.sql`
