<?php
use Migrations\AbstractMigration;

class Nogbeter extends AbstractMigration
{

    public function up()
    {

        $this->table('messages')
            ->removeColumn('ends')
            ->changeColumn('start_date', 'date', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->update();

        $this->table('messages')
            ->addColumn('last_played', 'datetime', [
                'after' => 'created',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('messages')
            ->addColumn('ends', 'date', [
                'after' => 'created',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->changeColumn('start_date', 'date', [
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->removeColumn('last_played')
            ->update();
    }
}

