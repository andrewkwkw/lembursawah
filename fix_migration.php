<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

try {
    Schema::table('agendas', function (Blueprint $table) {
        $table->index('is_featured');
    });
} catch (\Exception $e) {}

try {
    Schema::table('galleries', function (Blueprint $table) {
        $table->index('type');
    });
} catch (\Exception $e) {}

try {
    DB::table('migrations')->insert([
        'migration' => '2026_08_23_201704_add_performance_indexes_and_slug_to_attractions',
        'batch' => DB::table('migrations')->max('batch') + 1
    ]);
} catch (\Exception $e) {}

echo "Fixed!\n";
