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
        Schema::create('live_locations', function (Blueprint $table) {
            $table->id();
            $table->string('plate_number')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->geometry('coordinate', 'point')->nullable();
            $table->timestamp('timestamp')->nullable();
            $table->integer('speed')->nullable();
            $table->integer('accuracy')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('live_locations', function (Blueprint $table) {
            $table->dropForeign(['driver_id']);
        });
        Schema::dropIfExists('live_location');
    }
};
