<?php

namespace Clients\TurnKeyBundle\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Clients\TurnKeyBundle\Model\SitePeer;
use Clients\TurnKeyBundle\Model\TeamMember;
use Clients\TurnKeyBundle\Model\TeamMemberPeer;
use Clients\TurnKeyBundle\Model\map\TeamMemberTableMap;
use Engine\DemographicBundle\Model\EmployeePeer;

abstract class BaseTeamMemberPeer extends \Engine\EngineBundle\Base\EnginePeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'default';

    /** the table name for this class */
    const TABLE_NAME = 'turnkey_team_member';

    /** the related Propel class for this table */
    const OM_CLASS = 'Clients\\TurnKeyBundle\\Model\\TeamMember';

    /** the related TableMap class for this table */
    const TM_CLASS = 'TeamMemberTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 8;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 8;

    /** the column name for the turnkey_team_member_id field */
    const TURNKEY_TEAM_MEMBER_ID = 'turnkey_team_member.turnkey_team_member_id';

    /** the column name for the date_modified field */
    const DATE_MODIFIED = 'turnkey_team_member.date_modified';

    /** the column name for the date_created field */
    const DATE_CREATED = 'turnkey_team_member.date_created';

    /** the column name for the turnkey_site_id field */
    const TURNKEY_SITE_ID = 'turnkey_team_member.turnkey_site_id';

    /** the column name for the demographic_employee_id field */
    const DEMOGRAPHIC_EMPLOYEE_ID = 'turnkey_team_member.demographic_employee_id';

    /** the column name for the image_file_name field */
    const IMAGE_FILE_NAME = 'turnkey_team_member.image_file_name';

    /** the column name for the description field */
    const DESCRIPTION = 'turnkey_team_member.description';

    /** the column name for the sort_order field */
    const SORT_ORDER = 'turnkey_team_member.sort_order';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of TeamMember objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array TeamMember[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. TeamMemberPeer::$fieldNames[TeamMemberPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('TeamMemberId', 'DateModified', 'DateCreated', 'SiteId', 'DemographicEmployeeId', 'ImageFileName', 'Description', 'SortOrder', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('teamMemberId', 'dateModified', 'dateCreated', 'siteId', 'demographicEmployeeId', 'imageFileName', 'description', 'sortOrder', ),
        BasePeer::TYPE_COLNAME => array (TeamMemberPeer::TURNKEY_TEAM_MEMBER_ID, TeamMemberPeer::DATE_MODIFIED, TeamMemberPeer::DATE_CREATED, TeamMemberPeer::TURNKEY_SITE_ID, TeamMemberPeer::DEMOGRAPHIC_EMPLOYEE_ID, TeamMemberPeer::IMAGE_FILE_NAME, TeamMemberPeer::DESCRIPTION, TeamMemberPeer::SORT_ORDER, ),
        BasePeer::TYPE_RAW_COLNAME => array ('TURNKEY_TEAM_MEMBER_ID', 'DATE_MODIFIED', 'DATE_CREATED', 'TURNKEY_SITE_ID', 'DEMOGRAPHIC_EMPLOYEE_ID', 'IMAGE_FILE_NAME', 'DESCRIPTION', 'SORT_ORDER', ),
        BasePeer::TYPE_FIELDNAME => array ('turnkey_team_member_id', 'date_modified', 'date_created', 'turnkey_site_id', 'demographic_employee_id', 'image_file_name', 'description', 'sort_order', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. TeamMemberPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('TeamMemberId' => 0, 'DateModified' => 1, 'DateCreated' => 2, 'SiteId' => 3, 'DemographicEmployeeId' => 4, 'ImageFileName' => 5, 'Description' => 6, 'SortOrder' => 7, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('teamMemberId' => 0, 'dateModified' => 1, 'dateCreated' => 2, 'siteId' => 3, 'demographicEmployeeId' => 4, 'imageFileName' => 5, 'description' => 6, 'sortOrder' => 7, ),
        BasePeer::TYPE_COLNAME => array (TeamMemberPeer::TURNKEY_TEAM_MEMBER_ID => 0, TeamMemberPeer::DATE_MODIFIED => 1, TeamMemberPeer::DATE_CREATED => 2, TeamMemberPeer::TURNKEY_SITE_ID => 3, TeamMemberPeer::DEMOGRAPHIC_EMPLOYEE_ID => 4, TeamMemberPeer::IMAGE_FILE_NAME => 5, TeamMemberPeer::DESCRIPTION => 6, TeamMemberPeer::SORT_ORDER => 7, ),
        BasePeer::TYPE_RAW_COLNAME => array ('TURNKEY_TEAM_MEMBER_ID' => 0, 'DATE_MODIFIED' => 1, 'DATE_CREATED' => 2, 'TURNKEY_SITE_ID' => 3, 'DEMOGRAPHIC_EMPLOYEE_ID' => 4, 'IMAGE_FILE_NAME' => 5, 'DESCRIPTION' => 6, 'SORT_ORDER' => 7, ),
        BasePeer::TYPE_FIELDNAME => array ('turnkey_team_member_id' => 0, 'date_modified' => 1, 'date_created' => 2, 'turnkey_site_id' => 3, 'demographic_employee_id' => 4, 'image_file_name' => 5, 'description' => 6, 'sort_order' => 7, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Translates a fieldname to another type
     *
     * @param      string $name field name
     * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @param      string $toType   One of the class type constants
     * @return string          translated name of the field.
     * @throws PropelException - if the specified name could not be found in the fieldname mappings.
     */
    public static function translateFieldName($name, $fromType, $toType)
    {
        $toNames = TeamMemberPeer::getFieldNames($toType);
        $key = isset(TeamMemberPeer::$fieldKeys[$fromType][$name]) ? TeamMemberPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(TeamMemberPeer::$fieldKeys[$fromType], true));
        }

        return $toNames[$key];
    }

    /**
     * Returns an array of field names.
     *
     * @param      string $type The type of fieldnames to return:
     *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @return array           A list of field names
     * @throws PropelException - if the type is not valid.
     */
    public static function getFieldNames($type = BasePeer::TYPE_PHPNAME)
    {
        if (!array_key_exists($type, TeamMemberPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return TeamMemberPeer::$fieldNames[$type];
    }

    /**
     * Convenience method which changes table.column to alias.column.
     *
     * Using this method you can maintain SQL abstraction while using column aliases.
     * <code>
     *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
     *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
     * </code>
     * @param      string $alias The alias for the current table.
     * @param      string $column The column name for current table. (i.e. TeamMemberPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(TeamMemberPeer::TABLE_NAME.'.', $alias.'.', $column);
    }

    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param      Criteria $criteria object containing the columns to add.
     * @param      string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(TeamMemberPeer::TURNKEY_TEAM_MEMBER_ID);
            $criteria->addSelectColumn(TeamMemberPeer::DATE_MODIFIED);
            $criteria->addSelectColumn(TeamMemberPeer::DATE_CREATED);
            $criteria->addSelectColumn(TeamMemberPeer::TURNKEY_SITE_ID);
            $criteria->addSelectColumn(TeamMemberPeer::DEMOGRAPHIC_EMPLOYEE_ID);
            $criteria->addSelectColumn(TeamMemberPeer::IMAGE_FILE_NAME);
            $criteria->addSelectColumn(TeamMemberPeer::DESCRIPTION);
            $criteria->addSelectColumn(TeamMemberPeer::SORT_ORDER);
        } else {
            $criteria->addSelectColumn($alias . '.turnkey_team_member_id');
            $criteria->addSelectColumn($alias . '.date_modified');
            $criteria->addSelectColumn($alias . '.date_created');
            $criteria->addSelectColumn($alias . '.turnkey_site_id');
            $criteria->addSelectColumn($alias . '.demographic_employee_id');
            $criteria->addSelectColumn($alias . '.image_file_name');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.sort_order');
        }
    }

    /**
     * Returns the number of rows matching criteria.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @return int Number of matching rows.
     */
    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
    {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(TeamMemberPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            TeamMemberPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(TeamMemberPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(TeamMemberPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // BasePeer returns a PDOStatement
        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }
    /**
     * Selects one object from the DB.
     *
     * @param      Criteria $criteria object used to create the SELECT statement.
     * @param      PropelPDO $con
     * @return                 TeamMember
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = TeamMemberPeer::doSelect($critcopy, $con);
        if ($objects) {
            return $objects[0];
        }

        return null;
    }
    /**
     * Selects several row from the DB.
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con
     * @return array           Array of selected Objects
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelect(Criteria $criteria, PropelPDO $con = null)
    {
        return TeamMemberPeer::populateObjects(TeamMemberPeer::doSelectStmt($criteria, $con));
    }
    /**
     * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
     *
     * Use this method directly if you want to work with an executed statement directly (for example
     * to perform your own object hydration).
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con The connection to use
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return PDOStatement The executed PDOStatement object.
     * @see        BasePeer::doSelect()
     */
    public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(TeamMemberPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            TeamMemberPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(TeamMemberPeer::DATABASE_NAME);

        // BasePeer returns a PDOStatement
        return BasePeer::doSelect($criteria, $con);
    }
    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doSelect*()
     * methods in your stub classes -- you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by doSelect*()
     * and retrieveByPK*() calls.
     *
     * @param      TeamMember $obj A TeamMember object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getTeamMemberId();
            } // if key === null
            TeamMemberPeer::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param      mixed $value A TeamMember object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof TeamMember) {
                $key = (string) $value->getTeamMemberId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or TeamMember object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(TeamMemberPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   TeamMember Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(TeamMemberPeer::$instances[$key])) {
                return TeamMemberPeer::$instances[$key];
            }
        }

        return null; // just to be explicit
    }

    /**
     * Clear the instance pool.
     *
     * @return void
     */
    public static function clearInstancePool($and_clear_all_references = false)
    {
      if ($and_clear_all_references)
      {
        foreach (TeamMemberPeer::$instances as $instance)
        {
          $instance->clearAllReferences(true);
        }
      }
        TeamMemberPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to turnkey_team_member
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return string A string version of PK or null if the components of primary key in result array are all null.
     */
    public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
    {
        // If the PK cannot be derived from the row, return null.
        if ($row[$startcol] === null) {
            return null;
        }

        return (string) $row[$startcol];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $startcol = 0)
    {

        return (int) $row[$startcol];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function populateObjects(PDOStatement $stmt)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = TeamMemberPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = TeamMemberPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = TeamMemberPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TeamMemberPeer::addInstanceToPool($obj, $key);
            } // if key exists
        }
        $stmt->closeCursor();

        return $results;
    }
    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return array (TeamMember object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = TeamMemberPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = TeamMemberPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + TeamMemberPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TeamMemberPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            TeamMemberPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related Site table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinSite(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(TeamMemberPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            TeamMemberPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(TeamMemberPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(TeamMemberPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(TeamMemberPeer::TURNKEY_SITE_ID, SitePeer::TURNKEY_SITE_ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Employee table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinEmployee(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(TeamMemberPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            TeamMemberPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(TeamMemberPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(TeamMemberPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(TeamMemberPeer::DEMOGRAPHIC_EMPLOYEE_ID, EmployeePeer::DEMOGRAPHIC_EMPLOYEE_ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Selects a collection of TeamMember objects pre-filled with their Site objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of TeamMember objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinSite(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(TeamMemberPeer::DATABASE_NAME);
        }

        TeamMemberPeer::addSelectColumns($criteria);
        $startcol = TeamMemberPeer::NUM_HYDRATE_COLUMNS;
        SitePeer::addSelectColumns($criteria);

        $criteria->addJoin(TeamMemberPeer::TURNKEY_SITE_ID, SitePeer::TURNKEY_SITE_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = TeamMemberPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = TeamMemberPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = TeamMemberPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                TeamMemberPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = SitePeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = SitePeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = SitePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    SitePeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (TeamMember) to $obj2 (Site)
                $obj2->addTeamMember($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of TeamMember objects pre-filled with their Employee objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of TeamMember objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinEmployee(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(TeamMemberPeer::DATABASE_NAME);
        }

        TeamMemberPeer::addSelectColumns($criteria);
        $startcol = TeamMemberPeer::NUM_HYDRATE_COLUMNS;
        EmployeePeer::addSelectColumns($criteria);

        $criteria->addJoin(TeamMemberPeer::DEMOGRAPHIC_EMPLOYEE_ID, EmployeePeer::DEMOGRAPHIC_EMPLOYEE_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = TeamMemberPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = TeamMemberPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = TeamMemberPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                TeamMemberPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = EmployeePeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = EmployeePeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = EmployeePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    EmployeePeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (TeamMember) to $obj2 (Employee)
                $obj2->addTeamMember($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining all related tables
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(TeamMemberPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            TeamMemberPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(TeamMemberPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(TeamMemberPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(TeamMemberPeer::TURNKEY_SITE_ID, SitePeer::TURNKEY_SITE_ID, $join_behavior);

        $criteria->addJoin(TeamMemberPeer::DEMOGRAPHIC_EMPLOYEE_ID, EmployeePeer::DEMOGRAPHIC_EMPLOYEE_ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }

    /**
     * Selects a collection of TeamMember objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of TeamMember objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(TeamMemberPeer::DATABASE_NAME);
        }

        TeamMemberPeer::addSelectColumns($criteria);
        $startcol2 = TeamMemberPeer::NUM_HYDRATE_COLUMNS;

        SitePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + SitePeer::NUM_HYDRATE_COLUMNS;

        EmployeePeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + EmployeePeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(TeamMemberPeer::TURNKEY_SITE_ID, SitePeer::TURNKEY_SITE_ID, $join_behavior);

        $criteria->addJoin(TeamMemberPeer::DEMOGRAPHIC_EMPLOYEE_ID, EmployeePeer::DEMOGRAPHIC_EMPLOYEE_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = TeamMemberPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = TeamMemberPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = TeamMemberPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                TeamMemberPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined Site rows

            $key2 = SitePeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = SitePeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = SitePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    SitePeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (TeamMember) to the collection in $obj2 (Site)
                $obj2->addTeamMember($obj1);
            } // if joined row not null

            // Add objects for joined Employee rows

            $key3 = EmployeePeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = EmployeePeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = EmployeePeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    EmployeePeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (TeamMember) to the collection in $obj3 (Employee)
                $obj3->addTeamMember($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Site table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptSite(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(TeamMemberPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            TeamMemberPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(TeamMemberPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(TeamMemberPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(TeamMemberPeer::DEMOGRAPHIC_EMPLOYEE_ID, EmployeePeer::DEMOGRAPHIC_EMPLOYEE_ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Employee table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptEmployee(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(TeamMemberPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            TeamMemberPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(TeamMemberPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(TeamMemberPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(TeamMemberPeer::TURNKEY_SITE_ID, SitePeer::TURNKEY_SITE_ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Selects a collection of TeamMember objects pre-filled with all related objects except Site.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of TeamMember objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptSite(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(TeamMemberPeer::DATABASE_NAME);
        }

        TeamMemberPeer::addSelectColumns($criteria);
        $startcol2 = TeamMemberPeer::NUM_HYDRATE_COLUMNS;

        EmployeePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + EmployeePeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(TeamMemberPeer::DEMOGRAPHIC_EMPLOYEE_ID, EmployeePeer::DEMOGRAPHIC_EMPLOYEE_ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = TeamMemberPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = TeamMemberPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = TeamMemberPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                TeamMemberPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Employee rows

                $key2 = EmployeePeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = EmployeePeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = EmployeePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    EmployeePeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (TeamMember) to the collection in $obj2 (Employee)
                $obj2->addTeamMember($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of TeamMember objects pre-filled with all related objects except Employee.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of TeamMember objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptEmployee(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(TeamMemberPeer::DATABASE_NAME);
        }

        TeamMemberPeer::addSelectColumns($criteria);
        $startcol2 = TeamMemberPeer::NUM_HYDRATE_COLUMNS;

        SitePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + SitePeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(TeamMemberPeer::TURNKEY_SITE_ID, SitePeer::TURNKEY_SITE_ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = TeamMemberPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = TeamMemberPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = TeamMemberPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                TeamMemberPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Site rows

                $key2 = SitePeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = SitePeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = SitePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    SitePeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (TeamMember) to the collection in $obj2 (Site)
                $obj2->addTeamMember($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }

    /**
     * Returns the TableMap related to this peer.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getDatabaseMap(TeamMemberPeer::DATABASE_NAME)->getTable(TeamMemberPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseTeamMemberPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseTeamMemberPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new TeamMemberTableMap());
      }
    }

    /**
     * The class that the Peer will make instances of.
     *
     *
     * @return string ClassName
     */
    public static function getOMClass($row = 0, $colnum = 0)
    {
        return TeamMemberPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a TeamMember or Criteria object.
     *
     * @param      mixed $values Criteria or TeamMember object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(TeamMemberPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from TeamMember object
        }

        if ($criteria->containsKey(TeamMemberPeer::TURNKEY_TEAM_MEMBER_ID) && $criteria->keyContainsValue(TeamMemberPeer::TURNKEY_TEAM_MEMBER_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.TeamMemberPeer::TURNKEY_TEAM_MEMBER_ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(TeamMemberPeer::DATABASE_NAME);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = BasePeer::doInsert($criteria, $con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

    /**
     * Performs an UPDATE on the database, given a TeamMember or Criteria object.
     *
     * @param      mixed $values Criteria or TeamMember object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(TeamMemberPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(TeamMemberPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(TeamMemberPeer::TURNKEY_TEAM_MEMBER_ID);
            $value = $criteria->remove(TeamMemberPeer::TURNKEY_TEAM_MEMBER_ID);
            if ($value) {
                $selectCriteria->add(TeamMemberPeer::TURNKEY_TEAM_MEMBER_ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(TeamMemberPeer::TABLE_NAME);
            }

        } else { // $values is TeamMember object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(TeamMemberPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the turnkey_team_member table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(TeamMemberPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(TeamMemberPeer::TABLE_NAME, $con, TeamMemberPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TeamMemberPeer::clearInstancePool();
            TeamMemberPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a TeamMember or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or TeamMember object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param      PropelPDO $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *				if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, PropelPDO $con = null)
     {
        if ($con === null) {
            $con = Propel::getConnection(TeamMemberPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            TeamMemberPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof TeamMember) { // it's a model object
            // invalidate the cache for this single object
            TeamMemberPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TeamMemberPeer::DATABASE_NAME);
            $criteria->add(TeamMemberPeer::TURNKEY_TEAM_MEMBER_ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                TeamMemberPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(TeamMemberPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            TeamMemberPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given TeamMember object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      TeamMember $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(TeamMemberPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(TeamMemberPeer::TABLE_NAME);

            if (! is_array($cols)) {
                $cols = array($cols);
            }

            foreach ($cols as $colName) {
                if ($tableMap->hasColumn($colName)) {
                    $get = 'get' . $tableMap->getColumn($colName)->getPhpName();
                    $columns[$colName] = $obj->$get();
                }
            }
        } else {

        }

        return BasePeer::doValidate(TeamMemberPeer::DATABASE_NAME, TeamMemberPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return TeamMember
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = TeamMemberPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(TeamMemberPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(TeamMemberPeer::DATABASE_NAME);
        $criteria->add(TeamMemberPeer::TURNKEY_TEAM_MEMBER_ID, $pk);

        $v = TeamMemberPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return TeamMember[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(TeamMemberPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(TeamMemberPeer::DATABASE_NAME);
            $criteria->add(TeamMemberPeer::TURNKEY_TEAM_MEMBER_ID, $pks, Criteria::IN);
            $objs = TeamMemberPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseTeamMemberPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseTeamMemberPeer::buildTableMap();

