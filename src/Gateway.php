<?php

namespace PHPAccounting\MyobAccountRightLive;

use http\Message;
use Omnipay\Common\AbstractGateway;
use PHPAccounting\MyobAccountRightLive\Message\AccessFlag\Requests\GetAccessFlagRequest;
use PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests\AccountRight\GetAccountRequest;
use PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\GetContactRequest;
use PHPAccounting\MyobAccountRightLive\Message\CurrentUser\Requests\AccountRight\GetCurrentUserRequest;

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
     * Country Code getters and setters
     * @return mixed
     */

    public function getCountryCode()
    {
        return $this->getParameter('countryCode');
    }

    public function setCountryCode($value)
    {
        return $this->setParameter('countryCode', $value);
    }

    /**
     * Business ID getters and setters
     * @return mixed
     */

    public function getBusinessID()
    {
        return $this->getParameter('businessID');
    }

    public function setBusinessID($value)
    {
        return $this->setParameter('businessID', 'businesses/' .$value);
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

    public function getProduct() {
        return $this->getParameter('product');
    }

    public function setProduct($value) {
        return $this->setParameter('product', $value);
    }



    /**
     * Customer Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getContact(array $parameters = []){
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($this->getProduct() == 'old_essentials') {
            $class = \PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\Essentials\GetContactRequest::class;
        }
        elseif ($accessFlag == 2 || $accessFlag == 3) {
            $class = \PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\NewEssentials\GetContactRequest::class;
        }
        return $this->createRequest($class, $parameters);
    }

    public function createContact(array $parameters = []){
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($this->getProduct() == 'old_essentials') {
            $class = \PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\Essentials\CreateContactRequest::class;
        }
        elseif ($accessFlag == 2 || $accessFlag == 3) {
            $class = \PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\NewEssentials\CreateContactRequest::class;
        }
        return $this->createRequest($class, $parameters);
    }

    public function updateContact(array $parameters = []) {
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($this->getProduct() == 'old_essentials') {
            $class = \PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\Essentials\UpdateContactRequest::class;
        }
        elseif ($accessFlag == 2 || $accessFlag == 3) {
            $class =\PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\NewEssentials\UpdateContactRequest::class;
        }
        return $this->createRequest($class, $parameters);
    }

    public function deleteContact(array $parameters = []) {
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($this->getProduct() == 'old_essentials') {
            $class = \PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\Essentials\DeleteContactRequest::class;
        }
        elseif ($accessFlag == 2 || $accessFlag == 3) {
            $class =\PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\NewEssentials\DeleteContactRequest::class;
        }
        return $this->createRequest($class, $parameters);
    }

    /**
     * Invoice Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getInvoice(array $parameters = []){
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($this->getProduct() == 'old_essentials') {
            $class = \PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\Essentials\GetInvoiceRequest::class;
        }
        if ($accessFlag == 2 || $accessFlag == 3) {
            // New Essentials and AccountRight
            $class = \PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\NewEssentials\GetInvoiceRequest::class;
        }
        return $this->createRequest($class, $parameters);
    }

    public function createInvoice(array $parameters = []){
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($this->getProduct() == 'old_essentials') {
            $class = \PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\Essentials\CreateInvoiceRequest::class;
        }
        if ($accessFlag == 2 || $accessFlag == 3) {
            // New Essentials and AccountRight
            $class = \PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\NewEssentials\CreateInvoiceRequest::class;
        }
        return $this->createRequest($class, $parameters);
    }

    public function updateInvoice(array $parameters = []){
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($this->getProduct() == 'old_essentials') {
            $class = \PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\Essentials\UpdateInvoiceRequest::class;
        }
        if ($accessFlag == 2 || $accessFlag == 3) {
            // New Essentials and AccountRight
            $class = \PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\NewEssentials\UpdateInvoiceRequest::class;
        }
        return $this->createRequest($class, $parameters);
    }

    public function deleteInvoice(array $parameters = []){
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($this->getProduct() == 'old_essentials') {
            $class = \PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\Essentials\DeleteInvoiceRequest::class;
        }
        if ($accessFlag == 2 || $accessFlag == 3) {
            // New Essentials and AccountRight
            $class = \PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\NewEssentials\DeleteInvoiceRequest::class;
        }
        return $this->createRequest($class, $parameters);
    }

    /**
     * Account Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getAccount(array $parameters = []) {
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($this->getProduct() == 'old_essentials') {
            $class = \PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests\Essentials\GetAccountRequest::class;
        }
        elseif ($accessFlag == 2 || $accessFlag == 3) {
            $class =\PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests\NewEssentials\GetAccountRequest::class;
        }
        return $this->createRequest($class, $parameters);
    }

    public function createAccount(array $parameters = []) {
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($this->getProduct() == 'old_essentials') {
            $class = \PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests\Essentials\CreateAccountRequest::class;
        }
        elseif ($accessFlag == 2 || $accessFlag == 3) {
            $class =\PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests\NewEssentials\CreateAccountRequest::class;
        }
        return $this->createRequest($class, $parameters);
    }

    public function updateAccount(array $parameters = []) {
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($this->getProduct() == 'old_essentials') {
            $class = \PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests\Essentials\UpdateAccountRequest::class;
        }
        elseif ($accessFlag == 2 || $accessFlag == 3) {
            $class =\PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests\NewEssentials\UpdateAccountRequest::class;
        }
        return $this->createRequest($class, $parameters);
    }

    public function deleteAccount(array $parameters = []) {
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($this->getProduct() == 'old_essentials') {
            return;
        }
        elseif ($accessFlag == 2 || $accessFlag == 3) {
            $class =\PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests\NewEssentials\DeleteAccountRequest::class;
        }
        return $this->createRequest($class, $parameters);
    }

    /**
     * Tax Rate Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getTaxRate(array $parameters = []){
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($this->getProduct() == 'old_essentials') {
            $class = \PHPAccounting\MyobAccountRightLive\Message\TaxRates\Requests\Essentials\GetTaxRateRequest::class;
        }
        if ($accessFlag == 2 || $accessFlag == 3) {
            // New Essentials and AccountRight
            $class = \PHPAccounting\MyobAccountRightLive\Message\TaxRates\Requests\NewEssentials\GetTaxRateRequest::class;
        }
        return $this->createRequest($class, $parameters);
    }

    /**
     * Payment Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getPayment(array $parameters = []){
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($this->getProduct() == 'old_essentials') {
            return;
        }
        elseif ($accessFlag == 2 || $accessFlag == 3) {
            // New Essentials and AccountRight
            $class = \PHPAccounting\MyobAccountRightLive\Message\Payments\Requests\NewEssentials\GetPaymentRequest::class;
        }
        return $this->createRequest($class, $parameters);
    }

    public function createPayment(array $parameters = []){
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($this->getProduct() == 'old_essentials') {
            $class = \PHPAccounting\MyobAccountRightLive\Message\Payments\Requests\Essentials\CreatePaymentRequest::class;
        }
        elseif ($accessFlag == 2 || $accessFlag == 3) {
            // New Essentials and AccountRight
            $class = \PHPAccounting\MyobAccountRightLive\Message\Payments\Requests\NewEssentials\CreatePaymentRequest::class;
        }
        return $this->createRequest($class, $parameters);
    }

    public function deletePayment(array $parameters = []){
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($this->getProduct() == 'old_essentials') {
            return;
        }
        if ($accessFlag == 2 || $accessFlag == 3) {
            // New Essentials and AccountRight
            $class = \PHPAccounting\MyobAccountRightLive\Message\Payments\Requests\NewEssentials\DeletePaymentRequest::class;
        }
        return $this->createRequest($class, $parameters);
    }

    /**
     * Organisation Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getOrganisation(array $parameters = []){
        $class = \PHPAccounting\MyobAccountRightLive\Message\Organisations\Requests\AccountRight\GetOrganisationRequest::class;
        return $this->createRequest($class, $parameters);
    }

    /**
     * CurrentUser Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getCurrentUser(array $parameters = []){
        $class = \PHPAccounting\MyobAccountRightLive\Message\CurrentUser\Requests\AccountRight\GetCurrentUserRequest::class;

        return $this->createRequest($class, $parameters);
    }

    /**
     * Journal Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getJournal(array $parameters = []){
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($this->getProduct() == 'old_essentials') {
            $class = \PHPAccounting\MyobAccountRightLive\Message\Journals\Requests\Essentials\GetJournalRequest::class;
        }
        elseif ($accessFlag == 2 || $accessFlag == 3) {
            // New Essentials and AccountRight
            $class = \PHPAccounting\MyobAccountRightLive\Message\Journals\Requests\NewEssentials\GetJournalRequest::class;
        }
        return $this->createRequest($class, $parameters);
    }

    /**
     * Manual Journal Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getManualJournal(array $parameters = []){
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($this->getProduct() == 'old_essentials') {
            return;
        }
        if ($accessFlag == 2 || $accessFlag == 3) {
            // New Essentials and AccountRight
            $class = \PHPAccounting\MyobAccountRightLive\Message\Journals\Requests\NewEssentials\GetJournalRequest::class;
        }
        return $this->createRequest($class, $parameters);
    }

    public function createManualJournal(array $parameters = []){
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($this->getProduct() == 'old_essentials') {
            return;
        }
        if ($accessFlag == 2 || $accessFlag == 3) {
            return;
        }
        return $this->createRequest($class, $parameters);
    }

    /**
     * Inventory Item Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getInventoryItem(array $parameters = []){
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($this->getProduct() == 'old_essentials') {
            $class = \PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Requests\Essentials\GetInventoryItemRequest::class;
        }
        elseif ($accessFlag == 2 || $accessFlag == 3) {
            // New Essentials and AccountRight
            $class = \PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Requests\NewEssentials\GetInventoryItemRequest::class;
        }
        return $this->createRequest($class, $parameters);
    }

    public function createInventoryItem(array $parameters = []){
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($this->getProduct() == 'old_essentials') {
            $class = \PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Requests\Essentials\CreateInventoryItemRequest::class;
        }
        elseif ($accessFlag == 2 || $accessFlag == 3) {
            // New Essentials and AccountRight
            $class = \PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Requests\NewEssentials\CreateInventoryItemRequest::class;
        }
        return $this->createRequest($class, $parameters);
    }

    public function updateInventoryItem(array $parameters = []){
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($this->getProduct() == 'old_essentials') {
            $class = \PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Requests\Essentials\UpdateInventoryItemRequest::class;
        }
        elseif ($accessFlag == 2 || $accessFlag == 3) {
            // New Essentials and AccountRight
            $class = \PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Requests\NewEssentials\UpdateInventoryItemRequest::class;
        }
        return $this->createRequest($class, $parameters);
    }

    public function deleteInventoryItem(array $parameters = []){
        $accessFlag = $this->getAccessFlag();
        $class = '';
        if ($this->getProduct() == 'old_essentials') {
            return;
        }
        elseif ($accessFlag == 2 || $accessFlag == 3) {
            // New Essentials and AccountRight
            $class = \PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Requests\NewEssentials\DeleteInventoryItemRequest::class;
        }
        return $this->createRequest($class, $parameters);
    }
}