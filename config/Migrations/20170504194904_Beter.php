<?php
use Migrations\AbstractMigration;

class Beter extends AbstractMigration
{

    public function up()
    {

        $this->table('messages')
            ->changeColumn('times_planned', 'integer', [
                'default' => '0',
                'limit' => 11,
                'null' => false,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('messages')
            ->changeColumn('times_planned', 'integer', [
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->update();
    }
}

