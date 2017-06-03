<?php
use $useClassName;
//use Phinx\Db\Adapter\MysqlAdapter;

class $className extends $baseClassName 
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $this->createNewTable('TABLE_NAME_GOES_HERE', [
                ['name' => 'title', 'type' => 'string', 'def' => ['null' => true, 'default' => null, 'limit' => 50] ],
                ['name' => 'link', 'type' => 'string', 'def' => ['null' => true, 'default' => null, 'limit' => 200] ],
                ['name' => 'body', 'type' => 'text', 'def' => ['null' => true, 'default' => null] ],
                // etc
            ]);

    }


    /*
     * Names the primary key using the table name followed by Id
     * example: table = userDoc; primary key = userDocId
     */
    private function createNewTable($name, $columns) {
        $primaryKey = $name . 'Id';
        $table = $this->table($name, ['id' => false, 'primary_key' => $primaryKey, 'charset' => 'utf8', 'collation' => 'utf8_general_ci', 'engine' => 'InnoDB']);
        $table->addColumn($primaryKey, 'integer', ['default' => null, 'null' => false, 'identity' => true, 'signed' => false]);

        if ( count($columns) > 0 ) {
            foreach ($columns as $c) {
                $table->addColumn($c['name'], $c['type'], $c['def']);
            }
        }

        $table->addColumn('created', 'datetime', ['default' => null, 'null' => true])
              ->addColumn('modified', 'datetime', ['default' => null, 'null' => true])
              ->create();

    }

/*
 * Remember to call "create()" or "update()" and NOT "save()" when working
 * with the Table class.

-- addColumn --
        $table = $this->table('TABLE_NAME_GOES_HERE');

        if ( ! $table->hasColumn('COLUMN_NAME_GOES_HERE') ) {
            $table->addColumn('COLUMN_NAME_GOES_HERE', 'integer', array('limit' => 11, 'null' => true, 'signed' => false, 'after' => 'someOtherColumn'))
                ->update();
        }

-- removeColumn --
        $table = $this->table('TABLE_NAME_GOES_HERE');
        $columnNameToRemove = 'COLUMN_NAME_GOES_HERE';
        if ( $table->hasColumn($columnNameToRemove) ) {
            $table->removeColumn($columnNameToRemove)
                ->update();
        }

-- Other column functions --
        $table->renameColumn()
        $table->changeColumn()
        $table->removeIndex()
        $table->addForeignKey()
        $table->dropForeignKey()

-- How to Tiny int --
        use Phinx\Db\Adapter\MysqlAdapter;
        $merchant->addColumn('COLUMN_NAME_GOES_HERE', 'integer', ['signed' => false, 'null' => false, 'default' => 0, 'limit' => MysqlAdapter::INT_TINY, 'after' => 'tags'])

-- How to Tiny boolean
    $table->changeColumn('COLUMN_NAME_GOES_HERE', 'boolean', array('signed' => false, 'default' => false))
        ->update();

-- How to index a column --
        $table->addColumn('COLUMN_NAME_GOES_HERE', 'string', array('limit' => 50, 'null' => true, 'default' => null, 'after' => 'path'))
            ->addIndex(['COLUMN_NAME_GOES_HERE'], ['unique' => true])
            ->update();

-- Drop table --
        $this->dropTable('TABLE_NAME_GOES_HERE');

-- Rename table --
        $table = $this->table('OLD_TABLE_NAME');
        $table->rename('NEW_TABLE_NAME');

*/    
}
