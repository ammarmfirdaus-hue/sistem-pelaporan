<?php

namespace Tests\Unit;

use App\Models\Child;
use Carbon\Carbon;
use Tests\TestCase;

class ChildAgeDisplayTest extends TestCase
{
    public function test_child_age_display_logic(): void
    {
        Carbon::setTestNow('2026-05-21');

        // Test case 1: 20 days old (months == 0, days > 0)
        $child1 = new Child(['tanggal_lahir' => Carbon::parse('2026-05-01')]);
        $this->assertEquals('20 Hari', $child1->age_display);

        // Test case 2: 1 month old (months > 0, days == 0)
        $child2 = new Child(['tanggal_lahir' => Carbon::parse('2026-04-21')]);
        $this->assertEquals('1 Bulan', $child2->age_display);

        // Test case 3: 2 months 5 days old (months > 0, days > 0)
        $child3 = new Child(['tanggal_lahir' => Carbon::parse('2026-03-16')]);
        $this->assertEquals('2 Bulan 5 Hari', $child3->age_display);

        // Test case 4: 14 months 12 days old
        $child4 = new Child(['tanggal_lahir' => Carbon::parse('2025-03-09')]);
        $this->assertEquals('14 Bulan 12 Hari', $child4->age_display);

        // Clean up setTestNow
        Carbon::setTestNow();
    }
}
