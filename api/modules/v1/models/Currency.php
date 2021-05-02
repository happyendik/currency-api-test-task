<?php

namespace api\modules\v1\models;

/**
 * Class Currency
 * @package api\modules\v1\models
 */
class Currency extends \common\models\Currency
{
    /**
     * {@inheritDoc}
     */
    public function fields()
    {
        return [
            'name',
            'rate'
        ];
    }
}
