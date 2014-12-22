<?php

namespace Chayka\WIXTest;

use Chayka\Helpers\DateHelper;
use Chayka\Helpers\Util;
use Chayka\WP\Helpers\DbHelper;
use Chayka\WP\Models\ReadyModel;
use DateTime;

class TreeNodeModel extends ReadyModel{

    protected $parentId;

    protected $title;

    protected $dtCreated;

    protected $children = [];

    function __construct() {
        $this->title = '';
        $this->dtCreated = new DateTime();
    }

    /**
     * Get db table name for the instance storage.
     *
     * @return string
     */
    public static function getDbTable() {
        return DbHelper::dbTable('tree_nodes');
    }

    /**
     * Get id column name in db table
     *
     * @return mixed
     */
    public static function getDbIdColumn() {
        return 'node_id';
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    /**
     * @return int
     */
    public function getParentId() {
        return $this->parentId;
    }

    /**
     * @param int $parentId
     */
    public function setParentId($parentId) {
        $this->parentId = $parentId;
    }



    /**
     * @return \DateTime
     */
    public function getDtCreated() {
        return $this->dtCreated;
    }

    /**
     * @param \DateTime $dtCreated
     * @return $this
     */
    public function setDtCreated($dtCreated) {
        $this->dtCreated = $dtCreated;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getChildren() {
        return $this->children;
    }

    /**
     * @param mixed $children
     */
    public function setChildren($children) {
        $this->children = $children;
    }

    public function addChild($child){
        $this->children[] = $child;
    }

    public function loadChildren(){
        return $this->children = self::selectBy('parent_id', $this->getId(), true);
    }

    /**
     * Unpacks db result object into this instance
     *
     * @param array|object $dbRecord
     * @return self
     */
    public static function unpackDbRecord($dbRecord) {
        $obj = new self();

        $obj->setId(Util::getItem($dbRecord, 'node_id', 0));
        $obj->setTitle(Util::getItem($dbRecord, 'title', ''));
        $obj->setParentId(Util::getItem($dbRecord, 'parent_id', 0));
        $dtCreated = Util::getItem($dbRecord, 'dt_created', '');
        $obj->setDtCreated($dtCreated ? DateHelper::dbStrToDatetime($dtCreated) : new DateTime());

        return $obj;
    }

    /**
     * Packs this instance for db insert/update
     *
     * @param bool $forUpdate
     * @return array
     */
    public function packDbRecord($forUpdate = false) {
        $dbRecord = array(
            'node_id' => $this->getId(),
            'parent_id' => $this->getParentId(),
            'title' => $this->getTitle(),
            'dt_created' => $this->dtCreated ? DateHelper::datetimeToDbStr($this->dtCreated) : null,
        );

        return $dbRecord;
    }

    /**
     * Returns assoc array to be packed into json payload
     *
     * @return array($key=>$value);
     */
    public function packJsonItem() {
        $json = array(
            'node_id' => $this->getId(),
            'parent_id' => $this->getParentId(),
            'title' => $this->getTitle(),
            'dt_created' => $this->dtCreated ? DateHelper::datetimeToJsonStr($this->dtCreated) : null,
        );

        return $json;
    }
}