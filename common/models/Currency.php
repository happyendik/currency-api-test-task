<?php

namespace common\models;

use common\models\queries\CurrencyQuery;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

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
            ['name', 'string'],
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
