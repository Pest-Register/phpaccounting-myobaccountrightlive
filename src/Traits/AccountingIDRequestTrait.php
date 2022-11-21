<?php

namespace PHPAccounting\MyobAccountRightLive\Traits;

trait AccountingIDRequestTrait
{
    /**
     * Set AccountingID from Parameter Bag
     * @param $value
     */
    public function setAccountingID($value) {
        return $this->setParameter('accounting_id', $value);
    }

    /**
     * Get AccountingID from Parameter Bag
     * @return mixed
     */
    public function getAccountingID() {
        return  $this->getParameter('accounting_id');
    }
}