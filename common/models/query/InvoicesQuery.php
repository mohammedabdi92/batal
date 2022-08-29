<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Invoices]].
 *
 * @see \common\models\Invoices
 */
class InvoicesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Invoices[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Invoices|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
