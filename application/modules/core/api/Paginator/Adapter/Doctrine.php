<?php

/**
 * Core_Api_Paginator_Adapter_Doctrine
 *
 * A Zend_Paginator_Adapter for use with a Doctrine_Query.
 */
class Core_Api_Paginator_Adapter_Doctrine implements Zend_Paginator_Adapter_Interface
{
    /**
     * Constructor.
     *
     * Creates the adapter from a query.
     *
     * @var Doctrine_Query $query
     */
    public function __construct(Doctrine_Query $query)
    {
        $this->_query = $query;
    }

    /**
     * Return the total number of records from the query.
     *
     * @return integer
     * @todo   This needs to be improved.
     */
    public function count()
    {
        $result = clone $this->_query;
        $result = $result->select('COUNT(1) count')->fetchOne();

        if ($result) {
            $result = $result->toArray();

            return $result['count'];
        } else {
            return 1;
        }
    }

    /**
     * Retrieve the items for a specified offset.
     *
     * The offset and itemCountPerPage variables are used
     * to determine the page number when constructing the
     * Doctrine_Pager.
     *
     * @param  integer $offset     The offset in the query.
     * @param  integer $maxPerPage The number of items per page.
     * @return Doctrine_Collection
     */
    public function getItems($offset, $maxPerPage)
    {
        $result = new Doctrine_Pager($this->_query, 1 + $offset / $maxPerPage, $maxPerPage);

        return $result->execute();
    }
}
