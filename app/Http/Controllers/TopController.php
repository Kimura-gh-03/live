<?php

namespace App\Http\Controllers;

use App\Models\LiveVenue;
use App\UseCases\FetchRakutenTravelSearchHotelUseCase;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\Response;

class TopController extends Controller
{
    /**
     * Show the application's top page.
     */
    public function index(): Response
    {
        return Inertia::render('venues', [
            'venues' => LiveVenue::all(),
        ]);
    }

    /**
     * 楽天トラベルAPIを呼び出して、指定したライブ会場周辺のホテル情報を取得する
     *
     * @param  LiveVenue  $venue ライブ会場モデル
     * @param  FetchRakutenTravelSearchHotelUseCase  $useCase 楽天トラベルAPIを呼び出すユースケース
     * @return JsonResponse ホテル情報のJSONレスポンス
     */
    public function getHotels(
        LiveVenue $venue, 
        FetchRakutenTravelSearchHotelUseCase $useCase
    ): JsonResponse {
        return response()->json($useCase($venue));
    }
}
