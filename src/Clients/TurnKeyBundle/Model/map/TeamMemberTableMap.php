<?php

namespace Clients\TurnKeyBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'turnkey_team_member' table.
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
class TeamMemberTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Clients.TurnKeyBundle.Model.map.TeamMemberTableMap';

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
        $this->setName('turnkey_team_member');
        $this->setPhpName('TeamMember');
        $this->setClassname('Clients\\TurnKeyBundle\\Model\\TeamMember');
        $this->setPackage('src.Clients.TurnKeyBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('turnkey_team_member_id', 'TeamMemberId', 'INTEGER', true, null, null);
        $this->addColumn('date_modified', 'DateModified', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('date_created', 'DateCreated', 'TIMESTAMP', true, null, null);
        $this->addForeignKey('turnkey_site_id', 'SiteId', 'INTEGER', 'turnkey_site', 'turnkey_site_id', true, null, null);
        $this->addForeignKey('demographic_employee_id', 'DemographicEmployeeId', 'INTEGER', 'demographic_employee', 'demographic_employee_id', true, null, null);
        $this->addColumn('image_file_name', 'ImageFileName', 'VARCHAR', false, 255, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('sort_order', 'SortOrder', 'INTEGER', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Site', 'Clients\\TurnKeyBundle\\Model\\Site', RelationMap::MANY_TO_ONE, array('turnkey_site_id' => 'turnkey_site_id', ), null, null);
        $this->addRelation('Employee', 'Engine\\DemographicBundle\\Model\\Employee', RelationMap::MANY_TO_ONE, array('demographic_employee_id' => 'demographic_employee_id', ), null, null);
    } // buildRelations()

} // TeamMemberTableMap
