<?php

namespace app\models\fund;

use Yii;

/**
 * This is the model class for table "{{%fund}}".
 *
 * @property integer $id
 * @property string $one_week
 * @property string $one_month
 * @property string $three_month
 * @property string $six_month
 * @property string $one_year
 * @property string $two_year
 * @property string $three_year
 */
class Fund extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fund}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['one_week', 'one_month', 'three_month', 'six_month', 'one_year', 'two_year', 'three_year'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'one_week' => 'One Week',
            'one_month' => 'One Month',
            'three_month' => 'Three Month',
            'six_month' => 'Six Month',
            'one_year' => 'One Year',
            'two_year' => 'Two Year',
            'three_year' => 'Three Year',
        ];
    }

    /**
     * @inheritdoc
     * @return FundQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FundQuery(get_called_class());
    }
}
