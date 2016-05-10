<?php

use Phinx\Migration\AbstractMigration;

class AddStringSizeColumn extends AbstractMigration
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
    $this->execute("
      ALTER TABLE turnkey_available_home
        ADD COLUMN size VARCHAR(255) AFTER square_feet;
    ");

    $this->execute("
      ALTER TABLE turnkey_available_home
        ADD COLUMN status VARCHAR(255) AFTER size;
    ");

    $this->execute("
      ALTER TABLE turnkey_available_home
        ADD COLUMN price VARCHAR(255) AFTER size;
    ");
  }
}
