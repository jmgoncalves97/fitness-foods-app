<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $code
 * @property string $status
 * @property string $imported_t
 * @property string $url
 * @property string $creator
 * @property int $created_t
 * @property int $last_modified_t
 * @property string $product_name
 * @property string $quantity
 * @property string $brands
 * @property string $categories
 * @property string $labels
 * @property string $purchase_places
 * @property string $stores
 * @property string $ingredients_text
 * @property string $traces
 * @property string $serving_size
 * @property float $serving_quantity
 * @property int $nutriscore_score
 * @property string $nutriscore_grade
 * @property string $main_category
 * @property string $image_url
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'imported_t', 'url', 'creator', 'created_t', 'last_modified_t', 'product_name', 'quantity', 'brands', 'categories', 'labels', 'purchase_places', 'stores', 'ingredients_text', 'traces', 'serving_size', 'serving_quantity', 'nutriscore_score', 'nutriscore_grade', 'main_category', 'image_url'], 'required'],
            [['imported_t'], 'safe'],
            [['created_t', 'last_modified_t', 'nutriscore_score'], 'default', 'value' => null],
            [['created_t', 'last_modified_t', 'nutriscore_score'], 'integer'],
            [['ingredients_text'], 'string'],
            [['serving_quantity'], 'number'],
            [['status', 'url', 'creator', 'product_name', 'quantity', 'brands', 'categories', 'labels', 'purchase_places', 'stores', 'traces', 'serving_size', 'nutriscore_grade', 'main_category', 'image_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'status' => 'Status',
            'imported_t' => 'Imported T',
            'url' => 'Url',
            'creator' => 'Creator',
            'created_t' => 'Created T',
            'last_modified_t' => 'Last Modified T',
            'product_name' => 'Product Name',
            'quantity' => 'Quantity',
            'brands' => 'Brands',
            'categories' => 'Categories',
            'labels' => 'Labels',
            'purchase_places' => 'Purchase Places',
            'stores' => 'Stores',
            'ingredients_text' => 'Ingredients Text',
            'traces' => 'Traces',
            'serving_size' => 'Serving Size',
            'serving_quantity' => 'Serving Quantity',
            'nutriscore_score' => 'Nutriscore Score',
            'nutriscore_grade' => 'Nutriscore Grade',
            'main_category' => 'Main Category',
            'image_url' => 'Image Url',
        ];
    }
}
