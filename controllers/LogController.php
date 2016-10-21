<?php
/**
 * Created by PhpStorm.
 * User: chenl
 * Date: 2016/9/20
 * Time: 10:46
 */

namespace app\controllers;

use yii\web\Controller;
use Yii;
class LogController extends Controller
{
     public function actionIndex(){
         \Yii::info('测试一下8899','test');
         \Yii::warning('测试一下898','test');
         \Yii::error('测试一下898','test');
         \Yii::trace('不要给我找事898','test');
         return $this->render('index');
     }
}