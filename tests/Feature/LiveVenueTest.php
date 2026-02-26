<?php

namespace Tests\Feature;

use App\Models\LiveVenue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LiveVenueTest extends TestCase
{
    use RefreshDatabase;

    public function test_live_venue_can_be_created(): void
    {
        $venue = LiveVenue::factory()->create([
            'name' => 'さいたまスーパーアリーナ',
            'prefecture' => '埼玉県',
            'capacity' => 37000,
            'nearest_station' => 'さいたま新都心駅',
            'access' => '徒歩約3分',
            'google_maps_url' => 'https://www.google.com/maps/search/?api=1&query=さいたまスーパーアリーナ',
            'toilet_layout' => [
                'female_locations' => '計18箇所',
                'male_locations' => '計14箇所',
                'accessible_locations' => '各階複数箇所',
            ],
        ]);

        $this->assertDatabaseHas('live_venues', [
            'name' => 'さいたまスーパーアリーナ',
            'prefecture' => '埼玉県',
            'capacity' => 37000,
        ]);

        $this->assertEquals('埼玉県', $venue->prefecture);
        $this->assertEquals(37000, $venue->capacity);
    }

    public function test_toilet_layout_is_cast_to_array(): void
    {
        $venue = LiveVenue::factory()->create([
            'toilet_layout' => [
                'female_locations' => '計18箇所',
                'male_locations' => '計14箇所',
            ],
        ]);

        $this->assertIsArray($venue->toilet_layout);
        $this->assertEquals('計18箇所', $venue->toilet_layout['female_locations']);
        $this->assertEquals('計14箇所', $venue->toilet_layout['male_locations']);
    }

    public function test_live_venue_seeder_inserts_all_venues(): void
    {
        $this->seed(\Database\Seeders\LiveVenueSeeder::class);

        $this->assertDatabaseCount('live_venues', 10);
        $this->assertDatabaseHas('live_venues', ['name' => '日本武道館', 'prefecture' => '東京都']);
        $this->assertDatabaseHas('live_venues', ['name' => '京セラドーム大阪', 'prefecture' => '大阪府']);
        $this->assertDatabaseHas('live_venues', ['name' => '沖縄アリーナ', 'prefecture' => '沖縄県']);
    }
}
