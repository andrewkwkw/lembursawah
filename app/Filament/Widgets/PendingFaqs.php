<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Faq;

class PendingFaqs extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';
    
    public function table(Table $table): Table
    {
        return $table
            ->query(Faq::query()->where('status', 'pending')->latest()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('question')->searchable()->label('Pertanyaan Masuk'),
                Tables\Columns\TextColumn::make('asked_by_name')->searchable()->label('Penanya'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->label('Dikirim Pada'),
            ])
            ->paginated(false);
    }
}
