import { Head } from '@inertiajs/react';
import { ExternalLink, MapPin, Star, Train, Users } from 'lucide-react';
import { useEffect, useState } from 'react';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';

type ToiletLayout = {
    female_locations: string;
    male_locations: string;
    accessible_locations?: string;
    note?: string;
};

type LiveVenue = {
    id: number;
    name: string;
    prefecture: string;
    capacity: number;
    nearest_station: string;
    access: string;
    google_maps_url: string;
    toilet_layout: ToiletLayout;
    latitude: number;
    longitude: number;
};

type HotelBasicInfo = {
    hotelNo: number;
    hotelName: string;
    hotelInformationUrl: string;
    hotelSpecial: string;
    hotelMinCharge: number;
    address1: string;
    address2: string;
    access: string;
    nearestStation: string;
    hotelThumbnailUrl: string;
    reviewCount: number;
    reviewAverage: number;
};

// 楽天トラベルAPIのレスポンス形式: hotels[].hotel[0].hotelBasicInfo
type Hotel = { hotel: Array<{ hotelBasicInfo?: HotelBasicInfo }> };

export default function Venues({ venues }: { venues: LiveVenue[] }) {
    const [selectedVenueId, setSelectedVenueId] = useState<string | null>(null);
    const [loadedVenueId, setLoadedVenueId] = useState<string | null>(null);
    const [hotels, setHotels] = useState<Hotel[]>([]);
    const [hotelsError, setHotelsError] = useState<string | null>(null);

    const selectedVenue = venues.find((v) => v.id.toString() === selectedVenueId) ?? null;
    const hotelsLoading = selectedVenueId !== null && selectedVenueId !== loadedVenueId;

    const handleVenueChange = (venueId: string) => {
        setSelectedVenueId(venueId);
        setLoadedVenueId(null);
        setHotels([]);
        setHotelsError(null);
    };

    useEffect(() => {
        if (!selectedVenueId) {
            return;
        }

        const venue = venues.find((v) => v.id.toString() === selectedVenueId);
        if (!venue) {
            return;
        }

        const controller = new AbortController();

        fetch(`/api/venues/${venue.id}/hotels`, { signal: controller.signal })
            .then((res) => res.json())
            .then((data) => {
                if (data.status === 'error') {
                    setHotelsError(data.message);
                } else if (data.status === 'success') {
                    setHotels(data.hotels ?? []);
                }
                setLoadedVenueId(selectedVenueId);
            })
            .catch((err: unknown) => {
                if (err instanceof Error && err.name !== 'AbortError') {
                    setHotelsError('データの取得に失敗しました');
                    setLoadedVenueId(selectedVenueId);
                }
            });

        return () => controller.abort();
    }, [selectedVenueId, venues]);

    return (
        <>
            <Head title="ライブ会場一覧" />
            <div className="min-h-screen bg-slate-50 dark:bg-slate-900">
                <header className="border-b bg-white px-6 py-5 dark:border-slate-800 dark:bg-slate-950">
                    <div className="mx-auto max-w-5xl">
                        <h1 className="text-2xl font-bold text-slate-900 dark:text-white">ライブ会場検索</h1>
                        <p className="mt-0.5 text-sm text-slate-500 dark:text-slate-400">全国のライブ会場の詳細情報をご確認いただけます</p>
                    </div>
                </header>

                <main className="mx-auto max-w-5xl p-6 lg:p-8">
                    <Select onValueChange={handleVenueChange}>
                        <SelectTrigger className="h-11 w-full">
                            <SelectValue placeholder="会場を選択してください" />
                        </SelectTrigger>
                        <SelectContent>
                            {venues.map((venue) => (
                                <SelectItem key={venue.id} value={venue.id.toString()}>
                                    {venue.name}（{venue.prefecture}）
                                </SelectItem>
                            ))}
                        </SelectContent>
                    </Select>

                    {selectedVenue && (
                        <div className="mt-6 grid gap-5 lg:grid-cols-2">
                            {/* 会場情報 */}
                            <div className="space-y-4">
                                <div className="rounded-xl border bg-white p-5 dark:border-slate-800 dark:bg-slate-950">
                                    <div className="flex items-start justify-between gap-3">
                                        <div>
                                            <h2 className="text-lg font-bold text-slate-900 dark:text-white">{selectedVenue.name}</h2>
                                            <p className="mt-0.5 text-sm text-slate-500 dark:text-slate-400">{selectedVenue.prefecture}</p>
                                        </div>
                                        <a
                                            href={selectedVenue.google_maps_url}
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            className="flex shrink-0 items-center gap-1.5 rounded-lg border px-3 py-1.5 text-xs font-medium text-slate-600 transition-colors hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800"
                                        >
                                            <MapPin className="size-3.5" />
                                            地図
                                            <ExternalLink className="size-3" />
                                        </a>
                                    </div>

                                    <div className="mt-4 grid grid-cols-2 gap-3">
                                        <div className="rounded-lg bg-slate-50 p-3 dark:bg-slate-800/60">
                                            <div className="flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400">
                                                <Users className="size-3.5" />
                                                収容人数
                                            </div>
                                            <p className="mt-1 text-xl font-bold text-slate-900 dark:text-white">
                                                {selectedVenue.capacity.toLocaleString()}
                                                <span className="ml-1 text-xs font-normal text-slate-500">人</span>
                                            </p>
                                        </div>
                                        <div className="rounded-lg bg-slate-50 p-3 dark:bg-slate-800/60">
                                            <div className="flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400">
                                                <Train className="size-3.5" />
                                                最寄り駅
                                            </div>
                                            <p className="mt-1 text-sm font-semibold text-slate-900 dark:text-white">{selectedVenue.nearest_station}</p>
                                            <p className="mt-0.5 text-xs text-slate-500 dark:text-slate-400">{selectedVenue.access}</p>
                                        </div>
                                    </div>
                                </div>

                                <div className="rounded-xl border bg-white p-5 dark:border-slate-800 dark:bg-slate-950">
                                    <h3 className="mb-3 text-sm font-semibold text-slate-700 dark:text-slate-300">トイレ情報</h3>
                                    <div className={`grid divide-x rounded-lg border text-sm dark:divide-slate-700 dark:border-slate-700 ${selectedVenue.toilet_layout.accessible_locations ? 'grid-cols-3' : 'grid-cols-2'}`}>
                                        <div className="px-3 py-2.5">
                                            <p className="text-xs text-slate-400">女性用</p>
                                            <p className="mt-0.5 font-medium text-slate-900 dark:text-white">{selectedVenue.toilet_layout.female_locations}</p>
                                        </div>
                                        <div className="px-3 py-2.5">
                                            <p className="text-xs text-slate-400">男性用</p>
                                            <p className="mt-0.5 font-medium text-slate-900 dark:text-white">{selectedVenue.toilet_layout.male_locations}</p>
                                        </div>
                                        {selectedVenue.toilet_layout.accessible_locations && (
                                            <div className="px-3 py-2.5">
                                                <p className="text-xs text-slate-400">バリアフリー</p>
                                                <p className="mt-0.5 font-medium text-slate-900 dark:text-white">{selectedVenue.toilet_layout.accessible_locations}</p>
                                            </div>
                                        )}
                                    </div>
                                    {selectedVenue.toilet_layout.note && (
                                        <p className="mt-2 rounded-lg bg-amber-50 px-3 py-2 text-xs text-amber-700 dark:bg-amber-950/30 dark:text-amber-400">
                                            {selectedVenue.toilet_layout.note}
                                        </p>
                                    )}
                                </div>
                            </div>

                            {/* 周辺ホテル */}
                            <div>
                                <h3 className="mb-3 text-sm font-semibold text-slate-700 dark:text-slate-300">周辺ホテル（半径1km圏内）</h3>
                                {hotelsLoading ? (
                                    <div className="space-y-3">
                                        {[...Array(4)].map((_, i) => (
                                            <div key={i} className="h-[88px] animate-pulse rounded-xl bg-slate-200 dark:bg-slate-800" />
                                        ))}
                                    </div>
                                ) : hotelsError ? (
                                    <div className="flex h-32 items-center justify-center rounded-xl border border-dashed text-sm text-slate-400 dark:border-slate-700">
                                        {hotelsError}
                                    </div>
                                ) : hotels.length > 0 ? (
                                    <div className="space-y-2">
                                        {hotels.map((hotel) => {
                                            const info = hotel.hotel[0]?.hotelBasicInfo;
                                            if (!info || !info.hotelMinCharge) return null;
                                            return (
                                                <a
                                                    key={info.hotelNo}
                                                    href={info.hotelInformationUrl}
                                                    target="_blank"
                                                    rel="noopener noreferrer"
                                                    className="flex gap-3 rounded-xl border bg-white p-3 transition-colors hover:bg-slate-50 dark:border-slate-800 dark:bg-slate-950 dark:hover:bg-slate-900"
                                                >
                                                    {info.hotelThumbnailUrl && (
                                                        <img
                                                            src={info.hotelThumbnailUrl}
                                                            alt={info.hotelName}
                                                            className="size-16 shrink-0 rounded-lg object-cover"
                                                        />
                                                    )}
                                                    <div className="min-w-0 flex-1">
                                                        <p className="truncate text-sm font-semibold text-slate-900 dark:text-white">{info.hotelName}</p>
                                                        <p className="mt-0.5 truncate text-xs text-slate-500 dark:text-slate-400">{info.access}</p>
                                                        <div className="mt-1.5 flex items-center justify-between gap-2">
                                                            <div className="flex items-center gap-1 text-xs">
                                                                <Star className="size-3 shrink-0 fill-amber-400 text-amber-400" />
                                                                <span className="font-medium text-slate-700 dark:text-slate-300">{info.reviewAverage?.toFixed(1)}</span>
                                                                <span className="text-slate-400">（{info.reviewCount ?? 0}件）</span>
                                                            </div>
                                                            <p className="shrink-0 text-xs font-bold text-indigo-600 dark:text-indigo-400">
                                                                ¥{info.hotelMinCharge?.toLocaleString()}〜
                                                            </p>
                                                        </div>
                                                    </div>
                                                </a>
                                            );
                                        })}
                                    </div>
                                ) : (
                                    <div className="flex h-32 items-center justify-center rounded-xl border border-dashed text-sm text-slate-400 dark:border-slate-700">
                                        ホテルが見つかりませんでした
                                    </div>
                                )}
                            </div>
                        </div>
                    )}
                </main>
            </div>
        </>
    );
}
