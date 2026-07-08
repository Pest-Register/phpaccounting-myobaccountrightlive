<?php

namespace Tests;

use Carbon\Carbon;
use PHPAccounting\MyobAccountRightLive\Message\Invoices\Requests\CreateInvoiceRequest;
use PHPUnit\Framework\TestCase;

class DateNormalizationTest extends TestCase
{
    public function testDatesKeepLocalWallTimeInRequestBody()
    {
        $request = new CreateInvoiceRequest();

        $data = [
            'Date' => Carbon::parse('2026-07-07', 'Australia/Sydney'),
            'Terms' => ['DueDate' => Carbon::parse('2026-07-14', 'Australia/Sydney')],
        ];

        $normalized = $request->normalizeDates($data);

        // json_encode(Carbon) alone would produce 2026-07-06T14:00:00Z — a day behind
        $this->assertSame('2026-07-07T00:00:00', $normalized['Date']);
        $this->assertSame('2026-07-14T00:00:00', $normalized['Terms']['DueDate']);
    }
}
