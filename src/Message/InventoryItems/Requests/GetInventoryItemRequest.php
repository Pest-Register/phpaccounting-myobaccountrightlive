<?php
namespace PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Requests;

use PHPAccounting\MyobAccountRightLive\Helpers\Current\BuildEndpointHelper;
use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBRequest;
use PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Responses\GetInventoryItemResponse;
use PHPAccounting\MyobAccountRightLive\Traits\GetRequestTrait;

/**
 * Get InventoryItem(s)
 * @package PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Requests\NewEssentials
 */
class GetInventoryItemRequest extends AbstractMYOBRequest
{
    use GetRequestTrait;

    public string $model = 'InventoryItem';


    public function getEndpoint()
    {

        $endpoint = 'Inventory/Item/';

        if ($this->getAccountingID()) {
            if ($this->getAccountingID() !== "") {
                $endpoint = BuildEndpointHelper::loadByGUID($endpoint, $this->getAccountingID());
            }
        } else {
            if($this->getSearchParams() || $this->getSearchFilters())
            {
                $endpoint = BuildEndpointHelper::search(
                    $endpoint,
                    $this->getSearchParams(),
                    $this->getExactSearchValue(),
                    $this->getSearchFilters(),
                    $this->getMatchAllFilters(),
                    'substringof',
                    $this->getPage(),
                    $this->getSkip(),
                    modifiedSince: $this->getLastModifiedSince()
                );
            }
            else if ($this->getPage()) {
                if ($this->getPage() !== "") {
                    $endpoint = BuildEndpointHelper::paginate(
                        $endpoint,
                        $this->getPage(),
                        $this->getSkip(),
                        modifiedSince: $this->getLastModifiedSince()
                    );
                }
            }
        }
        return $endpoint;
    }

    public function getHttpMethod()
    {
        return 'GET';
    }

    protected function createResponse($data, $headers = [], ?int $statusCode = null)
    {
        return $this->response = new GetInventoryItemResponse($this, $data, $headers, $statusCode);
    }

}