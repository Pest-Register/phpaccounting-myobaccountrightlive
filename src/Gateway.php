<?php

namespace PHPAccounting\MyobAccountRightLive;

use http\Message;
use Omnipay\Common\AbstractGateway;
use PHPAccounting\MyobAccountRightLive\Message\AccessFlag\Requests\GetAccessFlagRequest;
use PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests\CreateAccountRequest;
use PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests\DeleteAccountRequest;
use PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests\GetAccountRequest;
use PHPAccounting\MyobAccountRightLive\Message\Accounts\Requests\UpdateAccountRequest;
use PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\CreateContactRequest;
use PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\DeleteContactRequest;
use PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\GetContactRequest;
use PHPAccounting\MyobAccountRightLive\Message\Contacts\Requests\UpdateContactRequest;
use PHPAccounting\MyobAccountRightLive\Message\CurrentUser\Requests\GetCurrentUserRequest;
use PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Requests\CreateInventoryItemRequest;
use PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Requests\DeleteInventoryItemRequest;
use PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Requests\GetInventoryItemRequest;
use PHPAccounting\MyobAccountRightLive\Message\InventoryItems\Requests\UpdateInventoryItemRequest;
use PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\CreateInvoiceRequest;
use PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\DeleteInvoiceRequest;
use PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\GetInvoiceRequest;
use PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\UpdateInvoiceRequest;
use PHPAccounting\MyobAccountRightLive\Message\Journals\Requests\GetJournalRequest;
use PHPAccounting\MyobAccountRightLive\Message\ManualJournals\Requests\GetManualJournalRequest;
use PHPAccounting\MyobAccountRightLive\Message\Organisations\Requests\AccountRight\GetOrganisationRequest;
use PHPAccounting\MyobAccountRightLive\Message\Payments\Requests\CreatePaymentRequest;
use PHPAccounting\MyobAccountRightLive\Message\Payments\Requests\DeletePaymentRequest;
use PHPAccounting\MyobAccountRightLive\Message\Payments\Requests\GetPaymentRequest;
use PHPAccounting\MyobAccountRightLive\Message\Quotations\Requests\CreateQuotationRequest;
use PHPAccounting\MyobAccountRightLive\Message\Quotations\Requests\DeleteQuotationRequest;
use PHPAccounting\MyobAccountRightLive\Message\Quotations\Requests\GetQuotationRequest;
use PHPAccounting\MyobAccountRightLive\Message\Quotations\Requests\UpdateQuotationRequest;
use PHPAccounting\MyobAccountRightLive\Message\TaxRates\Requests\GetTaxRateRequest;
use Tests\ManualJournals\CreateManualJournalTest;

/**
 * Created by IntelliJ IDEA.
 * User: Dylan
 * Date: 13/05/2019
 * Time: 3:11 PM
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
        return $this->createRequest(GetContactRequest::class, $parameters);
    }

    public function createContact(array $parameters = []){
        return $this->createRequest(CreateContactRequest::class, $parameters);
    }

    public function updateContact(array $parameters = []) {
        return $this->createRequest(UpdateContactRequest::class, $parameters);
    }

    public function deleteContact(array $parameters = []) {
        return $this->createRequest(DeleteContactRequest::class, $parameters);
    }

    /**
     * Invoice Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getInvoice(array $parameters = []){
        return $this->createRequest(GetInvoiceRequest::class, $parameters);
    }

    public function createInvoice(array $parameters = []){
        return $this->createRequest(CreateInvoiceRequest::class, $parameters);
    }

    public function updateInvoice(array $parameters = []){
        return $this->createRequest(UpdateInvoiceRequest::class, $parameters);
    }

    public function deleteInvoice(array $parameters = []){
        return $this->createRequest(DeleteInvoiceRequest::class, $parameters);
    }


    /**
     * Quotation Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function getQuotation(array $parameters = []){
        return $this->createRequest(GetQuotationRequest::class, $parameters);
    }

    public function createQuotation(array $parameters = []){
        return $this->createRequest(CreateQuotationRequest::class, $parameters);
    }

    public function updateQuotation(array $parameters = []){
        return $this->createRequest(UpdateQuotationRequest::class, $parameters);
    }

    public function deleteQuotation(array $parameters = []){
        return $this->createRequest(DeleteQuotationRequest::class, $parameters);
    }

    /**
     * Account Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getAccount(array $parameters = []) {
        return $this->createRequest(GetAccountRequest::class, $parameters);
    }

    public function createAccount(array $parameters = []) {
        return $this->createRequest(CreateAccountRequest::class, $parameters);
    }

    public function updateAccount(array $parameters = []) {
        return $this->createRequest(UpdateAccountRequest::class, $parameters);
    }

    public function deleteAccount(array $parameters = []) {
        return $this->createRequest(DeleteAccountRequest::class, $parameters);
    }

    /**
     * Tax Rate Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getTaxRate(array $parameters = []){
        return $this->createRequest(GetTaxRateRequest::class, $parameters);
    }

    /**
     * Payment Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getPayment(array $parameters = []){
        return $this->createRequest(GetPaymentRequest::class, $parameters);
    }

    public function createPayment(array $parameters = []){
        return $this->createRequest(CreatePaymentRequest::class, $parameters);
    }

    public function deletePayment(array $parameters = []){
        return $this->createRequest(DeletePaymentRequest::class, $parameters);
    }

    /**
     * Organisation Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getOrganisation(array $parameters = []){
        return $this->createRequest(GetOrganisationRequest::class, $parameters);
    }

    /**
     * CurrentUser Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getCurrentUser(array $parameters = []){
        return $this->createRequest(GetCurrentUserRequest::class, $parameters);
    }

    /**
     * Journal Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getJournal(array $parameters = []){
        return $this->createRequest(GetJournalRequest::class, $parameters);
    }

    /**
     * Manual Journal Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getManualJournal(array $parameters = []){
        return $this->createRequest(GetManualJournalRequest::class, $parameters);
    }

    public function createManualJournal(array $parameters = []){
        return $this->createRequest(CreateManualJournalTest::class, $parameters);
    }

    /**
     * Inventory Item Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getInventoryItem(array $parameters = []){
        return $this->createRequest(GetInventoryItemRequest::class, $parameters);
    }

    public function createInventoryItem(array $parameters = []){
        return $this->createRequest(CreateInventoryItemRequest::class, $parameters);
    }

    public function updateInventoryItem(array $parameters = []){
        return $this->createRequest(UpdateInventoryItemRequest::class, $parameters);
    }

    public function deleteInventoryItem(array $parameters = []){
        return $this->createRequest(DeleteInventoryItemRequest::class, $parameters);
    }
}