<?php

namespace Tests\Unit;

use PHPAccounting\MyobAccountRightLive\Helpers\ODataQueryBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for ODataQueryBuilder.
 *
 * @group unit
 */
class ODataQueryBuilderTest extends TestCase
{
    public function testFormatValueWithGuid(): void
    {
        $result = ODataQueryBuilder::formatValue('CustomerUID', 'abc-123');
        $this->assertEquals("CustomerUID eq guid'abc-123'", $result);
    }

    public function testFormatValueWithBoolean(): void
    {
        $this->assertEquals("IsActive eq true", ODataQueryBuilder::formatValue('IsActive', true));
        $this->assertEquals("IsActive eq false", ODataQueryBuilder::formatValue('IsActive', false));
    }

    public function testFormatValueWithString(): void
    {
        $result = ODataQueryBuilder::formatValue('Name', 'Test Company');
        $this->assertEquals("Name eq 'Test+Company'", $result);
    }

    public function testFormatValueWithFieldPrefix(): void
    {
        $result = ODataQueryBuilder::formatValue('Name', 'Test', 'x/');
        $this->assertEquals("x/Name eq 'Test'", $result);
    }

    public function testBuildFilterConditionsWithAndLogic(): void
    {
        $params = ['Name' => 'Test', 'IsActive' => true];
        $result = ODataQueryBuilder::buildFilterConditions($params, true);

        $this->assertStringContainsString("Name eq 'Test'", $result);
        $this->assertStringContainsString("IsActive eq true", $result);
        $this->assertStringContainsString(' and ', $result);
    }

    public function testBuildFilterConditionsWithOrLogic(): void
    {
        $params = ['Type' => 'Income', 'Type2' => 'Expense'];
        $result = ODataQueryBuilder::buildFilterConditions($params, false);

        $this->assertStringContainsString(' or ', $result);
    }

    public function testPaginate(): void
    {
        $result = ODataQueryBuilder::paginate('Contact/Customer', 100, 50, 'Name');

        $this->assertStringContainsString('Contact/Customer', $result);
        $this->assertStringContainsString('top=100', $result);
        $this->assertStringContainsString('skip=50', $result);
        $this->assertStringContainsString('orderby=Name', $result);
    }

    public function testPaginateWithDefaults(): void
    {
        $result = ODataQueryBuilder::paginate('GeneralLedger/Account', 1000);

        $this->assertStringContainsString('top=1000', $result);
        $this->assertStringContainsString('skip=0', $result);
        $this->assertStringContainsString('orderby=UID', $result);
    }

    public function testFilterByGuid(): void
    {
        $result = ODataQueryBuilder::filterByGuid('GeneralLedger/Account', 'abc-123-def');

        $this->assertStringContainsString("filter=UID eq guid'abc-123-def'", $result);
    }

    public function testFilterByGuidWithPrefix(): void
    {
        $result = ODataQueryBuilder::filterByGuid('Sale/Invoice', 'abc-123', 'Customer/');

        $this->assertStringContainsString("filter=Customer/UID eq guid'abc-123'", $result);
    }

    public function testResourceByGuid(): void
    {
        $result = ODataQueryBuilder::resourceByGuid('Contact/Customer', 'abc-123');
        $this->assertEquals('Contact/Customer/abc-123?returnBody=true', $result);
    }

    public function testResourceByGuidWithoutReturnBody(): void
    {
        $result = ODataQueryBuilder::resourceByGuid('Contact/Customer', 'abc-123', false);
        $this->assertEquals('Contact/Customer/abc-123', $result);
    }

    public function testAppendContactType(): void
    {
        $this->assertEquals('Contact/Customer', ODataQueryBuilder::appendContactType('Contact/', 'Customer'));
        $this->assertEquals('Contact/Supplier', ODataQueryBuilder::appendContactType('Contact/', 'Supplier'));
        $this->assertEquals('Contact/Employee', ODataQueryBuilder::appendContactType('Contact/', 'Employee'));
    }

    public function testAppendContactTypeDefaultsToCustomer(): void
    {
        $result = ODataQueryBuilder::appendContactType('Contact/', 'InvalidType');
        $this->assertEquals('Contact/Customer', $result);
    }

    public function testSearchWithSimpleParams(): void
    {
        $result = ODataQueryBuilder::search(
            'GeneralLedger/Account',
            ['Type' => 'Income'],
            true,
            null,
            false,
            1000,
            0,
            'UID'
        );

        $this->assertStringContainsString('top=1000', $result);
        $this->assertStringContainsString('skip=0', $result);
        $this->assertStringContainsString("Type eq 'Income'", $result);
    }

    public function testSearchWithFilterParams(): void
    {
        $result = ODataQueryBuilder::search(
            'Contact/Customer',
            ['IsActive' => true],
            true,
            ['Type' => 'Customer'],
            false,
            100,
            0,
            'Name'
        );

        $this->assertStringContainsString('IsActive eq true', $result);
        $this->assertStringContainsString("Type eq 'Customer'", $result);
    }
}
