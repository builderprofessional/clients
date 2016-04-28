<?php

namespace Clients\TurnKeyBundle\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Clients\TurnKeyBundle\Model\Site;
use Clients\TurnKeyBundle\Model\TeamMember;
use Clients\TurnKeyBundle\Model\TeamMemberPeer;
use Clients\TurnKeyBundle\Model\TeamMemberQuery;
use Engine\DemographicBundle\Model\Employee;

/**
 * @method TeamMemberQuery orderByTeamMemberId($order = Criteria::ASC) Order by the turnkey_team_member_id column
 * @method TeamMemberQuery orderByDateModified($order = Criteria::ASC) Order by the date_modified column
 * @method TeamMemberQuery orderByDateCreated($order = Criteria::ASC) Order by the date_created column
 * @method TeamMemberQuery orderBySiteId($order = Criteria::ASC) Order by the turnkey_site_id column
 * @method TeamMemberQuery orderByDemographicEmployeeId($order = Criteria::ASC) Order by the demographic_employee_id column
 * @method TeamMemberQuery orderByImageFileName($order = Criteria::ASC) Order by the image_file_name column
 * @method TeamMemberQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method TeamMemberQuery orderBySortOrder($order = Criteria::ASC) Order by the sort_order column
 *
 * @method TeamMemberQuery groupByTeamMemberId() Group by the turnkey_team_member_id column
 * @method TeamMemberQuery groupByDateModified() Group by the date_modified column
 * @method TeamMemberQuery groupByDateCreated() Group by the date_created column
 * @method TeamMemberQuery groupBySiteId() Group by the turnkey_site_id column
 * @method TeamMemberQuery groupByDemographicEmployeeId() Group by the demographic_employee_id column
 * @method TeamMemberQuery groupByImageFileName() Group by the image_file_name column
 * @method TeamMemberQuery groupByDescription() Group by the description column
 * @method TeamMemberQuery groupBySortOrder() Group by the sort_order column
 *
 * @method TeamMemberQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TeamMemberQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TeamMemberQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TeamMemberQuery leftJoinSite($relationAlias = null) Adds a LEFT JOIN clause to the query using the Site relation
 * @method TeamMemberQuery rightJoinSite($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Site relation
 * @method TeamMemberQuery innerJoinSite($relationAlias = null) Adds a INNER JOIN clause to the query using the Site relation
 *
 * @method TeamMemberQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method TeamMemberQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method TeamMemberQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method TeamMember findOne(PropelPDO $con = null) Return the first TeamMember matching the query
 * @method TeamMember findOneOrCreate(PropelPDO $con = null) Return the first TeamMember matching the query, or a new TeamMember object populated from the query conditions when no match is found
 *
 * @method TeamMember findOneByDateModified(string $date_modified) Return the first TeamMember filtered by the date_modified column
 * @method TeamMember findOneByDateCreated(string $date_created) Return the first TeamMember filtered by the date_created column
 * @method TeamMember findOneBySiteId(int $turnkey_site_id) Return the first TeamMember filtered by the turnkey_site_id column
 * @method TeamMember findOneByDemographicEmployeeId(int $demographic_employee_id) Return the first TeamMember filtered by the demographic_employee_id column
 * @method TeamMember findOneByImageFileName(string $image_file_name) Return the first TeamMember filtered by the image_file_name column
 * @method TeamMember findOneByDescription(string $description) Return the first TeamMember filtered by the description column
 * @method TeamMember findOneBySortOrder(int $sort_order) Return the first TeamMember filtered by the sort_order column
 *
 * @method array findByTeamMemberId(int $turnkey_team_member_id) Return TeamMember objects filtered by the turnkey_team_member_id column
 * @method array findByDateModified(string $date_modified) Return TeamMember objects filtered by the date_modified column
 * @method array findByDateCreated(string $date_created) Return TeamMember objects filtered by the date_created column
 * @method array findBySiteId(int $turnkey_site_id) Return TeamMember objects filtered by the turnkey_site_id column
 * @method array findByDemographicEmployeeId(int $demographic_employee_id) Return TeamMember objects filtered by the demographic_employee_id column
 * @method array findByImageFileName(string $image_file_name) Return TeamMember objects filtered by the image_file_name column
 * @method array findByDescription(string $description) Return TeamMember objects filtered by the description column
 * @method array findBySortOrder(int $sort_order) Return TeamMember objects filtered by the sort_order column
 */
