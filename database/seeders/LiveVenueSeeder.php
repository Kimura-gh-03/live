<?php

namespace Database\Seeders;

use App\Models\LiveVenue;
use Illuminate\Database\Seeder;

class LiveVenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $venues = [
            [
                'name' => '大和ハウス プレミストドーム (札幌ドーム)',
                'prefecture' => '北海道',
                'capacity' => 53820,
                'nearest_station' => '福住駅',
                'access' => '徒歩約10分',
                'google_maps_url' => 'https://www.google.com/maps/search/?api=1&query=大和ハウス+プレミストドーム&query_place_id=ChIJx289pMEqC18Ri7aK56qxdio',
                'toilet_layout' => [
                    'female_locations' => '約25箇所',
                    'male_locations' => '約20箇所',
                    'accessible_locations' => '各フロア設置',
                ],
            ],
            [
                'name' => 'セキスイハイムスーパーアリーナ',
                'prefecture' => '宮城県',
                'capacity' => 7063,
                'nearest_station' => '利府駅',
                'access' => 'バス約10分',
                'google_maps_url' => 'https://www.google.com/maps/search/?api=1&query=セキスイハイムスーパーアリーナ&query_place_id=ChIJjchmBHGEiV8Rcukw2geTA7c',
                'toilet_layout' => [
                    'female_locations' => '約6箇所',
                    'male_locations' => '約5箇所',
                    'note' => '屋外エリアにも常設トイレあり',
                ],
            ],
            [
                'name' => 'さいたまスーパーアリーナ',
                'prefecture' => '埼玉県',
                'capacity' => 37000,
                'nearest_station' => 'さいたま新都心駅',
                'access' => '徒歩約3分',
                'google_maps_url' => 'https://www.google.com/maps/search/?api=1&query=さいたまスーパーアリーナ&query_place_id=ChIJv4Yp2QzBGGARnYRUdDcabFA',
                'toilet_layout' => [
                    'female_locations' => '計18箇所',
                    'male_locations' => '計14箇所',
                    'accessible_locations' => '各階複数箇所',
                ],
            ],
            [
                'name' => '日本武道館',
                'prefecture' => '東京都',
                'capacity' => 14471,
                'nearest_station' => '九段下駅',
                'access' => '徒歩約5分',
                'google_maps_url' => 'https://www.google.com/maps/search/?api=1&query=日本武道館&query_place_id=ChIJE_QrgGuMGGARiHFlyXFcWyE',
                'toilet_layout' => [
                    'female_locations' => '約6箇所',
                    'male_locations' => '約5箇所',
                    'accessible_locations' => '2箇所',
                ],
            ],
            [
                'name' => 'Kアリーナ横浜',
                'prefecture' => '神奈川県',
                'capacity' => 20033,
                'nearest_station' => '横浜駅 / 新高島駅',
                'access' => '徒歩約9〜11分',
                'google_maps_url' => 'https://www.google.com/maps/search/?api=1&query=Kアリーナ横浜&query_place_id=ChIJ6Te0zGZdGGARg8sCj6TN9rQ',
                'toilet_layout' => [
                    'female_locations' => '計15箇所',
                    'male_locations' => '計10箇所',
                    'note' => '女性トイレの待機列緩和に特化した最新設計',
                ],
            ],
            [
                'name' => 'IGアリーナ (愛知県新体育館)',
                'prefecture' => '愛知県',
                'capacity' => 17000,
                'nearest_station' => '名城公園駅',
                'access' => '徒歩約2分',
                'google_maps_url' => 'https://www.google.com/maps/search/?api=1&query=IGアリーナ&query_place_id=ChIJ9WgWji1xA2ARf6xDT5v8b4s',
                'toilet_layout' => [
                    'female_locations' => '約12箇所',
                    'male_locations' => '約8箇所',
                    'accessible_locations' => '全フロア完備',
                ],
            ],
            [
                'name' => '京セラドーム大阪',
                'prefecture' => '大阪府',
                'capacity' => 55000,
                'nearest_station' => 'ドーム前千代崎駅',
                'access' => '徒歩すぐ',
                'google_maps_url' => 'https://www.google.com/maps/search/?api=1&query=京セラドーム大阪&query_place_id=ChIJS2iHS7LnAGAR8YQUFvl1X1M',
                'toilet_layout' => [
                    'female_locations' => '20箇所以上',
                    'male_locations' => '15箇所以上',
                    'accessible_locations' => '各ゲート付近',
                ],
            ],
            [
                'name' => 'おおきにアリーナ舞洲',
                'prefecture' => '大阪府',
                'capacity' => 7056,
                'nearest_station' => '桜島駅 (バス利用)',
                'access' => 'バス約15分',
                'google_maps_url' => 'https://www.google.com/maps/search/?api=1&query=おおきにアリーナ舞洲&query_place_id=ChIJ1YxPRuzpAGAR1Puy_XjxwZ8',
                'toilet_layout' => [
                    'female_locations' => '1F・2F計4箇所',
                    'male_locations' => '1F・2F計4箇所',
                    'note' => 'スポーツ施設併設のため男女数が均衡',
                ],
            ],
            [
                'name' => 'マリンメッセ福岡 A館',
                'prefecture' => '福岡県',
                'capacity' => 15000,
                'nearest_station' => '呉服町駅 / 中洲川端駅',
                'access' => '徒歩約15分 / バス約10分',
                'google_maps_url' => 'https://www.google.com/maps/search/?api=1&query=マリンメッセ福岡+A館&query_place_id=ChIJmWyYFuWRQTURMXvsTy8vXro',
                'toilet_layout' => [
                    'female_locations' => '約10箇所',
                    'male_locations' => '約7箇所',
                    'accessible_locations' => '各階設置',
                ],
            ],
            [
                'name' => '沖縄アリーナ',
                'prefecture' => '沖縄県',
                'capacity' => 10000,
                'nearest_station' => '那覇空港 (高速バス)',
                'access' => '沖縄市運動公園前 徒歩約5分',
                'google_maps_url' => 'https://www.google.com/maps/search/?api=1&query=沖縄アリーナ&query_place_id=ChIJdwMAGWkT5TQR1FyodU4qN9Q',
                'toilet_layout' => [
                    'female_locations' => '約10箇所',
                    'male_locations' => '約8箇所',
                    'accessible_locations' => '最新ユニバーサルデザイン完備',
                ],
            ],
        ];

        foreach ($venues as $venue) {
            LiveVenue::create($venue);
        }
    }
}
