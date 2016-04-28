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
use \PropelDateTime;
use \PropelException;
use \PropelPDO;
use Clients\TurnKeyBundle\Model\Site;
use Clients\TurnKeyBundle\Model\SiteQuery;
use Clients\TurnKeyBundle\Model\Testimonial;
use Clients\TurnKeyBundle\Model\TestimonialPeer;
use Clients\TurnKeyBundle\Model\TestimonialQuery;
use Engine\MediaBundle\Model\Image;
use Engine\MediaBundle\Model\ImageQuery;

abstract class BaseTestimonial extends \Engine\EngineBundle\Base\EngineModel implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Clients\\TurnKeyBundle\\Model\\TestimonialPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        TestimonialPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the turnkey_testimonial_id field.
     * @var        int
     */
    protected $turnkey_testimonial_id;

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
     * The value for the turnkey_site_id field.
     * @var        int
     */
    protected $turnkey_site_id;

    /**
     * The value for the media_image_id field.
     * @var        int
     */
    protected $media_image_id;

    /**
     * The value for the signature field.
     * @var        string
     */
    protected $signature;

    /**
     * The value for the main_text field.
     * @var        string
     */
    protected $main_text;

    /**
     * The value for the sort_order field.
     * @var        int
     */
    protected $sort_order;

    /**
     * @var        Site
     */
    protected $aSite;

    /**
     * @var        Image
     */
    protected $aImage;

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
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
    }

    /**
     * Initializes internal state of BaseTestimonial object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [turnkey_testimonial_id] column value.
     *
     * @return int
     */
    public function getTestimonialId()
    {
        return $this->turnkey_testimonial_id;
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
     * Get the [turnkey_site_id] column value.
     *
     * @return int
     */
    public function getSiteId()
    {
        return $this->turnkey_site_id;
    }

    /**
     * Get the [media_image_id] column value.
     *
     * @return int
     */
    public function getMediaImageId()
    {
        return $this->media_image_id;
    }

    /**
     * Get the [signature] column value.
     *
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Get the [main_text] column value.
     *
     * @return string
     */
    public function getMainText()
    {
        return $this->main_text;
    }

    /**
     * Get the [sort_order] column value.
     *
     * @return int
     */
    public function getSortOrder()
    {
        return $this->sort_order;
    }

    /**
     * Set the value of [turnkey_testimonial_id] column.
     *
     * @param int $v new value
     * @return Testimonial The current object (for fluent API support)
     */
    public function setTestimonialId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->turnkey_testimonial_id !== $v) {
            $this->turnkey_testimonial_id = $v;
            $this->modifiedColumns[] = TestimonialPeer::TURNKEY_TESTIMONIAL_ID;
        }


        return $this;
    } // setTestimonialId()

    /**
     * Sets the value of [date_modified] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Testimonial The current object (for fluent API support)
     */
    public function setDateModified($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_modified !== null || $dt !== null) {
            $currentDateAsString = ($this->date_modified !== null && $tmpDt = new DateTime($this->date_modified)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_modified = $newDateAsString;
                $this->modifiedColumns[] = TestimonialPeer::DATE_MODIFIED;
            }
        } // if either are not null


        return $this;
    } // setDateModified()

    /**
     * Sets the value of [date_created] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Testimonial The current object (for fluent API support)
     */
    public function setDateCreated($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_created !== null || $dt !== null) {
            $currentDateAsString = ($this->date_created !== null && $tmpDt = new DateTime($this->date_created)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_created = $newDateAsString;
                $this->modifiedColumns[] = TestimonialPeer::DATE_CREATED;
            }
        } // if either are not null


        return $this;
    } // setDateCreated()

    /**
     * Set the value of [turnkey_site_id] column.
     *
     * @param int $v new value
     * @return Testimonial The current object (for fluent API support)
     */
    public function setSiteId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->turnkey_site_id !== $v) {
            $this->turnkey_site_id = $v;
            $this->modifiedColumns[] = TestimonialPeer::TURNKEY_SITE_ID;
        }

        if ($this->aSite !== null && $this->aSite->getSiteId() !== $v) {
            $this->aSite = null;
        }


        return $this;
    } // setSiteId()

    /**
     * Set the value of [media_image_id] column.
     *
     * @param int $v new value
     * @return Testimonial The current object (for fluent API support)
     */
    public function setMediaImageId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->media_image_id !== $v) {
            $this->media_image_id = $v;
            $this->modifiedColumns[] = TestimonialPeer::MEDIA_IMAGE_ID;
        }

        if ($this->aImage !== null && $this->aImage->getImageId() !== $v) {
            $this->aImage = null;
        }


        return $this;
    } // setMediaImageId()

    /**
     * Set the value of [signature] column.
     *
     * @param string $v new value
     * @return Testimonial The current object (for fluent API support)
     */
    public function setSignature($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->signature !== $v) {
            $this->signature = $v;
            $this->modifiedColumns[] = TestimonialPeer::SIGNATURE;
        }


        return $this;
    } // setSignature()

    /**
     * Set the value of [main_text] column.
     *
     * @param string $v new value
     * @return Testimonial The current object (for fluent API support)
     */
    public function setMainText($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->main_text !== $v) {
            $this->main_text = $v;
            $this->modifiedColumns[] = TestimonialPeer::MAIN_TEXT;
        }


        return $this;
    } // setMainText()

    /**
     * Set the value of [sort_order] column.
     *
     * @param int $v new value
     * @return Testimonial The current object (for fluent API support)
     */
    public function setSortOrder($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->sort_order !== $v) {
            $this->sort_order = $v;
            $this->modifiedColumns[] = TestimonialPeer::SORT_ORDER;
        }


        return $this;
    } // setSortOrder()

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

            $this->turnkey_testimonial_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->date_modified = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->date_created = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->turnkey_site_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->media_image_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->signature = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->main_text = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->sort_order = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 8; // 8 = TestimonialPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Testimonial object", $e);
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

        if ($this->aSite !== null && $this->turnkey_site_id !== $this->aSite->getSiteId()) {
            $this->aSite = null;
        }
        if ($this->aImage !== null && $this->media_image_id !== $this->aImage->getImageId()) {
            $this->aImage = null;
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
            $con = Propel::getConnection(TestimonialPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = TestimonialPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSite = null;
            $this->aImage = null;
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
            $con = Propel::getConnection(TestimonialPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = TestimonialQuery::create()
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
            $con = Propel::getConnection(TestimonialPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                TestimonialPeer::addInstanceToPool($this);
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

            if ($this->aSite !== null) {
                if ($this->aSite->isModified() || $this->aSite->isNew()) {
                    $affectedRows += $this->aSite->save($con);
                }
                $this->setSite($this->aSite);
            }

            if ($this->aImage !== null) {
                if ($this->aImage->isModified() || $this->aImage->isNew()) {
                    $affectedRows += $this->aImage->save($con);
                }
                $this->setImage($this->aImage);
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

        $this->modifiedColumns[] = TestimonialPeer::TURNKEY_TESTIMONIAL_ID;
        if (null !== $this->turnkey_testimonial_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TestimonialPeer::TURNKEY_TESTIMONIAL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TestimonialPeer::TURNKEY_TESTIMONIAL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`turnkey_testimonial_id`';
        }
        if ($this->isColumnModified(TestimonialPeer::DATE_MODIFIED)) {
            $modifiedColumns[':p' . $index++]  = '`date_modified`';
        }
        if ($this->isColumnModified(TestimonialPeer::DATE_CREATED)) {
            $modifiedColumns[':p' . $index++]  = '`date_created`';
        }
        if ($this->isColumnModified(TestimonialPeer::TURNKEY_SITE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`turnkey_site_id`';
        }
        if ($this->isColumnModified(TestimonialPeer::MEDIA_IMAGE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`media_image_id`';
        }
        if ($this->isColumnModified(TestimonialPeer::SIGNATURE)) {
            $modifiedColumns[':p' . $index++]  = '`signature`';
        }
        if ($this->isColumnModified(TestimonialPeer::MAIN_TEXT)) {
            $modifiedColumns[':p' . $index++]  = '`main_text`';
        }
        if ($this->isColumnModified(TestimonialPeer::SORT_ORDER)) {
            $modifiedColumns[':p' . $index++]  = '`sort_order`';
        }

        $sql = sprintf(
            'INSERT INTO `turnkey_testimonial` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`turnkey_testimonial_id`':
                        $stmt->bindValue($identifier, $this->turnkey_testimonial_id, PDO::PARAM_INT);
                        break;
                    case '`date_modified`':
                        $stmt->bindValue($identifier, $this->date_modified, PDO::PARAM_STR);
                        break;
                    case '`date_created`':
                        $stmt->bindValue($identifier, $this->date_created, PDO::PARAM_STR);
                        break;
                    case '`turnkey_site_id`':
                        $stmt->bindValue($identifier, $this->turnkey_site_id, PDO::PARAM_INT);
                        break;
                    case '`media_image_id`':
                        $stmt->bindValue($identifier, $this->media_image_id, PDO::PARAM_INT);
                        break;
                    case '`signature`':
                        $stmt->bindValue($identifier, $this->signature, PDO::PARAM_STR);
                        break;
                    case '`main_text`':
                        $stmt->bindValue($identifier, $this->main_text, PDO::PARAM_STR);
                        break;
                    case '`sort_order`':
                        $stmt->bindValue($identifier, $this->sort_order, PDO::PARAM_INT);
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
        $this->setTestimonialId($pk);

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

            if ($this->aSite !== null) {
                if (!$this->aSite->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aSite->getValidationFailures());
                }
            }

            if ($this->aImage !== null) {
                if (!$this->aImage->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aImage->getValidationFailures());
                }
            }


            if (($retval = TestimonialPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
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
        $pos = TestimonialPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getTestimonialId();
                break;
            case 1:
                return $this->getDateModified();
                break;
            case 2:
                return $this->getDateCreated();
                break;
            case 3:
                return $this->getSiteId();
                break;
            case 4:
                return $this->getMediaImageId();
                break;
            case 5:
                return $this->getSignature();
                break;
            case 6:
                return $this->getMainText();
                break;
            case 7:
                return $this->getSortOrder();
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
        if (isset($alreadyDumpedObjects['Testimonial'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Testimonial'][$this->getPrimaryKey()] = true;
        $keys = TestimonialPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getTestimonialId(),
            $keys[1] => $this->getDateModified(),
            $keys[2] => $this->getDateCreated(),
            $keys[3] => $this->getSiteId(),
            $keys[4] => $this->getMediaImageId(),
            $keys[5] => $this->getSignature(),
            $keys[6] => $this->getMainText(),
            $keys[7] => $this->getSortOrder(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aSite) {
                $result['Site'] = $this->aSite->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aImage) {
                $result['Image'] = $this->aImage->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = TestimonialPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setTestimonialId($value);
                break;
            case 1:
                $this->setDateModified($value);
                break;
            case 2:
                $this->setDateCreated($value);
                break;
            case 3:
                $this->setSiteId($value);
                break;
            case 4:
                $this->setMediaImageId($value);
                break;
            case 5:
                $this->setSignature($value);
                break;
            case 6:
                $this->setMainText($value);
                break;
            case 7:
                $this->setSortOrder($value);
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
        $keys = TestimonialPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setTestimonialId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setDateModified($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setDateCreated($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setSiteId($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setMediaImageId($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setSignature($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setMainText($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setSortOrder($arr[$keys[7]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(TestimonialPeer::DATABASE_NAME);

        if ($this->isColumnModified(TestimonialPeer::TURNKEY_TESTIMONIAL_ID)) $criteria->add(TestimonialPeer::TURNKEY_TESTIMONIAL_ID, $this->turnkey_testimonial_id);
        if ($this->isColumnModified(TestimonialPeer::DATE_MODIFIED)) $criteria->add(TestimonialPeer::DATE_MODIFIED, $this->date_modified);
        if ($this->isColumnModified(TestimonialPeer::DATE_CREATED)) $criteria->add(TestimonialPeer::DATE_CREATED, $this->date_created);
        if ($this->isColumnModified(TestimonialPeer::TURNKEY_SITE_ID)) $criteria->add(TestimonialPeer::TURNKEY_SITE_ID, $this->turnkey_site_id);
        if ($this->isColumnModified(TestimonialPeer::MEDIA_IMAGE_ID)) $criteria->add(TestimonialPeer::MEDIA_IMAGE_ID, $this->media_image_id);
        if ($this->isColumnModified(TestimonialPeer::SIGNATURE)) $criteria->add(TestimonialPeer::SIGNATURE, $this->signature);
        if ($this->isColumnModified(TestimonialPeer::MAIN_TEXT)) $criteria->add(TestimonialPeer::MAIN_TEXT, $this->main_text);
        if ($this->isColumnModified(TestimonialPeer::SORT_ORDER)) $criteria->add(TestimonialPeer::SORT_ORDER, $this->sort_order);

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
        $criteria = new Criteria(TestimonialPeer::DATABASE_NAME);
        $criteria->add(TestimonialPeer::TURNKEY_TESTIMONIAL_ID, $this->turnkey_testimonial_id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getTestimonialId();
    }

    /**
     * Generic method to set the primary key (turnkey_testimonial_id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setTestimonialId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getTestimonialId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Testimonial (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setDateModified($this->getDateModified());
        $copyObj->setDateCreated($this->getDateCreated());
        $copyObj->setSiteId($this->getSiteId());
        $copyObj->setMediaImageId($this->getMediaImageId());
        $copyObj->setSignature($this->getSignature());
        $copyObj->setMainText($this->getMainText());
        $copyObj->setSortOrder($this->getSortOrder());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setTestimonialId(NULL); // this is a auto-increment column, so set to default value
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
     * @return Testimonial Clone of current object.
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
     * @return TestimonialPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new TestimonialPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Site object.
     *
     * @param             Site $v
     * @return Testimonial The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSite(Site $v = null)
    {
        if ($v === null) {
            $this->setSiteId(NULL);
        } else {
            $this->setSiteId($v->getSiteId());
        }

        $this->aSite = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Site object, it will not be re-added.
        if ($v !== null) {
            $v->addTestimonial($this);
        }


        return $this;
    }


    /**
     * Get the associated Site object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Site The associated Site object.
     * @throws PropelException
     */
    public function getSite(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aSite === null && ($this->turnkey_site_id !== null) && $doQuery) {
            $this->aSite = SiteQuery::create()->findPk($this->turnkey_site_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSite->addTestimonials($this);
             */
        }

        return $this->aSite;
    }

    /**
     * Declares an association between this object and a Image object.
     *
     * @param             Image $v
     * @return Testimonial The current object (for fluent API support)
     * @throws PropelException
     */
    public function setImage(Image $v = null)
    {
        if ($v === null) {
            $this->setMediaImageId(NULL);
        } else {
            $this->setMediaImageId($v->getImageId());
        }

        $this->aImage = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Image object, it will not be re-added.
        if ($v !== null) {
            $v->addTestimonial($this);
        }


        return $this;
    }


    /**
     * Get the associated Image object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Image The associated Image object.
     * @throws PropelException
     */
    public function getImage(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aImage === null && ($this->media_image_id !== null) && $doQuery) {
            $this->aImage = ImageQuery::create()->findPk($this->media_image_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aImage->addTestimonials($this);
             */
        }

        return $this->aImage;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->turnkey_testimonial_id = null;
        $this->date_modified = null;
        $this->date_created = null;
        $this->turnkey_site_id = null;
        $this->media_image_id = null;
        $this->signature = null;
        $this->main_text = null;
        $this->sort_order = null;
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
            if ($this->aSite instanceof Persistent) {
              $this->aSite->clearAllReferences($deep);
            }
            if ($this->aImage instanceof Persistent) {
              $this->aImage->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        $this->aSite = null;
        $this->aImage = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TestimonialPeer::DEFAULT_STRING_FORMAT);
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
