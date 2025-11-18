<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('grocery_items', function (Blueprint $table) {
            // First add the column as nullable
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
        });

        // If there are existing records, assign them to a user (or delete them)
        // For now, we'll delete existing records since they don't belong to any user
        DB::table('grocery_items')->delete();

        // Now make the column not nullable
        Schema::table('grocery_items', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('grocery_items', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
