<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Article;
use App\Models\Product;
use App\Models\TourPackage;
use App\Models\MapPoint;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Artikel', Article::count())
                ->description('Publikasi berita')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),
            Stat::make('Total Produk UMKM', Product::count())
                ->description('Produk unggulan desa')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('info'),
            Stat::make('Total Paket Wisata', TourPackage::count())
                ->description('Pilihan liburan')
                ->descriptionIcon('heroicon-m-ticket')
                ->color('warning'),
            Stat::make('Total Titik Peta', MapPoint::count())
                ->description('Lokasi terdaftar')
                ->descriptionIcon('heroicon-m-map-pin')
                ->color('primary'),
        ];
    }
}
