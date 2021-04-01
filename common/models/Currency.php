<?php

namespace common\models;

use yii\db\ActiveRecord;
use Yii;
use common\models\queries\CurrencyQuery;
use yii\base\InvalidConfigException;

/**
 * Class Currency
 * @package common\models
 *
 * @property int $id
 * @property string $name
 * @property string $rate
 */
class Currency extends ActiveRecord
{
    /**
     * {@inheritDoc}
     */
    public static function tableName()
    {
        return '{{%currency}}';
    }

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            [['name', 'rate'], 'trim'],
            [['name', 'rate'], 'required'],
            ['name', 'unique'],
            ['rate', 'number']
        ];
    }

    /**
     * @return CurrencyQuery
     * @throws InvalidConfigException
     */
    public static function find()
    {
        /** @var CurrencyQuery $query */
        $query = Yii::createObject(CurrencyQuery::class, [get_called_class()]);
        return $query;
    }
}
