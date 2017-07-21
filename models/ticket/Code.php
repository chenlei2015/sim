<?php

namespace app\models\ticket;

use Yii;

/**
 * This is the model class for table "{{%code}}".
 *
 * @property string $id
 * @property string $no
 * @property integer $wan
 * @property integer $wan_type
 * @property integer $qian
 * @property integer $qian_type
 * @property integer $bai
 * @property integer $bai_type
 * @property integer $shi
 * @property integer $shi_type
 * @property integer $ge
 * @property integer $ge_type
 * @property integer $time
 */
class Code extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%code}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no', 'wan', 'wan_type', 'qian', 'qian_type', 'bai', 'bai_type', 'shi', 'shi_type', 'ge', 'ge_type', 'time'], 'required'],
            [['wan', 'wan_type', 'qian', 'qian_type', 'bai', 'bai_type', 'shi', 'shi_type', 'ge', 'ge_type', 'time'], 'integer'],
            [['no'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no' => 'No',
            'wan' => 'Wan',
            'wan_type' => 'Wan Type',
            'qian' => 'Qian',
            'qian_type' => 'Qian Type',
            'bai' => 'Bai',
            'bai_type' => 'Bai Type',
            'shi' => 'Shi',
            'shi_type' => 'Shi Type',
            'ge' => 'Ge',
            'ge_type' => 'Ge Type',
            'time' => 'Time',
        ];
    }

    /**
     * @inheritdoc
     * @return CodeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CodeQuery(get_called_class());
    }
}
