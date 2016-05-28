<?php

use yii\db\Migration;

class m160518_165806_add_table_analysis extends Migration
{
    public function up()
    {
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%analysis}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),

            'url' => $this->string(),
            'text' => $this->text()->notNull(),
            'author' => $this->string()->notNull(),

            'count_all' => $this->smallInteger(),
            'count_c' => $this->smallInteger(),
            'count_p' => $this->smallInteger(),
            'count_kr_pril' => $this->smallInteger(),
            'count_infinitiv' => $this->smallInteger(),
            'count_g' => $this->smallInteger(),
            'count_deeprichastie' => $this->smallInteger(),
            'count_prichastie' => $this->smallInteger(),
            'count_kr_prichastie' => $this->smallInteger(),
            'count_chisl_k' => $this->smallInteger(),
            'count_chisl_p' => $this->smallInteger(),
            'count_ms' => $this->smallInteger(),
            'count_ms_pred' => $this->smallInteger(),
            'count_ms_p' => $this->smallInteger(),
            'count_narechie' => $this->smallInteger(),
            'count_predikativ' => $this->smallInteger(),
            'count_predlog' => $this->smallInteger(),
            'count_souz' => $this->smallInteger(),
            'count_megd' => $this->smallInteger(),
            'count_chast' => $this->smallInteger(),
            'count_vvodn' => $this->smallInteger(),
            'count_fraz' => $this->smallInteger(),
        ], $tableOptions);

        $this->addForeignKey('fk-user', '{{%analysis}}', 'user_id', '{{%user}}', 'id', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
        $this->dropForeignKey('fk-user', '{{%analysis}}');
        $this->dropTable('{{%analysis}}');
    }
}
