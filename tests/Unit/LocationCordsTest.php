<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Location;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LocationCordsTest extends TestCase
{
    /**
     * Test of geocoding with given city
     *
     * @return void
     */
    /** @test */
    public function locationFromAddressTest()
    {
        $location = new Location;
        $location->city = 'Wroclaw';
        $cords = $location->getCoordinatesFromAddress();
        $this->assertNotNull($cords);
        $this->assertEquals( 17.0326689, $cords['lng']);
        $this->assertEquals(51.1089776, $cords['lat']);
    }
}