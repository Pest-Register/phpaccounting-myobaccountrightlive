<?php


namespace PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Requests;


use PHPAccounting\MyobAccountRightLive\Helpers\NewEssentials\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractRequest;
use PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Responses\DeleteInventoryItemResponse;

class DeleteInventoryItemRequest extends AbstractRequest
{
    /**
     * Set AccountingID from Parameter Bag (UID generic interface)
     * @param $value
     * @return DeleteInventoryItemRequest
     */
    public function setAccountingID($value) {
        return $this->setParameter('accounting_id', $value);
    }

    /**
     * Return Accounting ID (UID)
     * @return mixed comma-delimited-string
     */
    public function getAccountingID() {
        if ($this->getParameter('accounting_id')) {
            return $this->getParameter('accounting_id');
        }
        return null;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getEndpoint()
    {
        $endpoint = 'Inventory/Item?returnBody=true';

        if ($this->getAccountingID()) {
            if ($this->getAccountingID() !== "") {
                $endpoint = BuildEndpointHelper::deleteForGUID('Inventory/Item', $this->getAccountingID());
            }
        }
        return $endpoint;
    }

    public function getHttpMethod()
    {
        return 'DELETE';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new DeleteInventoryItemResponse($this, $data);
    }
}