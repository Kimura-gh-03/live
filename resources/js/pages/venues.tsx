import { useState } from 'react';
import { Head } from '@inertiajs/react';
import { ExternalLink, MapPin, Train, Users } from 'lucide-react';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
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
};

export default function Venues({ venues }: { venues: LiveVenue[] }) {
    const [selectedVenueId, setSelectedVenueId] = useState<string | null>(null);

    const selectedVenue = venues.find((v) => v.id.toString() === selectedVenueId) ?? null;

    return (
        <>
            <Head title="ライブ会場一覧" />
            <div className="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 p-6 lg:p-12 dark:from-slate-900 dark:to-slate-800">
                <div className="mx-auto max-w-2xl">
                    <div className="mb-8 text-center">
                        <h1 className="text-3xl font-bold tracking-tight text-slate-900 dark:text-white">ライブ会場検索</h1>
                        <p className="mt-2 text-sm text-slate-500 dark:text-slate-400">全国のライブ会場の詳細情報をご確認いただけます</p>
                    </div>

                    <Select onValueChange={setSelectedVenueId}>
                        <SelectTrigger className="h-12 w-full text-base">
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
                        <Card className="mt-6 overflow-hidden gap-0 py-0">
                            <div className="h-1.5 bg-gradient-to-r from-indigo-500 to-purple-500" />
                            <CardHeader className="pt-6">
                                <div className="flex items-start justify-between gap-4">
                                    <div>
                                        <CardTitle className="text-xl">{selectedVenue.name}</CardTitle>
                                        <CardDescription className="mt-1">{selectedVenue.prefecture}</CardDescription>
                                    </div>
                                    <a
                                        href={selectedVenue.google_maps_url}
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        className="flex shrink-0 items-center gap-1 rounded-lg bg-indigo-50 px-3 py-1.5 text-xs font-medium text-indigo-600 transition-colors hover:bg-indigo-100 dark:bg-indigo-950 dark:text-indigo-400 dark:hover:bg-indigo-900"
                                    >
                                        <MapPin className="size-3.5" />
                                        Google Maps
                                        <ExternalLink className="size-3" />
                                    </a>
                                </div>
                            </CardHeader>
                            <CardContent className="grid gap-4 pb-6">
                                <div className="grid grid-cols-2 gap-4">
                                    <div className="rounded-lg bg-slate-50 p-4 dark:bg-slate-800/50">
                                        <div className="flex items-center gap-2 text-xs font-medium uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                            <Users className="size-3.5" />
                                            収容人数
                                        </div>
                                        <p className="mt-1.5 text-2xl font-bold text-slate-900 dark:text-white">
                                            {selectedVenue.capacity.toLocaleString()}
                                            <span className="ml-1 text-sm font-normal text-slate-500">人</span>
                                        </p>
                                    </div>
                                    <div className="rounded-lg bg-slate-50 p-4 dark:bg-slate-800/50">
                                        <div className="flex items-center gap-2 text-xs font-medium uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                            <Train className="size-3.5" />
                                            最寄り駅
                                        </div>
                                        <p className="mt-1.5 text-sm font-semibold leading-snug text-slate-900 dark:text-white">
                                            {selectedVenue.nearest_station}
                                        </p>
                                        <p className="mt-0.5 text-xs text-slate-500 dark:text-slate-400">{selectedVenue.access}</p>
                                    </div>
                                </div>

                                <div>
                                    <h3 className="mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">トイレ情報</h3>
                                    <div className="rounded-lg border divide-y text-sm">
                                        <div className={`grid gap-0 divide-x ${selectedVenue.toilet_layout.accessible_locations ? 'grid-cols-3' : 'grid-cols-2'}`}>
                                            <div className="px-3 py-2">
                                                <p className="text-xs text-slate-500">女性用</p>
                                                <p className="mt-0.5 font-medium text-slate-900 dark:text-white">{selectedVenue.toilet_layout.female_locations}</p>
                                            </div>
                                            <div className="px-3 py-2">
                                                <p className="text-xs text-slate-500">男性用</p>
                                                <p className="mt-0.5 font-medium text-slate-900 dark:text-white">{selectedVenue.toilet_layout.male_locations}</p>
                                            </div>
                                            {selectedVenue.toilet_layout.accessible_locations && (
                                                <div className="px-3 py-2">
                                                    <p className="text-xs text-slate-500">バリアフリー</p>
                                                    <p className="mt-0.5 font-medium text-slate-900 dark:text-white">{selectedVenue.toilet_layout.accessible_locations}</p>
                                                </div>
                                            )}
                                        </div>
                                        {selectedVenue.toilet_layout.note && (
                                            <p className="bg-amber-50 px-3 py-2 text-xs text-amber-800 dark:bg-amber-950/30 dark:text-amber-400">
                                                {selectedVenue.toilet_layout.note}
                                            </p>
                                        )}
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    )}
                </div>
            </div>
        </>
    );
}
