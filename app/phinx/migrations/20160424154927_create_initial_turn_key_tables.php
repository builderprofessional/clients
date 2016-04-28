<?php

use Phinx\Migration\AbstractMigration;

class CreateInitialTurnKeyTables extends AbstractMigration
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
      CREATE TABLE IF NOT EXISTS turnkey_site (
        turnkey_site_id INT (11) NOT NULL AUTO_INCREMENT,
        date_modified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        date_created DATETIME NOT NULL,
        billing_client_id INT (11) NOT NULL,
        code VARCHAR(255) NOT NULL,
        PRIMARY KEY (turnkey_site_id),
        KEY date_created (date_created),
        KEY billing_client_id (billing_client_id),
        KEY code (code)
      ) ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;
    ");

    $this->execute("
      ALTER TABLE turnkey_site
        ADD CONSTRAINT turnkey_site_ibfk_1
          FOREIGN KEY (billing_client_id)
          REFERENCES billing_client (billing_client_id);
    ");

    $this->execute("
      CREATE TABLE IF NOT EXISTS turnkey_team_member (
        turnkey_team_member_id INT(11) NOT NULL AUTO_INCREMENT,
        date_modified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        date_created DATETIME NOT NULL,
        turnkey_site_id INT (11) NOT NULL,
        demographic_employee_id INT(11) NOT NULL,
        image_file_name VARCHAR(255),
        description TEXT,
        sort_order INT(11),
        PRIMARY KEY (turnkey_team_member_id),
        KEY date_created (date_created),
        KEY turnkey_site_id (turnkey_site_id),
        KEY demographic_employee_id (demographic_employee_id),
        KEY sort_order (sort_order)
      ) ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;
    ");

    $this->execute("
      ALTER TABLE turnkey_team_member
        ADD CONSTRAINT turnkey_team_member_ibfk_1
          FOREIGN KEY (turnkey_site_id)
          REFERENCES turnkey_site (turnkey_site_id);
    ");

    $this->execute("
      ALTER TABLE turnkey_team_member
        ADD CONSTRAINT turnkey_team_member_ibfk_2
          FOREIGN KEY (demographic_employee_id)
          REFERENCES demographic_employee (demographic_employee_id);
    ");

    $this->execute("
      CREATE TABLE IF NOT EXISTS turnkey_testimonial (
        turnkey_testimonial_id INT(11) NOT NULL AUTO_INCREMENT,
        date_modified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        date_created DATETIME NOT NULL,
        turnkey_site_id INT (11) NOT NULL,
        media_image_id INT(11),
        signature TEXT,
        main_text TEXT NOT NULL,
        sort_order INT(11),
        PRIMARY KEY (turnkey_testimonial_id),
        KEY date_created (date_created),
        KEY turnkey_site_id (turnkey_site_id),
        KEY media_image_id (media_image_id),
        KEY sort_order (sort_order)
      ) ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;
    ");

    $this->execute("
      ALTER TABLE turnkey_testimonial
        ADD CONSTRAINT turnkey_testimonial_ibfk_1
          FOREIGN KEY (turnkey_site_id)
          REFERENCES turnkey_site (turnkey_site_id);
    ");

    $this->execute("
      ALTER TABLE turnkey_testimonial
        ADD CONSTRAINT turnkey_testimonial_ibfk_2
          FOREIGN KEY (media_image_id)
          REFERENCES media_image (media_image_id);
    ");
  }
}
