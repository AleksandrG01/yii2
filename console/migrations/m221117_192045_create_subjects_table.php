<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subjects}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%statuses}}`
 */
class m221117_192045_create_subjects_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%subjects}}', [
            'id' => $this->primaryKey(),
            'status_id' => $this->integer()->Null(),
            'subject' => $this->string()->Null(),
            'okato' => $this->integer()->Null(),
            'population' => $this->integer()->Null(),
            'population_rising' => $this->integer()->Null(),
            'territory' => $this->integer()->Null(),
            'administrative_center' => $this->string()->Null(),
            'gerb' => $this->string()->Null(),
            'created_at' => $this->timestamp()->null(),
            'updated_at' => $this->timestamp()->null(),
        ]);

        // creates index for column `status_id`
        $this->createIndex(
            '{{%idx-subjects-status_id}}',
            '{{%subjects}}',
            'status_id'
        );

        // add foreign key for table `{{%statuses}}`
        $this->addForeignKey(
            '{{%fk-subjects-status_id}}',
            '{{%subjects}}',
            'status_id',
            '{{%statuses}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%statuses}}`
        $this->dropForeignKey(
            '{{%fk-subjects-status_id}}',
            '{{%subjects}}'
        );

        // drops index for column `status_id`
        $this->dropIndex(
            '{{%idx-subjects-status_id}}',
            '{{%subjects}}'
        );

        $this->dropTable('{{%subjects}}');
    }
}
