<?php

class DataTableColumn extends \Yajra\DataTables\Html\Column {
    protected $filterFunc = null;
    protected $serverRenderFunc = null;
    protected $serverRenderRaw = false;
    protected $isVirtualColumn = false;

    //public static function noop() { return; }

    /**
     * @param array $attributes
     * @return DataTableColumn
     */
    public static function create($attributes = []) {
        return new self($attributes);
    }

    public static function createVirtual($attributes = []) {
        return (static::create($attributes))
            ->setVirtualColumn();
    }

    /**
     * @param callable $function
     * @return $this
     */
    function setFilter(callable $function) {
        $this->filterFunc = $function;

        return $this;
    }

    /**
     * @return $this
     */
    function disableFilter() {
        $this->filterFunc = function() {};

        return $this;
    }

    /**
     * @return null|callable
     */
    function getFilter() {
        return $this->filterFunc;
    }

    /**
     * @param callable $function
     * @param bool $isRaw
     * @return $this
     */
    function setServerRender(callable $function, $isRaw = false) {
        $this->serverRenderFunc = $function;
        $this->setRenderRaw($isRaw);

        return $this;
    }

    /**
     * @return null|callable
     */
    function getServerRender() {
        return $this->serverRenderFunc;
    }


    /**
     * @param bool $to
     * @return $this
     */
    function setRenderRaw(bool $to) {
        $this->serverRenderRaw = $to;

        return $this;
    }

    /**
     * @return $this
     */
    function disableRaw() {
        $this->serverRenderRaw = false;

        return $this;
    }

    /**
     * @return bool
     */
    function isRaw() {
        return $this->serverRenderRaw;
    }

    /**
     * @param bool $to
     * @return $this
     */
    function setVirtualColumn(bool $to = true) {
        $this->isVirtualColumn = $to;

        return $this;
    }

    /**
     * @return bool
     */
    function isVirtualColumn() {
        return $this->isVirtualColumn;
    }
}