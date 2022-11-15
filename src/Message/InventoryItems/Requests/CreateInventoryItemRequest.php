<?php


namespace PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Requests;

use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Requests\Traits\InventoryItemRequestTrait;
use PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Responses\CreateInventoryItemResponse;

class CreateInventoryItemRequest extends AbstractMYOBRequest
{
    use InventoryItemRequestTrait;

    public string $model = 'InventoryItem';


    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('code');

        $this->issetParam('Number', 'code');
        $this->issetParam('Name', 'name');
        $this->issetParam('Description', 'description');
        $this->issetParam('IsInventoried', 'is_tracked');
        if($this->getStatus() !== null) {
            $this->data['IsActive'] = ($this->getStatus() === 'ACTIVE' ? true : false);
        }
        if ($this->getSalesDetails() !== null && !empty($this->getSalesDetails())) {
            $this->data = $this->parseSalesDetails($this->getSalesDetails(), $this->data);
        }
        if ($this->getBuyingDetails() !== null && !empty($this->getBuyingDetails())) {
            $this->data = $this->parseBuyingDetails($this->getBuyingDetails(), $this->data);
        }
        return $this->data;
    }


    public function getEndpoint()
    {
        $endpoint = 'Inventory/Item?returnBody=true';
        return $endpoint;
    }

    public function getHttpMethod()
    {
        return 'POST';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new CreateInventoryItemResponse($this, $data);
    }
}