<?php

namespace common\models\queries;

use common\models\Currency;
use yii\db\ActiveQuery;

/**
 * Class CurrencyQuery
 * @package common\models\queries
 */
class CurrencyQuery extends ActiveQuery
{
    /**
     * {@inheritDoc}
     * @return array|Currency|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * {@inheritDoc}
     * @return array|Currency[]
     */
    public function all($db = null)
    {
        return parent::all($db);
    }
}
