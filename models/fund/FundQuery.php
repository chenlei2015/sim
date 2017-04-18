<?php

namespace app\models\fund;

/**
 * This is the ActiveQuery class for [[Fund]].
 *
 * @see Fund
 */
class FundQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Fund[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Fund|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
