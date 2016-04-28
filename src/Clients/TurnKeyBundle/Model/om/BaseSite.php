<?php

namespace Clients\TurnKeyBundle\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \DateTime;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelDateTime;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Clients\TurnKeyBundle\Model\Site;
use Clients\TurnKeyBundle\Model\SitePeer;
use Clients\TurnKeyBundle\Model\SiteQuery;
use Clients\TurnKeyBundle\Model\TeamMember;
use Clients\TurnKeyBundle\Model\TeamMemberQuery;
use Clients\TurnKeyBundle\Model\Testimonial;
use Clients\TurnKeyBundle\Model\TestimonialQuery;
use Engine\BillingBundle\Model\Client;
use Engine\BillingBundle\Model\ClientQuery;

abstract class BaseSite extends \Engine\EngineBundle\Base\EngineModel implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Clients\\TurnKeyBundle\\Model\\SitePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        SitePeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the turnkey_site_id field.
     * @var        int
     */
    protected $turnkey_site_id;

    /**
     * The value for the date_modified field.
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        string
     */
    protected $date_modified;

    /**
     * The value for the date_created field.
     * @var        string
     */
    protected $date_created;

    /**
     * The value for the billing_client_id field.
     * @var        int
     */
    protected $billing_client_id;

    /**
     * The value for the code field.
     * @var        string
     */
    protected $code;

    /**
     * @var        Client
     */
    protected $aClient;

    /**
     * @var        PropelObjectCollection|TeamMember[] Collection to store aggregation of TeamMember objects.
     */
    protected $collTeamMembers;
    protected $collTeamMembersPartial;

    /**
     * @var        PropelObjectCollection|Testimonial[] Collection to store aggregation of Testimonial objects.
     */
    protected $collTestimonials;
    protected $collTestimonialsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $teamMembersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $testimonialsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
    }

    /**
     * Initializes internal state of BaseSite object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [turnkey_site_id] column value.
     *
     * @return int
     */
    public function getSiteId()
    {
        return $this->turnkey_site_id;
    }

    /**
     * Get the [optionally formatted] temporal [date_modified] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateModified($format = null)
    {
        if ($this->date_modified === null) {
            return null;
        }

        if ($this->date_modified === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->date_modified);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->date_modified, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [optionally formatted] temporal [date_created] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateCreated($format = null)
    {
        if ($this->date_created === null) {
            return null;
        }

        if ($this->date_created === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->date_created);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->date_created, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [billing_client_id] column value.
     *
     * @return int
     */
    public function getBillingClientId()
    {
        return $this->billing_client_id;
    }

    /**
     * Get the [code] column value.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of [turnkey_site_id] column.
     *
     * @param int $v new value
     * @return Site The current object (for fluent API support)
     */
    public function setSiteId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->turnkey_site_id !== $v) {
            $this->turnkey_site_id = $v;
            $this->modifiedColumns[] = SitePeer::TURNKEY_SITE_ID;
        }


        return $this;
    } // setSiteId()

    /**
     * Sets the value of [date_modified] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Site The current object (for fluent API support)
     */
    public function setDateModified($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_modified !== null || $dt !== null) {
            $currentDateAsString = ($this->date_modified !== null && $tmpDt = new DateTime($this->date_modified)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_modified = $newDateAsString;
                $this->modifiedColumns[] = SitePeer::DATE_MODIFIED;
            }
        } // if either are not null


        return $this;
    } // setDateModified()

    /**
     * Sets the value of [date_created] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Site The current object (for fluent API support)
     */
    public function setDateCreated($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_created !== null || $dt !== null) {
            $currentDateAsString = ($this->date_created !== null && $tmpDt = new DateTime($this->date_created)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_created = $newDateAsString;
                $this->modifiedColumns[] = SitePeer::DATE_CREATED;
            }
        } // if either are not null


        return $this;
    } // setDateCreated()

    /**
     * Set the value of [billing_client_id] column.
     *
     * @param int $v new value
     * @return Site The current object (for fluent API support)
     */
    public function setBillingClientId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->billing_client_id !== $v) {
            $this->billing_client_id = $v;
            $this->modifiedColumns[] = SitePeer::BILLING_CLIENT_ID;
        }

        if ($this->aClient !== null && $this->aClient->getClientId() !== $v) {
            $this->aClient = null;
        }


        return $this;
    } // setBillingClientId()

    /**
     * Set the value of [code] column.
     *
     * @param string $v new value
     * @return Site The current object (for fluent API support)
     */
    public function setCode($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->code !== $v) {
            $this->code = $v;
            $this->modifiedColumns[] = SitePeer::CODE;
        }


        return $this;
    } // setCode()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->turnkey_site_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->date_modified = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->date_created = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->billing_client_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->code = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 5; // 5 = SitePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Site object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

        if ($this->aClient !== null && $this->billing_client_id !== $this->aClient->getClientId()) {
            $this->aClient = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(SitePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = SitePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aClient = null;
            $this->collTeamMembers = null;

            $this->collTestimonials = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(SitePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = SiteQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(SitePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                SitePeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aClient !== null) {
                if ($this->aClient->isModified() || $this->aClient->isNew()) {
                    $affectedRows += $this->aClient->save($con);
                }
                $this->setClient($this->aClient);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->teamMembersScheduledForDeletion !== null) {
                if (!$this->teamMembersScheduledForDeletion->isEmpty()) {
                    TeamMemberQuery::create()
                        ->filterByPrimaryKeys($this->teamMembersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->teamMembersScheduledForDeletion = null;
                }
            }

            if ($this->collTeamMembers !== null) {
                foreach ($this->collTeamMembers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->testimonialsScheduledForDeletion !== null) {
                if (!$this->testimonialsScheduledForDeletion->isEmpty()) {
                    TestimonialQuery::create()
                        ->filterByPrimaryKeys($this->testimonialsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->testimonialsScheduledForDeletion = null;
                }
            }

            if ($this->collTestimonials !== null) {
                foreach ($this->collTestimonials as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = SitePeer::TURNKEY_SITE_ID;
        if (null !== $this->turnkey_site_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SitePeer::TURNKEY_SITE_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SitePeer::TURNKEY_SITE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`turnkey_site_id`';
        }
        if ($this->isColumnModified(SitePeer::DATE_MODIFIED)) {
            $modifiedColumns[':p' . $index++]  = '`date_modified`';
        }
        if ($this->isColumnModified(SitePeer::DATE_CREATED)) {
            $modifiedColumns[':p' . $index++]  = '`date_created`';
        }
        if ($this->isColumnModified(SitePeer::BILLING_CLIENT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`billing_client_id`';
        }
        if ($this->isColumnModified(SitePeer::CODE)) {
            $modifiedColumns[':p' . $index++]  = '`code`';
        }

        $sql = sprintf(
            'INSERT INTO `turnkey_site` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`turnkey_site_id`':
                        $stmt->bindValue($identifier, $this->turnkey_site_id, PDO::PARAM_INT);
                        break;
                    case '`date_modified`':
                        $stmt->bindValue($identifier, $this->date_modified, PDO::PARAM_STR);
                        break;
                    case '`date_created`':
                        $stmt->bindValue($identifier, $this->date_created, PDO::PARAM_STR);
                        break;
                    case '`billing_client_id`':
                        $stmt->bindValue($identifier, $this->billing_client_id, PDO::PARAM_INT);
                        break;
                    case '`code`':
                        $stmt->bindValue($identifier, $this->code, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setSiteId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggreagated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            // We call the validate method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aClient !== null) {
                if (!$this->aClient->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aClient->getValidationFailures());
                }
            }


            if (($retval = SitePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collTeamMembers !== null) {
                    foreach ($this->collTeamMembers as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTestimonials !== null) {
                    foreach ($this->collTestimonials as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = SitePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getSiteId();
                break;
            case 1:
                return $this->getDateModified();
                break;
            case 2:
                return $this->getDateCreated();
                break;
            case 3:
                return $this->getBillingClientId();
                break;
            case 4:
                return $this->getCode();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Site'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Site'][$this->getPrimaryKey()] = true;
        $keys = SitePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getSiteId(),
            $keys[1] => $this->getDateModified(),
            $keys[2] => $this->getDateCreated(),
            $keys[3] => $this->getBillingClientId(),
            $keys[4] => $this->getCode(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aClient) {
                $result['Client'] = $this->aClient->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collTeamMembers) {
                $result['TeamMembers'] = $this->collTeamMembers->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTestimonials) {
                $result['Testimonials'] = $this->collTestimonials->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = SitePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setSiteId($value);
                break;
            case 1:
                $this->setDateModified($value);
                break;
            case 2:
                $this->setDateCreated($value);
                break;
            case 3:
                $this->setBillingClientId($value);
                break;
            case 4:
                $this->setCode($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = SitePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setSiteId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setDateModified($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setDateCreated($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setBillingClientId($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setCode($arr[$keys[4]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(SitePeer::DATABASE_NAME);

        if ($this->isColumnModified(SitePeer::TURNKEY_SITE_ID)) $criteria->add(SitePeer::TURNKEY_SITE_ID, $this->turnkey_site_id);
        if ($this->isColumnModified(SitePeer::DATE_MODIFIED)) $criteria->add(SitePeer::DATE_MODIFIED, $this->date_modified);
        if ($this->isColumnModified(SitePeer::DATE_CREATED)) $criteria->add(SitePeer::DATE_CREATED, $this->date_created);
        if ($this->isColumnModified(SitePeer::BILLING_CLIENT_ID)) $criteria->add(SitePeer::BILLING_CLIENT_ID, $this->billing_client_id);
        if ($this->isColumnModified(SitePeer::CODE)) $criteria->add(SitePeer::CODE, $this->code);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(SitePeer::DATABASE_NAME);
        $criteria->add(SitePeer::TURNKEY_SITE_ID, $this->turnkey_site_id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getSiteId();
    }

    /**
     * Generic method to set the primary key (turnkey_site_id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setSiteId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getSiteId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Site (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setDateModified($this->getDateModified());
        $copyObj->setDateCreated($this->getDateCreated());
        $copyObj->setBillingClientId($this->getBillingClientId());
        $copyObj->setCode($this->getCode());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getTeamMembers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTeamMember($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTestimonials() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTestimonial($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setSiteId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Site Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return SitePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new SitePeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Client object.
     *
     * @param             Client $v
     * @return Site The current object (for fluent API support)
     * @throws PropelException
     */
    public function setClient(Client $v = null)
    {
        if ($v === null) {
            $this->setBillingClientId(NULL);
        } else {
            $this->setBillingClientId($v->getClientId());
        }

        $this->aClient = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Client object, it will not be re-added.
        if ($v !== null) {
            $v->addSite($this);
        }


        return $this;
    }


    /**
     * Get the associated Client object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Client The associated Client object.
     * @throws PropelException
     */
    public function getClient(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aClient === null && ($this->billing_client_id !== null) && $doQuery) {
            $this->aClient = ClientQuery::create()->findPk($this->billing_client_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aClient->addSites($this);
             */
        }

        return $this->aClient;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('TeamMember' == $relationName) {
            $this->initTeamMembers();
        }
        if ('Testimonial' == $relationName) {
            $this->initTestimonials();
        }
    }

    /**
     * Clears out the collTeamMembers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Site The current object (for fluent API support)
     * @see        addTeamMembers()
     */
    public function clearTeamMembers()
    {
        $this->collTeamMembers = null; // important to set this to null since that means it is uninitialized
        $this->collTeamMembersPartial = null;

        return $this;
    }

    /**
     * reset is the collTeamMembers collection loaded partially
     *
     * @return void
     */
    public function resetPartialTeamMembers($v = true)
    {
        $this->collTeamMembersPartial = $v;
    }

    /**
     * Initializes the collTeamMembers collection.
     *
     * By default this just sets the collTeamMembers collection to an empty array (like clearcollTeamMembers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTeamMembers($overrideExisting = true)
    {
        if (null !== $this->collTeamMembers && !$overrideExisting) {
            return;
        }
        $this->collTeamMembers = new PropelObjectCollection();
        $this->collTeamMembers->setModel('TeamMember');
    }

    /**
     * Gets an array of TeamMember objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Site is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TeamMember[] List of TeamMember objects
     * @throws PropelException
     */
    public function getTeamMembers($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTeamMembersPartial && !$this->isNew();
        if (null === $this->collTeamMembers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTeamMembers) {
                // return empty collection
                $this->initTeamMembers();
            } else {
                $collTeamMembers = TeamMemberQuery::create(null, $criteria)
                    ->filterBySite($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTeamMembersPartial && count($collTeamMembers)) {
                      $this->initTeamMembers(false);

                      foreach($collTeamMembers as $obj) {
                        if (false == $this->collTeamMembers->contains($obj)) {
                          $this->collTeamMembers->append($obj);
                        }
                      }

                      $this->collTeamMembersPartial = true;
                    }

                    $collTeamMembers->getInternalIterator()->rewind();
                    return $collTeamMembers;
                }

                if($partial && $this->collTeamMembers) {
                    foreach($this->collTeamMembers as $obj) {
                        if($obj->isNew()) {
                            $collTeamMembers[] = $obj;
                        }
                    }
                }

                $this->collTeamMembers = $collTeamMembers;
                $this->collTeamMembersPartial = false;
            }
        }

        return $this->collTeamMembers;
    }

    /**
     * Sets a collection of TeamMember objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $teamMembers A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Site The current object (for fluent API support)
     */
    public function setTeamMembers(PropelCollection $teamMembers, PropelPDO $con = null)
    {
        $teamMembersToDelete = $this->getTeamMembers(new Criteria(), $con)->diff($teamMembers);

        $this->teamMembersScheduledForDeletion = unserialize(serialize($teamMembersToDelete));

        foreach ($teamMembersToDelete as $teamMemberRemoved) {
            $teamMemberRemoved->setSite(null);
        }

        $this->collTeamMembers = null;
        foreach ($teamMembers as $teamMember) {
            $this->addTeamMember($teamMember);
        }

        $this->collTeamMembers = $teamMembers;
        $this->collTeamMembersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related TeamMember objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TeamMember objects.
     * @throws PropelException
     */
    public function countTeamMembers(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTeamMembersPartial && !$this->isNew();
        if (null === $this->collTeamMembers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTeamMembers) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getTeamMembers());
            }
            $query = TeamMemberQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySite($this)
                ->count($con);
        }

        return count($this->collTeamMembers);
    }

    /**
     * Method called to associate a TeamMember object to this object
     * through the TeamMember foreign key attribute.
     *
     * @param    TeamMember $l TeamMember
     * @return Site The current object (for fluent API support)
     */
    public function addTeamMember(TeamMember $l)
    {
        if ($this->collTeamMembers === null) {
            $this->initTeamMembers();
            $this->collTeamMembersPartial = true;
        }
        if (!in_array($l, $this->collTeamMembers->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTeamMember($l);
        }

        return $this;
    }

    /**
     * @param	TeamMember $teamMember The teamMember object to add.
     */
    protected function doAddTeamMember($teamMember)
    {
        $this->collTeamMembers[]= $teamMember;
        $teamMember->setSite($this);
    }

    /**
     * @param	TeamMember $teamMember The teamMember object to remove.
     * @return Site The current object (for fluent API support)
     */
    public function removeTeamMember($teamMember)
    {
        if ($this->getTeamMembers()->contains($teamMember)) {
            $this->collTeamMembers->remove($this->collTeamMembers->search($teamMember));
            if (null === $this->teamMembersScheduledForDeletion) {
                $this->teamMembersScheduledForDeletion = clone $this->collTeamMembers;
                $this->teamMembersScheduledForDeletion->clear();
            }
            $this->teamMembersScheduledForDeletion[]= clone $teamMember;
            $teamMember->setSite(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Site is new, it will return
     * an empty collection; or if this Site has previously
     * been saved, it will retrieve related TeamMembers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Site.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TeamMember[] List of TeamMember objects
     */
    public function getTeamMembersJoinEmployee($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TeamMemberQuery::create(null, $criteria);
        $query->joinWith('Employee', $join_behavior);

        return $this->getTeamMembers($query, $con);
    }

    /**
     * Clears out the collTestimonials collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Site The current object (for fluent API support)
     * @see        addTestimonials()
     */
    public function clearTestimonials()
    {
        $this->collTestimonials = null; // important to set this to null since that means it is uninitialized
        $this->collTestimonialsPartial = null;

        return $this;
    }

    /**
     * reset is the collTestimonials collection loaded partially
     *
     * @return void
     */
    public function resetPartialTestimonials($v = true)
    {
        $this->collTestimonialsPartial = $v;
    }

    /**
     * Initializes the collTestimonials collection.
     *
     * By default this just sets the collTestimonials collection to an empty array (like clearcollTestimonials());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTestimonials($overrideExisting = true)
    {
        if (null !== $this->collTestimonials && !$overrideExisting) {
            return;
        }
        $this->collTestimonials = new PropelObjectCollection();
        $this->collTestimonials->setModel('Testimonial');
    }

    /**
     * Gets an array of Testimonial objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Site is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Testimonial[] List of Testimonial objects
     * @throws PropelException
     */
    public function getTestimonials($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTestimonialsPartial && !$this->isNew();
        if (null === $this->collTestimonials || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTestimonials) {
                // return empty collection
                $this->initTestimonials();
            } else {
                $collTestimonials = TestimonialQuery::create(null, $criteria)
                    ->filterBySite($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTestimonialsPartial && count($collTestimonials)) {
                      $this->initTestimonials(false);

                      foreach($collTestimonials as $obj) {
                        if (false == $this->collTestimonials->contains($obj)) {
                          $this->collTestimonials->append($obj);
                        }
                      }

                      $this->collTestimonialsPartial = true;
                    }

                    $collTestimonials->getInternalIterator()->rewind();
                    return $collTestimonials;
                }

                if($partial && $this->collTestimonials) {
                    foreach($this->collTestimonials as $obj) {
                        if($obj->isNew()) {
                            $collTestimonials[] = $obj;
                        }
                    }
                }

                $this->collTestimonials = $collTestimonials;
                $this->collTestimonialsPartial = false;
            }
        }

        return $this->collTestimonials;
    }

    /**
     * Sets a collection of Testimonial objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $testimonials A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Site The current object (for fluent API support)
     */
    public function setTestimonials(PropelCollection $testimonials, PropelPDO $con = null)
    {
        $testimonialsToDelete = $this->getTestimonials(new Criteria(), $con)->diff($testimonials);

        $this->testimonialsScheduledForDeletion = unserialize(serialize($testimonialsToDelete));

        foreach ($testimonialsToDelete as $testimonialRemoved) {
            $testimonialRemoved->setSite(null);
        }

        $this->collTestimonials = null;
        foreach ($testimonials as $testimonial) {
            $this->addTestimonial($testimonial);
        }

        $this->collTestimonials = $testimonials;
        $this->collTestimonialsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Testimonial objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Testimonial objects.
     * @throws PropelException
     */
    public function countTestimonials(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTestimonialsPartial && !$this->isNew();
        if (null === $this->collTestimonials || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTestimonials) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getTestimonials());
            }
            $query = TestimonialQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySite($this)
                ->count($con);
        }

        return count($this->collTestimonials);
    }

    /**
     * Method called to associate a Testimonial object to this object
     * through the Testimonial foreign key attribute.
     *
     * @param    Testimonial $l Testimonial
     * @return Site The current object (for fluent API support)
     */
    public function addTestimonial(Testimonial $l)
    {
        if ($this->collTestimonials === null) {
            $this->initTestimonials();
            $this->collTestimonialsPartial = true;
        }
        if (!in_array($l, $this->collTestimonials->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTestimonial($l);
        }

        return $this;
    }

    /**
     * @param	Testimonial $testimonial The testimonial object to add.
     */
    protected function doAddTestimonial($testimonial)
    {
        $this->collTestimonials[]= $testimonial;
        $testimonial->setSite($this);
    }

    /**
     * @param	Testimonial $testimonial The testimonial object to remove.
     * @return Site The current object (for fluent API support)
     */
    public function removeTestimonial($testimonial)
    {
        if ($this->getTestimonials()->contains($testimonial)) {
            $this->collTestimonials->remove($this->collTestimonials->search($testimonial));
            if (null === $this->testimonialsScheduledForDeletion) {
                $this->testimonialsScheduledForDeletion = clone $this->collTestimonials;
                $this->testimonialsScheduledForDeletion->clear();
            }
            $this->testimonialsScheduledForDeletion[]= clone $testimonial;
            $testimonial->setSite(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Site is new, it will return
     * an empty collection; or if this Site has previously
     * been saved, it will retrieve related Testimonials from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Site.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Testimonial[] List of Testimonial objects
     */
    public function getTestimonialsJoinImage($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TestimonialQuery::create(null, $criteria);
        $query->joinWith('Image', $join_behavior);

        return $this->getTestimonials($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->turnkey_site_id = null;
        $this->date_modified = null;
        $this->date_created = null;
        $this->billing_client_id = null;
        $this->code = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volumne/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collTeamMembers) {
                foreach ($this->collTeamMembers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTestimonials) {
                foreach ($this->collTestimonials as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aClient instanceof Persistent) {
              $this->aClient->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collTeamMembers instanceof PropelCollection) {
            $this->collTeamMembers->clearIterator();
        }
        $this->collTeamMembers = null;
        if ($this->collTestimonials instanceof PropelCollection) {
            $this->collTestimonials->clearIterator();
        }
        $this->collTestimonials = null;
        $this->aClient = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SitePeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
