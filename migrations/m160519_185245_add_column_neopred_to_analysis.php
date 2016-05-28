<?php

use yii\db\Migration;

class m160519_185245_add_column_neopred_to_analysis extends Migration
{
    public function up()
    {
        $this->addColumn('{{%analysis}}', 'count_neopred', $this->smallInteger());
    }

    public function down()
    {
        $this->dropColumn('{{%analysis}}', 'count_neopred', $this->smallInteger());
    }
}
