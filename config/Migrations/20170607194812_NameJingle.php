<?php
use Migrations\AbstractMigration;

class NameJingle extends AbstractMigration
{

    public function up()
    {

        $this->table('voices')
            ->addColumn('namejingle', 'string', [
                'after' => 'name',
                'default' => null,
                'length' => 255,
                'null' => true,
            ])
            ->addColumn('namejinglemixpoint', 'integer', [
                'after' => 'namejingle',
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('voices')
            ->removeColumn('namejingle')
            ->removeColumn('namejinglemixpoint')
            ->update();
    }
}

