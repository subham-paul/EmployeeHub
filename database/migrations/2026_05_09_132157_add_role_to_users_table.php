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
        // This migration is being disabled to prevent duplicate column creation.
        // The 'role' column is now handled by a newer migration (2026_05_10_060232_add_role_to_users_table.php).
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration is being disabled.
    }
};
