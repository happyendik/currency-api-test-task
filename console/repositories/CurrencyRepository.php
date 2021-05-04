<?php

namespace console\repositories;

use console\entities\Currency;
use console\models\Currency as CurrencyModel;
use Yii;
use yii\base\InvalidConfigException;

/**
 * Class CurrencyRepository
 * @package console\repositories
 */
class CurrencyRepository
{
    /**
     * @param Currency $entity
     * @throws InvalidConfigException
     */
    public function persist(Currency $entity)
    {
        $model = CurrencyModel::find()
            ->byName($entity->name())
            ->one();

        if (!$model) {
            $model = new CurrencyModel();
            $model->name = $entity->name();
        }

        $model->rate = $entity->rate();

        if (!$model->save()) {
            Yii::error($model->getErrors());
        }
    }
}
