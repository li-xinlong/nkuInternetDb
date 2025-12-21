<?php

use yii\db\Migration;

/**
 * Class m251221_185653_remove_image_columns_from_battle_and_memorial
 * 删除战役表和纪念馆表中的所有图片相关字段
 */
class m251221_185653_remove_image_columns_from_battle_and_memorial extends Migration
{
    public function safeUp()
    {
        // 删除战役表的图片字段
        if ($this->db->getTableSchema('{{%battle}}', true) !== null) {
            if ($this->db->getTableSchema('{{%battle}}')->getColumn('cover_image') !== null) {
                $this->dropColumn('{{%battle}}', 'cover_image');
            }
            if ($this->db->getTableSchema('{{%battle}}')->getColumn('battle_map') !== null) {
                $this->dropColumn('{{%battle}}', 'battle_map');
            }
        }

        // 删除纪念馆表的图片字段
        if ($this->db->getTableSchema('{{%memorial}}', true) !== null) {
            if ($this->db->getTableSchema('{{%memorial}}')->getColumn('cover_image') !== null) {
                $this->dropColumn('{{%memorial}}', 'cover_image');
            }
            if ($this->db->getTableSchema('{{%memorial}}')->getColumn('gallery_images') !== null) {
                $this->dropColumn('{{%memorial}}', 'gallery_images');
            }
        }
    }

    public function safeDown()
    {
        // 回滚：重新添加这些字段
        if ($this->db->getTableSchema('{{%battle}}', true) !== null) {
            if ($this->db->getTableSchema('{{%battle}}')->getColumn('cover_image') === null) {
                $this->addColumn('{{%battle}}', 'cover_image', $this->string(255)->comment('封面图'));
            }
            if ($this->db->getTableSchema('{{%battle}}')->getColumn('battle_map') === null) {
                $this->addColumn('{{%battle}}', 'battle_map', $this->string(255)->comment('战役地图'));
            }
        }

        if ($this->db->getTableSchema('{{%memorial}}', true) !== null) {
            if ($this->db->getTableSchema('{{%memorial}}')->getColumn('cover_image') === null) {
                $this->addColumn('{{%memorial}}', 'cover_image', $this->string(255)->comment('封面图'));
            }
            if ($this->db->getTableSchema('{{%memorial}}')->getColumn('gallery_images') === null) {
                $this->addColumn('{{%memorial}}', 'gallery_images', $this->text()->comment('相册图片JSON'));
            }
        }
    }
}


