<?php

namespace App\Services;

use App\Exceptions\RakutenApiException;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use Psr\Log\LoggerInterface;

class RakutenTravelService
{
    public function __construct(
        private LoggerInterface $logger,
    ) {}

    /**
     * 楽天トラベル施設検索API
     *
     * @param  string   $latitude  緯度
     * @param  string   $longitude  経度
     * @return array APIレスポンスデータ
     *
     * @see https://webservice.rakuten.co.jp/documentation/simple-hotel-search
     */
    public function searchHotels(string $latitude, string $longitude): array
    {
        $response = $this->client()
            ->get('/SimpleHotelSearch/20170426', [
                'applicationId' => config('services.rakuten_travel.app_id'),
                'format' => 'json',
                'accessKey' => config('services.rakuten_travel.access_key'),
                'latitude' => $latitude,
                'longitude' => $longitude,
                'datumType' => 1,
                'searchRadius' => 1,
                'hits' => 10,
            ]);

        if (! $response->ok()) {
            if (! $response->notFound()) {
                $this->logger->error('Failed to search hotels from Rakuten Travel API', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            }

            throw new RakutenApiException(code: $response->status());
        }

        return $response->json();
    }

    /**
     * Rakuten Travel API用のHTTPクライアントを返す
     *
     * @return PendingRequest Rakuten Travel API用のHTTPクライアント
     */
    private function client(): PendingRequest
    {
        return Http::rakutenTravel();
    }
}
