<?php

use Phinx\Migration\AbstractMigration;

class AddAvailableHomesTable extends AbstractMigration
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
      CREATE TABLE IF NOT EXISTS turnkey_available_home (
        turnkey_available_home_id INT(11) NOT NULL AUTO_INCREMENT,
        date_modified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        date_created DATETIME NOT NULL,
        turnkey_site_id INT(11) NOT NULL,
        turnkey_community_id INT(11),
        demographic_address_id INT(11) NOT NULL,
        bedroom_count INT(11),
        full_bathroom_count INT(11),
        half_bathroom_count INT(11),
        square_feet INT(11),
        description VARCHAR(255),
        PRIMARY KEY (turnkey_available_home_id),
        KEY date_created(date_created),
        KEY turnkey_site_id(turnkey_site_id),
        KEY turnkey_community_id(turnkey_community_id),
        KEY demographic_address_id(demographic_address_id)
      ) ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;
    ");

    $this->execute("
      ALTER TABLE turnkey_available_home
        ADD CONSTRAINT turnkey_available_home_ibfk_1
        FOREIGN KEY (turnkey_site_id)
        REFERENCES turnkey_site (turnkey_site_id);
    ");

    $this->execute("
      ALTER TABLE turnkey_available_home
        ADD CONSTRAINT turnkey_available_home_ibfk_2
        FOREIGN KEY (turnkey_community_id)
        REFERENCES turnkey_community(turnkey_community_id);
    ");

    $this->execute("
      ALTER TABLE turnkey_available_home
        ADD CONSTRAINT turnkey_available_home_ibfk_3
        FOREIGN KEY (demographic_address_id)
        REFERENCES demographic_address(demographic_address_id);
    ");
  }
}
