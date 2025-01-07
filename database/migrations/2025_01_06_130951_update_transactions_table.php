<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Menambahkan kolom 'type' dengan nilai enum
            $table->enum('type', ['top_up', 'pickup_payment'])->after('user_id');

            // Membuat 'schedule_id' nullable
            $table->uuid('schedule_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Menghapus kolom 'type'
            $table->dropColumn('type');

            // Mengembalikan 'schedule_id' menjadi NOT NULL
            $table->uuid('schedule_id')->nullable(false)->change();
        });
    }
};
