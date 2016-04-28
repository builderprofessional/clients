<?php

namespace Clients\TurnKeyBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'turnkey_testimonial' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.src.Clients.TurnKeyBundle.Model.map
 */
class TestimonialTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Clients.TurnKeyBundle.Model.map.TestimonialTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('turnkey_testimonial');
        $this->setPhpName('Testimonial');
        $this->setClassname('Clients\\TurnKeyBundle\\Model\\Testimonial');
        $this->setPackage('src.Clients.TurnKeyBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('turnkey_testimonial_id', 'TestimonialId', 'INTEGER', true, null, null);
        $this->addColumn('date_modified', 'DateModified', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('date_created', 'DateCreated', 'TIMESTAMP', true, null, null);
        $this->addForeignKey('turnkey_site_id', 'SiteId', 'INTEGER', 'turnkey_site', 'turnkey_site_id', true, null, null);
        $this->addForeignKey('media_image_id', 'MediaImageId', 'INTEGER', 'media_image', 'media_image_id', false, null, null);
        $this->addColumn('signature', 'Signature', 'LONGVARCHAR', false, null, null);
        $this->addColumn('main_text', 'MainText', 'LONGVARCHAR', true, null, null);
        $this->addColumn('sort_order', 'SortOrder', 'INTEGER', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Site', 'Clients\\TurnKeyBundle\\Model\\Site', RelationMap::MANY_TO_ONE, array('turnkey_site_id' => 'turnkey_site_id', ), null, null);
        $this->addRelation('Image', 'Engine\\MediaBundle\\Model\\Image', RelationMap::MANY_TO_ONE, array('media_image_id' => 'media_image_id', ), null, null);
    } // buildRelations()

} // TestimonialTableMap
