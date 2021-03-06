<?php

use Phinx\Migration\AbstractMigration;

class ChangeTestimonialImage extends AbstractMigration
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
      ALTER TABLE turnkey_testimonial
        DROP FOREIGN KEY turnkey_testimonial_ibfk_2;
    ");

    $this->execute("
      ALTER TABLE turnkey_testimonial
        DROP COLUMN media_image_id;
    ");

    $this->execute("
      ALTER TABLE turnkey_testimonial
        ADD COLUMN image VARCHAR(255) AFTER turnkey_site_id;
    ");
  }
}
