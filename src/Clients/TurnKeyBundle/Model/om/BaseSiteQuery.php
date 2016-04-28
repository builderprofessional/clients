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
use Clients\TurnKeyBundle\Model\SitePeer;
use Clients\TurnKeyBundle\Model\SiteQuery;
use Clients\TurnKeyBundle\Model\TeamMember;
use Clients\TurnKeyBundle\Model\Testimonial;
use Engine\BillingBundle\Model\Client;

/**
 * @method SiteQuery orderBySiteId($order = Criteria::ASC) Order by the turnkey_site_id column
 * @method SiteQuery orderByDateModified($order = Criteria::ASC) Order by the date_modified column
 * @method SiteQuery orderByDateCreated($order = Criteria::ASC) Order by the date_created column
 * @method SiteQuery orderByBillingClientId($order = Criteria::ASC) Order by the billing_client_id column
 * @method SiteQuery orderByCode($order = Criteria::ASC) Order by the code column
 *
 * @method SiteQuery groupBySiteId() Group by the turnkey_site_id column
 * @method SiteQuery groupByDateModified() Group by the date_modified column
 * @method SiteQuery groupByDateCreated() Group by the date_created column
 * @method SiteQuery groupByBillingClientId() Group by the billing_client_id column
 * @method SiteQuery groupByCode() Group by the code column
 *
 * @method SiteQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SiteQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SiteQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method SiteQuery leftJoinClient($relationAlias = null) Adds a LEFT JOIN clause to the query using the Client relation
 * @method SiteQuery rightJoinClient($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Client relation
 * @method SiteQuery innerJoinClient($relationAlias = null) Adds a INNER JOIN clause to the query using the Client relation
 *
 * @method SiteQuery leftJoinTeamMember($relationAlias = null) Adds a LEFT JOIN clause to the query using the TeamMember relation
 * @method SiteQuery rightJoinTeamMember($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TeamMember relation
 * @method SiteQuery innerJoinTeamMember($relationAlias = null) Adds a INNER JOIN clause to the query using the TeamMember relation
 *
 * @method SiteQuery leftJoinTestimonial($relationAlias = null) Adds a LEFT JOIN clause to the query using the Testimonial relation
 * @method SiteQuery rightJoinTestimonial($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Testimonial relation
 * @method SiteQuery innerJoinTestimonial($relationAlias = null) Adds a INNER JOIN clause to the query using the Testimonial relation
 *
 * @method Site findOne(PropelPDO $con = null) Return the first Site matching the query
 * @method Site findOneOrCreate(PropelPDO $con = null) Return the first Site matching the query, or a new Site object populated from the query conditions when no match is found
 *
 * @method Site findOneByDateModified(string $date_modified) Return the first Site filtered by the date_modified column
 * @method Site findOneByDateCreated(string $date_created) Return the first Site filtered by the date_created column
 * @method Site findOneByBillingClientId(int $billing_client_id) Return the first Site filtered by the billing_client_id column
 * @method Site findOneByCode(string $code) Return the first Site filtered by the code column
 *
 * @method array findBySiteId(int $turnkey_site_id) Return Site objects filtered by the turnkey_site_id column
 * @method array findByDateModified(string $date_modified) Return Site objects filtered by the date_modified column
 * @method array findByDateCreated(string $date_created) Return Site objects filtered by the date_created column
 * @method array findByBillingClientId(int $billing_client_id) Return Site objects filtered by the billing_client_id column
 * @method array findByCode(string $code) Return Site objects filtered by the code column
 */
