<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Article;

class LatestArticles extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Article::query()->latest()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->label('Judul Artikel'),
                Tables\Columns\IconColumn::make('is_published')->boolean()->label('Dipublikasikan'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->label('Dibuat Pada'),
            ])
            ->paginated(false);
    }
}
