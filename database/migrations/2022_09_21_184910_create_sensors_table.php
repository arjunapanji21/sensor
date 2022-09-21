<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->id();
            $table->dateTime('waktu');
            $table->integer('temp_1');
            $table->integer('humid_1');
            $table->integer('temp_2');
            $table->integer('humid_2');
            $table->integer('temp_3');
            $table->integer('humid_3');
            $table->integer('temp_avg');
            $table->integer('humid_avg');
            $table->string('keterangan')->nullable();
            $table->integer('pwm_kipas')->default(0);
            $table->integer('pwm_pompa')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensors');
    }
}
