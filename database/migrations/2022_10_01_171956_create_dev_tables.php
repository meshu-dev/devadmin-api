<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('environments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('order')->default(0);
        });

        Schema::create('icons', function (Blueprint $table) {
            $table->id();
            $table->string('url');
        });

        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('environment_id');
            $table->string('name', 100);
            $table->string('url');

            $table->foreign('environment_id')->references('id')->on('environments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::dropIfExists('environments');
        Schema::dropIfExists('icons');
        Schema::dropIfExists('sites');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
