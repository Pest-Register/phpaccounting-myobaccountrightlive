<?php
namespace PHPAccounting\MyobAccountRightLive\Message\CurrentUser\Responses;

use PHPAccounting\MyobAccountRightLive\Message\AbstractMYOBResponse;

/**
 * Get Contact(s) Response
 * @package PHPAccounting\MyobAccountRightLive\Message\Contacts\Responses\AccountRight
 */
class GetCurrentUserResponse extends AbstractMYOBResponse
{

    /**
     * Return all Contacts with Generic Schema Variable Assignment
     * @return array
     */
    public function getCurrentUser(){
        return $this->data;
    }
}