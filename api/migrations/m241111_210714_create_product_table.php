<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m241111_210714_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product', [
            'code' => $this->primaryKey(),
            'status' => $this->string()->notNull(),
            'imported_t' => $this->timestamp()->notNull(),
            'url' => $this->string()->notNull(),
            'creator' => $this->string()->notNull(),
            'created_t' => $this->integer()->notNull(),
            'last_modified_t' => $this->integer()->notNull(),
            'product_name' => $this->string()->notNull(),
            'quantity' => $this->string()->notNull(),
            'brands' => $this->string()->notNull(),
            'categories' => $this->string()->notNull(),
            'labels' => $this->string()->notNull(),
            'purchase_places' => $this->string()->notNull(),
            'stores' => $this->string()->notNull(),
            'ingredients_text' => $this->text()->notNull(),
            'traces' => $this->string()->notNull(),
            'serving_size' => $this->string()->notNull(),
            'serving_quantity' => $this->decimal(5)->notNull(),
            'nutriscore_score' => $this->integer()->notNull(),
            'nutriscore_grade' => $this->string()->notNull(),
            'main_category' => $this->string()->notNull(),
            'image_url' => $this->string()->notNull(),
        ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('product');
    }
}
