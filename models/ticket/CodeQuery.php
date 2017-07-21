<?php

namespace app\models\ticket;

/**
 * This is the ActiveQuery class for [[Code]].
 *
 * @see Code
 */
class CodeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Code[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Code|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
