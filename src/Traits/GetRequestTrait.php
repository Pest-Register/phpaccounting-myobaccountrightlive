<?php

namespace PHPAccounting\MyobAccountRightLive\Traits;

trait GetRequestTrait
{

    /**
     * Return Accounting IDs (UID)
     * @return mixed comma-delimited-string
     */
    public function getAccountingID() {
        if ($this->getParameter('accounting_id')) {
            return $this->getParameter('accounting_id');
        }
        return null;
    }

    /**
     * Set AccountingID from Parameter Bag (UID generic interface)
     * @param $value
     */
    public function setAccountingID($value) {
        return $this->setParameter('accounting_id', $value);
    }

    /**
     * Set Page Value for Pagination from Parameter Bag
     * @param $value
     */
    public function setPage($value) {
        return $this->setParameter('page', $value);
    }


    /**
     * Return Page Value for Pagination
     * @return integer
     */
    public function getPage() {
        if ($this->getParameter('page')) {
            return $this->getParameter('page');
        }

        return 1000;
    }

    /**
     * Set Page Value for Pagination from Parameter Bag
     * @param $value
     */
    public function setSkip($value) {
        return $this->setParameter('skip', $value);
    }

    /**
     * Return Page Value for Pagination
     * @return integer
     */
    public function getSkip() {
        if ($this->getParameter('skip')) {
            return $this->getParameter('skip');
        }

        return 0;
    }

    /**
     * Set SearchParams from Parameter Bag (interface for query-based searching)
     * @see https://www.odata.org/documentation/odata-version-3-0/odata-version-3-0-core-protocol/
     * @param $value
     */
    public function setSearchParams($value) {
        return $this->setParameter('search_params', $value);
    }
    /**
     * Return Search Parameters for query-based searching
     * @return integer
     */
    public function getSearchParams() {
        return $this->getParameter('search_params');
    }

    /**
     * Set boolean to determine partial or exact query based searches
     * @param $value
     */
    public function setExactSearchValue($value) {
        return $this->setParameter('exact_search_value', $value);
    }

    /**
     * Get boolean to determine partial or exact query based searches
     * @return mixed
     */
    public function getExactSearchValue() {
        return $this->getParameter('exact_search_value');
    }

    /**
     * Set SearchFilters from Parameter Bag (interface for query-based searching)
     * @see https://www.odata.org/documentation/odata-version-3-0/odata-version-3-0-core-protocol/
     * @param $value
     */
    public function setSearchFilters($value) {
        return $this->setParameter('search_filters', $value);
    }

    /**
     * Return Search Filters for query-based searching
     * @return array
     */
    public function getSearchFilters() {
        return $this->getParameter('search_filters');
    }

    /**
     * Set boolean to determine whether all filters need to be matched
     * @param $value
     */
    public function setMatchAllFilters($value) {
        return $this->setParameter('match_all_filters', $value);
    }

    /**
     * Get boolean to determine whether all filters need to be matched
     * @return mixed
     */
    public function getMatchAllFilters() {
        return $this->getParameter('match_all_filters');
    }

    /**
     * Set the LastModified cutoff for delta/incremental sync. Subsequent
     * GET-list requests will only return records whose LastModified is at or
     * after this value, via OData's `$filter=LastModified ge datetime'...'`
     * clause. Accepts a DateTimeInterface or a string already formatted in
     * MYOB's expected `Y-m-d\TH:i:s` shape.
     *
     * @param \DateTimeInterface|string|null $value
     */
    public function setLastModifiedSince($value) {
        return $this->setParameter('last_modified_since', $value);
    }

    /**
     * Get the LastModified cutoff as a MYOB-formatted ISO datetime string.
     * Returns null when not set.
     */
    public function getLastModifiedSince(): ?string {
        $value = $this->getParameter('last_modified_since');
        if ($value === null || $value === '') {
            return null;
        }
        if ($value instanceof \DateTimeInterface) {
            return $value->format('Y-m-d\TH:i:s');
        }
        return (string) $value;
    }
}