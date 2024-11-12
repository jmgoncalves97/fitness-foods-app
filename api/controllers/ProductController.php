<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\web\Response;

class ProductController extends ActiveController
{
    public $modelClass = 'app\models\Product';

    // https://www.yiiframework.com/doc/guide/2.0/en/rest-response-formatting
    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }
}