<?php
use Migrations\AbstractMigration;

class FloatJingle extends AbstractMigration
{

    public function up()
    {

        $this->table('voices')
            ->changeColumn('namejinglemixpoint', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('voices')
            ->changeColumn('namejinglemixpoint', 'integer', [
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->update();
    }
}

