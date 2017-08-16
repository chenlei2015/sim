<?php

namespace app\models\ticket;

use Yii;

/**
 * This is the model class for table "{{%buy}}".
 *
 * @property integer $id
 * @property integer $qi
 * @property string $hao
 * @property integer $wan
 * @property integer $wan_bei
 * @property integer $qian
 * @property integer $qian_bei
 * @property integer $bai
 * @property integer $bai_bei
 * @property integer $shi
 * @property integer $shi_bei
 * @property integer $ge
 * @property integer $ge_bei
 */
class Buy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%buy}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'qi', 'hao'], 'required'],
            [['id', 'qi', 'wan', 'wan_bei', 'qian', 'qian_bei', 'bai', 'bai_bei', 'shi', 'shi_bei', 'ge', 'ge_bei'], 'integer'],
            [['hao'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'qi' => 'Qi',
            'hao' => 'Hao',
            'wan' => 'Wan',
            'wan_bei' => 'Wan Bei',
            'qian' => 'Qian',
            'qian_bei' => 'Qian Bei',
            'bai' => 'Bai',
            'bai_bei' => 'Bai Bei',
            'shi' => 'Shi',
            'shi_bei' => 'Shi Bei',
            'ge' => 'Ge',
            'ge_bei' => 'Ge Bei',
        ];
    }

    /**
     * @inheritdoc
     * @return BuyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BuyQuery(get_called_class());
    }
}