abstract class BaseTeamMemberQuery extends \Engine\EngineBundle\Base\EngineQuery
{
    /**
     * Initializes internal state of BaseTeamMemberQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'Clients\\TurnKeyBundle\\Model\\TeamMember', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TeamMemberQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   TeamMemberQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TeamMemberQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TeamMemberQuery) {
            return $criteria;
        }
        $query = new TeamMemberQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   TeamMember|TeamMember[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TeamMemberPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TeamMemberPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 TeamMember A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByTeamMemberId($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 TeamMember A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `turnkey_team_member_id`, `date_modified`, `date_created`, `turnkey_site_id`, `demographic_employee_id`, `image_file_name`, `description`, `sort_order` FROM `turnkey_team_member` WHERE `turnkey_team_member_id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new TeamMember();
            $obj->hydrate($row);
            TeamMemberPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return TeamMember|TeamMember[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|TeamMember[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return TeamMemberQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TeamMemberPeer::TURNKEY_TEAM_MEMBER_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TeamMemberQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TeamMemberPeer::TURNKEY_TEAM_MEMBER_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the turnkey_team_member_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTeamMemberId(1234); // WHERE turnkey_team_member_id = 1234
     * $query->filterByTeamMemberId(array(12, 34)); // WHERE turnkey_team_member_id IN (12, 34)
     * $query->filterByTeamMemberId(array('min' => 12)); // WHERE turnkey_team_member_id >= 12
     * $query->filterByTeamMemberId(array('max' => 12)); // WHERE turnkey_team_member_id <= 12
     * </code>
     *
     * @param     mixed $teamMemberId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TeamMemberQuery The current query, for fluid interface
     */
    public function filterByTeamMemberId($teamMemberId = null, $comparison = null)
    {
        if (is_array($teamMemberId)) {
            $useMinMax = false;
            if (isset($teamMemberId['min'])) {
                $this->addUsingAlias(TeamMemberPeer::TURNKEY_TEAM_MEMBER_ID, $teamMemberId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($teamMemberId['max'])) {
                $this->addUsingAlias(TeamMemberPeer::TURNKEY_TEAM_MEMBER_ID, $teamMemberId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TeamMemberPeer::TURNKEY_TEAM_MEMBER_ID, $teamMemberId, $comparison);
    }

    /**
     * Filter the query on the date_modified column
     *
     * Example usage:
     * <code>
     * $query->filterByDateModified('2011-03-14'); // WHERE date_modified = '2011-03-14'
     * $query->filterByDateModified('now'); // WHERE date_modified = '2011-03-14'
     * $query->filterByDateModified(array('max' => 'yesterday')); // WHERE date_modified > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateModified The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TeamMemberQuery The current query, for fluid interface
     */
    public function filterByDateModified($dateModified = null, $comparison = null)
    {
        if (is_array($dateModified)) {
            $useMinMax = false;
            if (isset($dateModified['min'])) {
                $this->addUsingAlias(TeamMemberPeer::DATE_MODIFIED, $dateModified['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateModified['max'])) {
                $this->addUsingAlias(TeamMemberPeer::DATE_MODIFIED, $dateModified['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TeamMemberPeer::DATE_MODIFIED, $dateModified, $comparison);
    }

    /**
     * Filter the query on the date_created column
     *
     * Example usage:
     * <code>
     * $query->filterByDateCreated('2011-03-14'); // WHERE date_created = '2011-03-14'
     * $query->filterByDateCreated('now'); // WHERE date_created = '2011-03-14'
     * $query->filterByDateCreated(array('max' => 'yesterday')); // WHERE date_created > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateCreated The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TeamMemberQuery The current query, for fluid interface
     */
    public function filterByDateCreated($dateCreated = null, $comparison = null)
    {
        if (is_array($dateCreated)) {
            $useMinMax = false;
            if (isset($dateCreated['min'])) {
                $this->addUsingAlias(TeamMemberPeer::DATE_CREATED, $dateCreated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateCreated['max'])) {
                $this->addUsingAlias(TeamMemberPeer::DATE_CREATED, $dateCreated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TeamMemberPeer::DATE_CREATED, $dateCreated, $comparison);
    }

    /**
     * Filter the query on the turnkey_site_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySiteId(1234); // WHERE turnkey_site_id = 1234
     * $query->filterBySiteId(array(12, 34)); // WHERE turnkey_site_id IN (12, 34)
     * $query->filterBySiteId(array('min' => 12)); // WHERE turnkey_site_id >= 12
     * $query->filterBySiteId(array('max' => 12)); // WHERE turnkey_site_id <= 12
     * </code>
     *
     * @see       filterBySite()
     *
     * @param     mixed $siteId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TeamMemberQuery The current query, for fluid interface
     */
    public function filterBySiteId($siteId = null, $comparison = null)
    {
        if (is_array($siteId)) {
            $useMinMax = false;
            if (isset($siteId['min'])) {
                $this->addUsingAlias(TeamMemberPeer::TURNKEY_SITE_ID, $siteId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($siteId['max'])) {
                $this->addUsingAlias(TeamMemberPeer::TURNKEY_SITE_ID, $siteId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TeamMemberPeer::TURNKEY_SITE_ID, $siteId, $comparison);
    }

    /**
     * Filter the query on the demographic_employee_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDemographicEmployeeId(1234); // WHERE demographic_employee_id = 1234
     * $query->filterByDemographicEmployeeId(array(12, 34)); // WHERE demographic_employee_id IN (12, 34)
     * $query->filterByDemographicEmployeeId(array('min' => 12)); // WHERE demographic_employee_id >= 12
     * $query->filterByDemographicEmployeeId(array('max' => 12)); // WHERE demographic_employee_id <= 12
     * </code>
     *
     * @see       filterByEmployee()
     *
     * @param     mixed $demographicEmployeeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TeamMemberQuery The current query, for fluid interface
     */
    public function filterByDemographicEmployeeId($demographicEmployeeId = null, $comparison = null)
    {
        if (is_array($demographicEmployeeId)) {
            $useMinMax = false;
            if (isset($demographicEmployeeId['min'])) {
                $this->addUsingAlias(TeamMemberPeer::DEMOGRAPHIC_EMPLOYEE_ID, $demographicEmployeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($demographicEmployeeId['max'])) {
                $this->addUsingAlias(TeamMemberPeer::DEMOGRAPHIC_EMPLOYEE_ID, $demographicEmployeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TeamMemberPeer::DEMOGRAPHIC_EMPLOYEE_ID, $demographicEmployeeId, $comparison);
    }

    /**
     * Filter the query on the image_file_name column
     *
     * Example usage:
     * <code>
     * $query->filterByImageFileName('fooValue');   // WHERE image_file_name = 'fooValue'
     * $query->filterByImageFileName('%fooValue%'); // WHERE image_file_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imageFileName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TeamMemberQuery The current query, for fluid interface
     */
    public function filterByImageFileName($imageFileName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imageFileName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imageFileName)) {
                $imageFileName = str_replace('*', '%', $imageFileName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TeamMemberPeer::IMAGE_FILE_NAME, $imageFileName, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TeamMemberQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TeamMemberPeer::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the sort_order column
     *
     * Example usage:
     * <code>
     * $query->filterBySortOrder(1234); // WHERE sort_order = 1234
     * $query->filterBySortOrder(array(12, 34)); // WHERE sort_order IN (12, 34)
     * $query->filterBySortOrder(array('min' => 12)); // WHERE sort_order >= 12
     * $query->filterBySortOrder(array('max' => 12)); // WHERE sort_order <= 12
     * </code>
     *
     * @param     mixed $sortOrder The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TeamMemberQuery The current query, for fluid interface
     */
    public function filterBySortOrder($sortOrder = null, $comparison = null)
    {
        if (is_array($sortOrder)) {
            $useMinMax = false;
            if (isset($sortOrder['min'])) {
                $this->addUsingAlias(TeamMemberPeer::SORT_ORDER, $sortOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sortOrder['max'])) {
                $this->addUsingAlias(TeamMemberPeer::SORT_ORDER, $sortOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TeamMemberPeer::SORT_ORDER, $sortOrder, $comparison);
    }

    /**
     * Filter the query by a related Site object
     *
     * @param   Site|PropelObjectCollection $site The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TeamMemberQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterBySite($site, $comparison = null)
    {
        if ($site instanceof Site) {
            return $this
                ->addUsingAlias(TeamMemberPeer::TURNKEY_SITE_ID, $site->getSiteId(), $comparison);
        } elseif ($site instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TeamMemberPeer::TURNKEY_SITE_ID, $site->toKeyValue('PrimaryKey', 'SiteId'), $comparison);
        } else {
            throw new PropelException('filterBySite() only accepts arguments of type Site or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Site relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TeamMemberQuery The current query, for fluid interface
     */
    public function joinSite($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Site');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Site');
        }

        return $this;
    }

    /**
     * Use the Site relation Site object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Clients\TurnKeyBundle\Model\SiteQuery A secondary query class using the current class as primary query
     */
    public function useSiteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSite($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Site', '\Clients\TurnKeyBundle\Model\SiteQuery');
    }

    /**
     * Filter the query by a related Employee object
     *
     * @param   Employee|PropelObjectCollection $employee The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TeamMemberQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByEmployee($employee, $comparison = null)
    {
        if ($employee instanceof Employee) {
            return $this
                ->addUsingAlias(TeamMemberPeer::DEMOGRAPHIC_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TeamMemberPeer::DEMOGRAPHIC_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);
        } else {
            throw new PropelException('filterByEmployee() only accepts arguments of type Employee or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employee relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TeamMemberQuery The current query, for fluid interface
     */
    public function joinEmployee($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employee');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Employee');
        }

        return $this;
    }

    /**
     * Use the Employee relation Employee object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Engine\DemographicBundle\Model\EmployeeQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployee($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employee', '\Engine\DemographicBundle\Model\EmployeeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TeamMember $teamMember Object to remove from the list of results
     *
     * @return TeamMemberQuery The current query, for fluid interface
     */
    public function prune($teamMember = null)
    {
        if ($teamMember) {
            $this->addUsingAlias(TeamMemberPeer::TURNKEY_TEAM_MEMBER_ID, $teamMember->getTeamMemberId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
