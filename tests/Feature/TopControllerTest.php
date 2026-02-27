<?php

namespace Tests\Feature;

use App\Models\LiveVenue;
use App\Services\RakutenTravelService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TopControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_venues_page(): void
    {
        LiveVenue::factory()->count(3)->create();

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('venues')
            ->has('venues', 3)
        );
    }

    public function test_get_hotels_returns_hotel_data_for_venue(): void
    {
        $venue = LiveVenue::factory()->create([
            'name' => 'さいたまスーパーアリーナ',
            'latitude' => 35.8938,
            'longitude' => 139.6287,
        ]);

        $mockHotels = [
            'pagingInfo' => ['recordCount' => 1, 'pageCount' => 1, 'page' => 1, 'first' => 1, 'last' => 1],
            'hotels' => [
                [
                    ['hotelBasicInfo' => ['hotelNo' => 136197, 'hotelName' => 'テストホテル']],
                    ['hotelRatingInfo' => ['serviceAverage' => 4.3]],
                ],
            ],
        ];

        $this->mock(RakutenTravelService::class)
            ->shouldReceive('searchHotels')
            ->once()
            ->with('35.8938', '139.6287')
            ->andReturn($mockHotels);

        $response = $this->getJson("/api/venues/{$venue->id}/hotels");

        $response->assertStatus(200);
        $response->assertJsonPath('hotels.0.0.hotelBasicInfo.hotelName', 'テストホテル');
    }

    public function test_get_hotels_returns_404_for_missing_venue(): void
    {
        $response = $this->getJson('/api/venues/9999/hotels');

        $response->assertStatus(404);
    }

    public function test_get_hotels_returns_empty_when_service_fails(): void
    {
        $venue = LiveVenue::factory()->create();

        $this->mock(RakutenTravelService::class)
            ->shouldReceive('searchHotels')
            ->once()
            ->andReturn([]);

        $response = $this->getJson("/api/venues/{$venue->id}/hotels");

        $response->assertStatus(200);
        $response->assertExactJson([]);
    }
}
