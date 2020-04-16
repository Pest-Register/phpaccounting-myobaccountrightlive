<?php

namespace PHPAccounting\MyobAccountRightLive;

use Omnipay\Common\AbstractGateway;
use PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\GetContactRequest;

/**
 * Created by IntelliJ IDEA.
 * User: Dylan
 * Date: 13/05/2019
 * Time: 3:11 PM
 * @method \PhpAccounting\Common\Message\NotificationInterface acceptNotification(array $options = array())
 * @method \PhpAccounting\Common\Message\RequestInterface authorize(array $options = array())
 * @method \PhpAccounting\Common\Message\RequestInterface completeAuthorize(array $options = array())
 * @method \PhpAccounting\Common\Message\RequestInterface capture(array $options = array())
 * @method \PhpAccounting\Common\Message\RequestInterface purchase(array $options = array())
 * @method \PhpAccounting\Common\Message\RequestInterface completePurchase(array $options = array())
 * @method \PhpAccounting\Common\Message\RequestInterface refund(array $options = array())
 * @method \PhpAccounting\Common\Message\RequestInterface fetchTransaction(array $options = [])
 * @method \PhpAccounting\Common\Message\RequestInterface void(array $options = array())
 * @method \PhpAccounting\Common\Message\RequestInterface createCard(array $options = array())
 * @method \PhpAccounting\Common\Message\RequestInterface updateCard(array $options = array())
 * @method \PhpAccounting\Common\Message\RequestInterface deleteCard(array $options = array())
 */

class Gateway extends AbstractGateway
{

    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     * @return string
     */
    public function getName()
    {
        return 'Myob';
    }

    /**
     * Access Token getters and setters
     * @return mixed
     */

    public function getAccessToken()
    {
        return $this->getParameter('accessToken');
    }

    public function setAccessToken($value)
    {
        return $this->setParameter('accessToken', $value);
    }

    /**
     * API Key getters and setters
     * @return mixed
     */

    public function getAPIKey()
    {
        return $this->getParameter('APIKey');
    }

    public function setAPIKey($value)
    {
        return $this->setParameter('APIKey', $value);
    }


    public function setCompanyFile($value)
    {
        return $this->setParameter('companyFile', $value);
    }

    public function getCompanyFile() {
        return $this->getParameter('companyFile');
    }

    public function setCompanyEndpoint($value)
    {
        return $this->setParameter('companyEndpoint', $value);
    }

    public function getCompanyEndpoint() {
        return $this->getParameter('companyEndpoint');
    }

    public function setAccessFlag($value) {
        return $this->setParameter('accessFlag', $value);
    }
    public function getAccessFlag() {
        return $this->getParameter('accessFlag');
    }


    /**
     * Customer Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    /**
     * Get One or Multiple Contacts
     * @param array $parameters
     * @bodyParam array $parameters
     * @bodyParam parameters.page int optional Page Index for Pagination
     * @bodyParam parameters.accountingIDs array optional Array of GUIDs for Contact Retrieval / Filtration
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function getContact(array $parameters = []){
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($accessFlag == 'Online AccountRight') {
            $class = Message\Contacts\Requests\AccountRight\GetContactRequest::class;
        }
        if ($accessFlag == 'Essentials') {
            $class = Message\Contacts\Requests\Essentials\GetContactRequest::class;
        }
        if ($accessFlag == 'Essentials (New)') {
            $class = Message\Contacts\Requests\NewEssentials\GetContactRequest::class;
        }
        return $this->createRequest($class, $parameters);
    }

    /**
     * Invoice Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getInvoice(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\GetInvoiceRequest', $parameters);
    }

    /**
     * Account Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getAccount(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests\GetAccountRequest', $parameters);
    }

    /**
     * Tax Rate Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getTaxRate(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobAccountRightLive\Message\TaxRates\Requests\GetTaxRateRequest', $parameters);
    }

    /**
     * Payment Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getPayment(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobAccountRightLive\Message\Payments\Requests\GetPaymentRequest', $parameters);
    }

    /**
     * Organisation Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getOrganisation(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobAccountRightLive\Message\Organisations\Requests\GetOrganisationRequest', $parameters);
    }

    /**
     * CurrentUser Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getCurrentUser(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobAccountRightLive\Message\CurrentUser\Requests\GetCurrentUserRequest', $parameters);
    }

    /**
     * Journal Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getJournal(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobAccountRightLive\Message\Journals\Requests\GetJournalRequest', $parameters);
    }

    /**
     * Manual Journal Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getManualJournal(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobAccountRightLive\Message\ManualJournals\Requests\GetManualJournalRequest', $parameters);
    }

    /**
     * Inventory Item Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getInventoryItem(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Requests\GetInventoryItemRequest', $parameters);
    }
}