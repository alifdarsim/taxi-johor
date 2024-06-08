<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('advertisement_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('advertisement_id')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->timestamp('start_wrapping_at')->nullable();
            $table->timestamp('end_wrapping_at')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('advertisement_id')->references('id')->on('advertisements')->onDelete('set null');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('advertisement_histories', function (Blueprint $table) {
            $table->dropForeign(['vehicle_id']);
            $table->dropForeign(['wrapping_id']);
        });
        Schema::dropIfExists('advertisement_histories');
    }
};
