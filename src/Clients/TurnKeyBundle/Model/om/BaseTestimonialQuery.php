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
use Clients\TurnKeyBundle\Model\Testimonial;
use Clients\TurnKeyBundle\Model\TestimonialPeer;
use Clients\TurnKeyBundle\Model\TestimonialQuery;
use Engine\MediaBundle\Model\Image;

/**
 * @method TestimonialQuery orderByTestimonialId($order = Criteria::ASC) Order by the turnkey_testimonial_id column
 * @method TestimonialQuery orderByDateModified($order = Criteria::ASC) Order by the date_modified column
 * @method TestimonialQuery orderByDateCreated($order = Criteria::ASC) Order by the date_created column
 * @method TestimonialQuery orderBySiteId($order = Criteria::ASC) Order by the turnkey_site_id column
 * @method TestimonialQuery orderByMediaImageId($order = Criteria::ASC) Order by the media_image_id column
 * @method TestimonialQuery orderBySignature($order = Criteria::ASC) Order by the signature column
 * @method TestimonialQuery orderByMainText($order = Criteria::ASC) Order by the main_text column
 * @method TestimonialQuery orderBySortOrder($order = Criteria::ASC) Order by the sort_order column
 *
 * @method TestimonialQuery groupByTestimonialId() Group by the turnkey_testimonial_id column
 * @method TestimonialQuery groupByDateModified() Group by the date_modified column
 * @method TestimonialQuery groupByDateCreated() Group by the date_created column
 * @method TestimonialQuery groupBySiteId() Group by the turnkey_site_id column
 * @method TestimonialQuery groupByMediaImageId() Group by the media_image_id column
 * @method TestimonialQuery groupBySignature() Group by the signature column
 * @method TestimonialQuery groupByMainText() Group by the main_text column
 * @method TestimonialQuery groupBySortOrder() Group by the sort_order column
 *
 * @method TestimonialQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TestimonialQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TestimonialQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TestimonialQuery leftJoinSite($relationAlias = null) Adds a LEFT JOIN clause to the query using the Site relation
 * @method TestimonialQuery rightJoinSite($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Site relation
 * @method TestimonialQuery innerJoinSite($relationAlias = null) Adds a INNER JOIN clause to the query using the Site relation
 *
 * @method TestimonialQuery leftJoinImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Image relation
 * @method TestimonialQuery rightJoinImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Image relation
 * @method TestimonialQuery innerJoinImage($relationAlias = null) Adds a INNER JOIN clause to the query using the Image relation
 *
 * @method Testimonial findOne(PropelPDO $con = null) Return the first Testimonial matching the query
 * @method Testimonial findOneOrCreate(PropelPDO $con = null) Return the first Testimonial matching the query, or a new Testimonial object populated from the query conditions when no match is found
 *
 * @method Testimonial findOneByDateModified(string $date_modified) Return the first Testimonial filtered by the date_modified column
 * @method Testimonial findOneByDateCreated(string $date_created) Return the first Testimonial filtered by the date_created column
 * @method Testimonial findOneBySiteId(int $turnkey_site_id) Return the first Testimonial filtered by the turnkey_site_id column
 * @method Testimonial findOneByMediaImageId(int $media_image_id) Return the first Testimonial filtered by the media_image_id column
 * @method Testimonial findOneBySignature(string $signature) Return the first Testimonial filtered by the signature column
 * @method Testimonial findOneByMainText(string $main_text) Return the first Testimonial filtered by the main_text column
 * @method Testimonial findOneBySortOrder(int $sort_order) Return the first Testimonial filtered by the sort_order column
 *
 * @method array findByTestimonialId(int $turnkey_testimonial_id) Return Testimonial objects filtered by the turnkey_testimonial_id column
 * @method array findByDateModified(string $date_modified) Return Testimonial objects filtered by the date_modified column
 * @method array findByDateCreated(string $date_created) Return Testimonial objects filtered by the date_created column
 * @method array findBySiteId(int $turnkey_site_id) Return Testimonial objects filtered by the turnkey_site_id column
 * @method array findByMediaImageId(int $media_image_id) Return Testimonial objects filtered by the media_image_id column
 * @method array findBySignature(string $signature) Return Testimonial objects filtered by the signature column
 * @method array findByMainText(string $main_text) Return Testimonial objects filtered by the main_text column
 * @method array findBySortOrder(int $sort_order) Return Testimonial objects filtered by the sort_order column
 */