abstract class BaseSiteQuery extends \Engine\EngineBundle\Base\EngineQuery
{
    /**
     * Initializes internal state of BaseSiteQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'Clients\\TurnKeyBundle\\Model\\Site', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new SiteQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   SiteQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SiteQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof SiteQuery) {
            return $criteria;
        }
        $query = new SiteQuery();
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
     * @return   Site|Site[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SitePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SitePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Site A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneBySiteId($key, $con = null)
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
     * @return                 Site A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `turnkey_site_id`, `date_modified`, `date_created`, `billing_client_id`, `code` FROM `turnkey_site` WHERE `turnkey_site_id` = :p0';
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
            $obj = new Site();
            $obj->hydrate($row);
            SitePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Site|Site[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Site[]|mixed the list of results, formatted by the current formatter
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
     * @return SiteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SitePeer::TURNKEY_SITE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return SiteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SitePeer::TURNKEY_SITE_ID, $keys, Criteria::IN);
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
     * @param     mixed $siteId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SiteQuery The current query, for fluid interface
     */
    public function filterBySiteId($siteId = null, $comparison = null)
    {
        if (is_array($siteId)) {
            $useMinMax = false;
            if (isset($siteId['min'])) {
                $this->addUsingAlias(SitePeer::TURNKEY_SITE_ID, $siteId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($siteId['max'])) {
                $this->addUsingAlias(SitePeer::TURNKEY_SITE_ID, $siteId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SitePeer::TURNKEY_SITE_ID, $siteId, $comparison);
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
     * @return SiteQuery The current query, for fluid interface
     */
    public function filterByDateModified($dateModified = null, $comparison = null)
    {
        if (is_array($dateModified)) {
            $useMinMax = false;
            if (isset($dateModified['min'])) {
                $this->addUsingAlias(SitePeer::DATE_MODIFIED, $dateModified['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateModified['max'])) {
                $this->addUsingAlias(SitePeer::DATE_MODIFIED, $dateModified['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SitePeer::DATE_MODIFIED, $dateModified, $comparison);
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
     * @return SiteQuery The current query, for fluid interface
     */
    public function filterByDateCreated($dateCreated = null, $comparison = null)
    {
        if (is_array($dateCreated)) {
            $useMinMax = false;
            if (isset($dateCreated['min'])) {
                $this->addUsingAlias(SitePeer::DATE_CREATED, $dateCreated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateCreated['max'])) {
                $this->addUsingAlias(SitePeer::DATE_CREATED, $dateCreated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SitePeer::DATE_CREATED, $dateCreated, $comparison);
    }

    /**
     * Filter the query on the billing_client_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBillingClientId(1234); // WHERE billing_client_id = 1234
     * $query->filterByBillingClientId(array(12, 34)); // WHERE billing_client_id IN (12, 34)
     * $query->filterByBillingClientId(array('min' => 12)); // WHERE billing_client_id >= 12
     * $query->filterByBillingClientId(array('max' => 12)); // WHERE billing_client_id <= 12
     * </code>
     *
     * @see       filterByClient()
     *
     * @param     mixed $billingClientId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SiteQuery The current query, for fluid interface
     */
    public function filterByBillingClientId($billingClientId = null, $comparison = null)
    {
        if (is_array($billingClientId)) {
            $useMinMax = false;
            if (isset($billingClientId['min'])) {
                $this->addUsingAlias(SitePeer::BILLING_CLIENT_ID, $billingClientId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($billingClientId['max'])) {
                $this->addUsingAlias(SitePeer::BILLING_CLIENT_ID, $billingClientId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SitePeer::BILLING_CLIENT_ID, $billingClientId, $comparison);
    }

    /**
     * Filter the query on the code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE code = 'fooValue'
     * $query->filterByCode('%fooValue%'); // WHERE code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $code The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SiteQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $code)) {
                $code = str_replace('*', '%', $code);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SitePeer::CODE, $code, $comparison);
    }

    /**
     * Filter the query by a related Client object
     *
     * @param   Client|PropelObjectCollection $client The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 SiteQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByClient($client, $comparison = null)
    {
        if ($client instanceof Client) {
            return $this
                ->addUsingAlias(SitePeer::BILLING_CLIENT_ID, $client->getClientId(), $comparison);
        } elseif ($client instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SitePeer::BILLING_CLIENT_ID, $client->toKeyValue('PrimaryKey', 'ClientId'), $comparison);
        } else {
            throw new PropelException('filterByClient() only accepts arguments of type Client or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Client relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SiteQuery The current query, for fluid interface
     */
    public function joinClient($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Client');

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
            $this->addJoinObject($join, 'Client');
        }

        return $this;
    }

    /**
     * Use the Client relation Client object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Engine\BillingBundle\Model\ClientQuery A secondary query class using the current class as primary query
     */
    public function useClientQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinClient($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Client', '\Engine\BillingBundle\Model\ClientQuery');
    }

    /**
     * Filter the query by a related TeamMember object
     *
     * @param   TeamMember|PropelObjectCollection $teamMember  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 SiteQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTeamMember($teamMember, $comparison = null)
    {
        if ($teamMember instanceof TeamMember) {
            return $this
                ->addUsingAlias(SitePeer::TURNKEY_SITE_ID, $teamMember->getSiteId(), $comparison);
        } elseif ($teamMember instanceof PropelObjectCollection) {
            return $this
                ->useTeamMemberQuery()
                ->filterByPrimaryKeys($teamMember->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTeamMember() only accepts arguments of type TeamMember or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TeamMember relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SiteQuery The current query, for fluid interface
     */
    public function joinTeamMember($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TeamMember');

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
            $this->addJoinObject($join, 'TeamMember');
        }

        return $this;
    }

    /**
     * Use the TeamMember relation TeamMember object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Clients\TurnKeyBundle\Model\TeamMemberQuery A secondary query class using the current class as primary query
     */
    public function useTeamMemberQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTeamMember($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TeamMember', '\Clients\TurnKeyBundle\Model\TeamMemberQuery');
    }

    /**
     * Filter the query by a related Testimonial object
     *
     * @param   Testimonial|PropelObjectCollection $testimonial  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 SiteQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTestimonial($testimonial, $comparison = null)
    {
        if ($testimonial instanceof Testimonial) {
            return $this
                ->addUsingAlias(SitePeer::TURNKEY_SITE_ID, $testimonial->getSiteId(), $comparison);
        } elseif ($testimonial instanceof PropelObjectCollection) {
            return $this
                ->useTestimonialQuery()
                ->filterByPrimaryKeys($testimonial->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTestimonial() only accepts arguments of type Testimonial or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Testimonial relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SiteQuery The current query, for fluid interface
     */
    public function joinTestimonial($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Testimonial');

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
            $this->addJoinObject($join, 'Testimonial');
        }

        return $this;
    }

    /**
     * Use the Testimonial relation Testimonial object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Clients\TurnKeyBundle\Model\TestimonialQuery A secondary query class using the current class as primary query
     */
    public function useTestimonialQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTestimonial($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Testimonial', '\Clients\TurnKeyBundle\Model\TestimonialQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Site $site Object to remove from the list of results
     *
     * @return SiteQuery The current query, for fluid interface
     */
    public function prune($site = null)
    {
        if ($site) {
            $this->addUsingAlias(SitePeer::TURNKEY_SITE_ID, $site->getSiteId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
