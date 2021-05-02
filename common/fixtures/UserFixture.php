<?php
namespace common\fixtures;

use common\models\User;
use yii\test\ActiveFixture;

/**
 * Class UserFixture
 * @package common\fixtures
 */
class UserFixture extends ActiveFixture
{
    /**
     * @var string
     */
    public $modelClass = User::class;
}
