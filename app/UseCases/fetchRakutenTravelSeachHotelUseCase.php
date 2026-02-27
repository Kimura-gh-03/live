<?php

namespace App\UseCases;

use App\Exceptions\RakutenApiException;
use App\Models\LiveVenue;
use App\Services\RakutenTravelService;

class FetchRakutenTravelSeachHotelUseCase
{
    public function __construct(private readonly RakutenTravelService $rakutenTravelService) {}

    /**
     * 楽天トラベルAPIを呼び出して、指定した緯度経度周辺のホテル情報を取得する
     *
     * @param  float  $latitude 緯度
     * @param  float  $longitude 経度
     * @return array<string, mixed> ホテル情報の配列
     *
     * @throws RakutenApiException API呼び出しに失敗した場合にスローされる例外
     */
    public function execute(LiveVenue $venue): array
    {
        try {
            $hotels = $this->rakutenTravelService->searchHotels(
                $venue->latitude,
                $venue->longitude,
            )['hotels'];
        } catch (RakutenApiException $e) {
            return [
                'status' => 'error',
                'message' => $e->context(),
            ];
        }

        return [
            'status' => 'success',
            'hotels' => $hotels ?? [],
        ];
    }
}