abstract class BaseTestimonialQuery extends \Engine\EngineBundle\Base\EngineQuery
{
    /**
     * Initializes internal state of BaseTestimonialQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'Clients\\TurnKeyBundle\\Model\\Testimonial', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TestimonialQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   TestimonialQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TestimonialQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TestimonialQuery) {
            return $criteria;
        }
        $query = new TestimonialQuery();
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
     * @return   Testimonial|Testimonial[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TestimonialPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TestimonialPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Testimonial A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByTestimonialId($key, $con = null)
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
     * @return                 Testimonial A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `turnkey_testimonial_id`, `date_modified`, `date_created`, `turnkey_site_id`, `media_image_id`, `signature`, `main_text`, `sort_order` FROM `turnkey_testimonial` WHERE `turnkey_testimonial_id` = :p0';
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
            $obj = new Testimonial();
            $obj->hydrate($row);
            TestimonialPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Testimonial|Testimonial[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Testimonial[]|mixed the list of results, formatted by the current formatter
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
     * @return TestimonialQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TestimonialPeer::TURNKEY_TESTIMONIAL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TestimonialQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TestimonialPeer::TURNKEY_TESTIMONIAL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the turnkey_testimonial_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTestimonialId(1234); // WHERE turnkey_testimonial_id = 1234
     * $query->filterByTestimonialId(array(12, 34)); // WHERE turnkey_testimonial_id IN (12, 34)
     * $query->filterByTestimonialId(array('min' => 12)); // WHERE turnkey_testimonial_id >= 12
     * $query->filterByTestimonialId(array('max' => 12)); // WHERE turnkey_testimonial_id <= 12
     * </code>
     *
     * @param     mixed $testimonialId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TestimonialQuery The current query, for fluid interface
     */
    public function filterByTestimonialId($testimonialId = null, $comparison = null)
    {
        if (is_array($testimonialId)) {
            $useMinMax = false;
            if (isset($testimonialId['min'])) {
                $this->addUsingAlias(TestimonialPeer::TURNKEY_TESTIMONIAL_ID, $testimonialId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($testimonialId['max'])) {
                $this->addUsingAlias(TestimonialPeer::TURNKEY_TESTIMONIAL_ID, $testimonialId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TestimonialPeer::TURNKEY_TESTIMONIAL_ID, $testimonialId, $comparison);
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
     * @return TestimonialQuery The current query, for fluid interface
     */
    public function filterByDateModified($dateModified = null, $comparison = null)
    {
        if (is_array($dateModified)) {
            $useMinMax = false;
            if (isset($dateModified['min'])) {
                $this->addUsingAlias(TestimonialPeer::DATE_MODIFIED, $dateModified['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateModified['max'])) {
                $this->addUsingAlias(TestimonialPeer::DATE_MODIFIED, $dateModified['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TestimonialPeer::DATE_MODIFIED, $dateModified, $comparison);
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
     * @return TestimonialQuery The current query, for fluid interface
     */
    public function filterByDateCreated($dateCreated = null, $comparison = null)
    {
        if (is_array($dateCreated)) {
            $useMinMax = false;
            if (isset($dateCreated['min'])) {
                $this->addUsingAlias(TestimonialPeer::DATE_CREATED, $dateCreated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateCreated['max'])) {
                $this->addUsingAlias(TestimonialPeer::DATE_CREATED, $dateCreated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TestimonialPeer::DATE_CREATED, $dateCreated, $comparison);
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
     * @return TestimonialQuery The current query, for fluid interface
     */
    public function filterBySiteId($siteId = null, $comparison = null)
    {
        if (is_array($siteId)) {
            $useMinMax = false;
            if (isset($siteId['min'])) {
                $this->addUsingAlias(TestimonialPeer::TURNKEY_SITE_ID, $siteId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($siteId['max'])) {
                $this->addUsingAlias(TestimonialPeer::TURNKEY_SITE_ID, $siteId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TestimonialPeer::TURNKEY_SITE_ID, $siteId, $comparison);
    }

    /**
     * Filter the query on the media_image_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMediaImageId(1234); // WHERE media_image_id = 1234
     * $query->filterByMediaImageId(array(12, 34)); // WHERE media_image_id IN (12, 34)
     * $query->filterByMediaImageId(array('min' => 12)); // WHERE media_image_id >= 12
     * $query->filterByMediaImageId(array('max' => 12)); // WHERE media_image_id <= 12
     * </code>
     *
     * @see       filterByImage()
     *
     * @param     mixed $mediaImageId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TestimonialQuery The current query, for fluid interface
     */
    public function filterByMediaImageId($mediaImageId = null, $comparison = null)
    {
        if (is_array($mediaImageId)) {
            $useMinMax = false;
            if (isset($mediaImageId['min'])) {
                $this->addUsingAlias(TestimonialPeer::MEDIA_IMAGE_ID, $mediaImageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mediaImageId['max'])) {
                $this->addUsingAlias(TestimonialPeer::MEDIA_IMAGE_ID, $mediaImageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TestimonialPeer::MEDIA_IMAGE_ID, $mediaImageId, $comparison);
    }

    /**
     * Filter the query on the signature column
     *
     * Example usage:
     * <code>
     * $query->filterBySignature('fooValue');   // WHERE signature = 'fooValue'
     * $query->filterBySignature('%fooValue%'); // WHERE signature LIKE '%fooValue%'
     * </code>
     *
     * @param     string $signature The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TestimonialQuery The current query, for fluid interface
     */
    public function filterBySignature($signature = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($signature)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $signature)) {
                $signature = str_replace('*', '%', $signature);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TestimonialPeer::SIGNATURE, $signature, $comparison);
    }

    /**
     * Filter the query on the main_text column
     *
     * Example usage:
     * <code>
     * $query->filterByMainText('fooValue');   // WHERE main_text = 'fooValue'
     * $query->filterByMainText('%fooValue%'); // WHERE main_text LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mainText The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TestimonialQuery The current query, for fluid interface
     */
    public function filterByMainText($mainText = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mainText)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $mainText)) {
                $mainText = str_replace('*', '%', $mainText);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TestimonialPeer::MAIN_TEXT, $mainText, $comparison);
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
     * @return TestimonialQuery The current query, for fluid interface
     */
    public function filterBySortOrder($sortOrder = null, $comparison = null)
    {
        if (is_array($sortOrder)) {
            $useMinMax = false;
            if (isset($sortOrder['min'])) {
                $this->addUsingAlias(TestimonialPeer::SORT_ORDER, $sortOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sortOrder['max'])) {
                $this->addUsingAlias(TestimonialPeer::SORT_ORDER, $sortOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TestimonialPeer::SORT_ORDER, $sortOrder, $comparison);
    }

    /**
     * Filter the query by a related Site object
     *
     * @param   Site|PropelObjectCollection $site The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TestimonialQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterBySite($site, $comparison = null)
    {
        if ($site instanceof Site) {
            return $this
                ->addUsingAlias(TestimonialPeer::TURNKEY_SITE_ID, $site->getSiteId(), $comparison);
        } elseif ($site instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TestimonialPeer::TURNKEY_SITE_ID, $site->toKeyValue('PrimaryKey', 'SiteId'), $comparison);
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
     * @return TestimonialQuery The current query, for fluid interface
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
     * Filter the query by a related Image object
     *
     * @param   Image|PropelObjectCollection $image The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TestimonialQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByImage($image, $comparison = null)
    {
        if ($image instanceof Image) {
            return $this
                ->addUsingAlias(TestimonialPeer::MEDIA_IMAGE_ID, $image->getImageId(), $comparison);
        } elseif ($image instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TestimonialPeer::MEDIA_IMAGE_ID, $image->toKeyValue('PrimaryKey', 'ImageId'), $comparison);
        } else {
            throw new PropelException('filterByImage() only accepts arguments of type Image or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Image relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TestimonialQuery The current query, for fluid interface
     */
    public function joinImage($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Image');

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
            $this->addJoinObject($join, 'Image');
        }

        return $this;
    }

    /**
     * Use the Image relation Image object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Engine\MediaBundle\Model\ImageQuery A secondary query class using the current class as primary query
     */
    public function useImageQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Image', '\Engine\MediaBundle\Model\ImageQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Testimonial $testimonial Object to remove from the list of results
     *
     * @return TestimonialQuery The current query, for fluid interface
     */
    public function prune($testimonial = null)
    {
        if ($testimonial) {
            $this->addUsingAlias(TestimonialPeer::TURNKEY_TESTIMONIAL_ID, $testimonial->getTestimonialId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
