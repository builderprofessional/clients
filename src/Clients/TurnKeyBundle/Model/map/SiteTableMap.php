<?php

namespace Clients\TurnKeyBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'turnkey_site' table.
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
class SiteTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Clients.TurnKeyBundle.Model.map.SiteTableMap';

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
        $this->setName('turnkey_site');
        $this->setPhpName('Site');
        $this->setClassname('Clients\\TurnKeyBundle\\Model\\Site');
        $this->setPackage('src.Clients.TurnKeyBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('turnkey_site_id', 'SiteId', 'INTEGER', true, null, null);
        $this->addColumn('date_modified', 'DateModified', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('date_created', 'DateCreated', 'TIMESTAMP', true, null, null);
        $this->addForeignKey('billing_client_id', 'BillingClientId', 'INTEGER', 'billing_client', 'billing_client_id', true, null, null);
        $this->addColumn('code', 'Code', 'VARCHAR', true, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Client', 'Engine\\BillingBundle\\Model\\Client', RelationMap::MANY_TO_ONE, array('billing_client_id' => 'billing_client_id', ), null, null);
        $this->addRelation('TeamMember', 'Clients\\TurnKeyBundle\\Model\\TeamMember', RelationMap::ONE_TO_MANY, array('turnkey_site_id' => 'turnkey_site_id', ), null, null, 'TeamMembers');
        $this->addRelation('Testimonial', 'Clients\\TurnKeyBundle\\Model\\Testimonial', RelationMap::ONE_TO_MANY, array('turnkey_site_id' => 'turnkey_site_id', ), null, null, 'Testimonials');
    } // buildRelations()

} // SiteTableMap
