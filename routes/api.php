<?php

use App\Http\Controllers\TopController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/venues/{venue}/hotels', [TopController::class, 'getHotels'])->name('venues.hotels');

if (! app()->isProduction()) {
    // 楽天トラベルAPIモック
    Route::prefix('rakutenTravel')->group(function () {
        // 施設検索API
        Route::get('/SimpleHotelSearch/20170426', function (Request $request): JsonResponse {
            $hotels = [
                [
                    'hotel' => [
                        ['hotelBasicInfo' => [
                            'hotelNo' => 136197,
                            'hotelName' => 'ダイワロイネットホテル大宮',
                            'hotelInformationUrl' => 'https://travel.rakuten.co.jp/HOTEL/136197/',
                            'hotelSpecial' => 'JR大宮駅西口より徒歩3分。さいたまスーパーアリーナへのアクセス良好。',
                            'hotelMinCharge' => 7500,
                            'latitude' => 35.9063,
                            'longitude' => 139.6233,
                            'address1' => '埼玉県さいたま市大宮区桜木町',
                            'address2' => '1-7-5',
                            'access' => 'JR大宮駅西口より徒歩約3分',
                            'nearestStation' => '大宮',
                            'hotelThumbnailUrl' => 'https://img.travel.rakuten.co.jp/share/HOTEL/136197/136197s.jpg',
                            'reviewCount' => 382,
                            'reviewAverage' => 4.21,
                        ]],
                        ['hotelRatingInfo' => [
                            'serviceAverage' => 4.3,
                            'locationAverage' => 4.5,
                            'roomAverage' => 4.0,
                            'equipmentAverage' => 3.9,
                            'bathAverage' => 4.1,
                            'mealAverage' => 0.0,
                        ]],
                    ],
                ],
                [
                    'hotel' => [
                        ['hotelBasicInfo' => [
                            'hotelNo' => 98312,
                            'hotelName' => 'ホテルブリランテ武蔵野',
                            'hotelInformationUrl' => 'https://travel.rakuten.co.jp/HOTEL/98312/',
                            'hotelSpecial' => 'さいたま新都心駅直結の好立地。大型イベント時に便利。',
                            'hotelMinCharge' => 9800,
                            'latitude' => 35.8951,
                            'longitude' => 139.6312,
                            'address1' => '埼玉県さいたま市北区宮原町',
                            'address2' => '4-19-9',
                            'access' => 'JRさいたま新都心駅より徒歩約5分',
                            'nearestStation' => 'さいたま新都心',
                            'hotelThumbnailUrl' => 'https://img.travel.rakuten.co.jp/share/HOTEL/98312/98312s.jpg',
                            'reviewCount' => 541,
                            'reviewAverage' => 4.05,
                        ]],
                        ['hotelRatingInfo' => [
                            'serviceAverage' => 4.1,
                            'locationAverage' => 4.7,
                            'roomAverage' => 3.9,
                            'equipmentAverage' => 4.0,
                            'bathAverage' => 3.8,
                            'mealAverage' => 3.5,
                        ]],
                    ],
                ],
                [
                    'hotel' => [
                        ['hotelBasicInfo' => [
                            'hotelNo' => 72045,
                            'hotelName' => 'コンフォートホテル大宮',
                            'hotelInformationUrl' => 'https://travel.rakuten.co.jp/HOTEL/72045/',
                            'hotelSpecial' => '朝食無料サービス付き。全室禁煙・Wi-Fi完備。',
                            'hotelMinCharge' => 6200,
                            'latitude' => 35.9071,
                            'longitude' => 139.6198,
                            'address1' => '埼玉県さいたま市大宮区桜木町',
                            'address2' => '2-2',
                            'access' => 'JR大宮駅西口より徒歩約5分',
                            'nearestStation' => '大宮',
                            'hotelThumbnailUrl' => 'https://img.travel.rakuten.co.jp/share/HOTEL/72045/72045s.jpg',
                            'reviewCount' => 218,
                            'reviewAverage' => 3.88,
                        ]],
                        ['hotelRatingInfo' => [
                            'serviceAverage' => 3.9,
                            'locationAverage' => 4.3,
                            'roomAverage' => 3.7,
                            'equipmentAverage' => 3.8,
                            'bathAverage' => 3.6,
                            'mealAverage' => 4.2,
                        ]],
                    ],
                ],
                [
                    'hotel' => [
                        ['hotelBasicInfo' => [
                            'hotelNo' => 154823,
                            'hotelName' => 'スーパーホテルさいたま・大宮',
                            'hotelInformationUrl' => 'https://travel.rakuten.co.jp/HOTEL/154823/',
                            'hotelSpecial' => '天然温泉大浴場完備。コストパフォーマンスが高い人気ホテル。',
                            'hotelMinCharge' => 5800,
                            'latitude' => 35.9055,
                            'longitude' => 139.6241,
                            'address1' => '埼玉県さいたま市大宮区上小町',
                            'address2' => '818',
                            'access' => 'JR大宮駅西口より徒歩約7分',
                            'nearestStation' => '大宮',
                            'hotelThumbnailUrl' => 'https://img.travel.rakuten.co.jp/share/HOTEL/154823/154823s.jpg',
                            'reviewCount' => 673,
                            'reviewAverage' => 4.42,
                        ]],
                        ['hotelRatingInfo' => [
                            'serviceAverage' => 4.4,
                            'locationAverage' => 4.2,
                            'roomAverage' => 4.3,
                            'equipmentAverage' => 4.5,
                            'bathAverage' => 4.8,
                            'mealAverage' => 0.0,
                        ]],
                    ],
                ],
                [
                    'hotel' => [
                        ['hotelBasicInfo' => [
                            'hotelNo' => 203711,
                            'hotelName' => 'ラビスタさいたま',
                            'hotelInformationUrl' => 'https://travel.rakuten.co.jp/HOTEL/203711/',
                            'hotelSpecial' => '2022年開業の新しいホテル。モダンな客室と上質なサービスを提供。',
                            'hotelMinCharge' => 12000,
                            'latitude' => 35.8942,
                            'longitude' => 139.6289,
                            'address1' => '埼玉県さいたま市北区宮原町',
                            'address2' => '1-829',
                            'access' => 'JRさいたま新都心駅より徒歩約8分',
                            'nearestStation' => 'さいたま新都心',
                            'hotelThumbnailUrl' => 'https://img.travel.rakuten.co.jp/share/HOTEL/203711/203711s.jpg',
                            'reviewCount' => 94,
                            'reviewAverage' => 4.68,
                        ]],
                        ['hotelRatingInfo' => [
                            'serviceAverage' => 4.8,
                            'locationAverage' => 4.4,
                            'roomAverage' => 4.7,
                            'equipmentAverage' => 4.6,
                            'bathAverage' => 4.5,
                            'mealAverage' => 4.3,
                        ]],
                    ],
                ],
            ];

            return response()->json([
                'pagingInfo' => [
                    'recordCount' => count($hotels),
                    'pageCount' => 1,
                    'page' => 1,
                    'first' => 1,
                    'last' => count($hotels),
                ],
                'hotels' => $hotels,
            ]);
        });
    });
}
