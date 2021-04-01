<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%currency}}`.
 */
class m210327_124509_create_currency_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%currency}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'rate' => $this->decimal(25, 15),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%currency}}');
    }
}
