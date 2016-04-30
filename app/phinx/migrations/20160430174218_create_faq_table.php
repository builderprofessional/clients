<?php

use Phinx\Migration\AbstractMigration;

class CreateFaqTable extends AbstractMigration
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
      CREATE TABLE IF NOT EXISTS turnkey_faq (
        turnkey_faq_id INT(11) NOT NULL AUTO_INCREMENT,
        date_modified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        date_created DATETIME NOT NULL,
        turnkey_site_id INT(11) NOT NULL,
        question TEXT,
        answer TEXT,
        sort_order INT(11),
        PRIMARY KEY (turnkey_faq_id),
        KEY date_created(date_created),
        KEY turnkey_site_id (turnkey_site_id),
        KEY sort_order (sort_order)
      ) ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;
    ");

    $this->execute("
      ALTER TABLE turnkey_faq
        ADD CONSTRAINT turnkey_faq_ibfk_1
        FOREIGN KEY (turnkey_site_id)
        REFERENCES turnkey_site (turnkey_site_id);
    ");
  }
}
