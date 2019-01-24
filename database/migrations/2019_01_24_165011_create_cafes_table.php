<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCafesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cafes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('local', 12)->comment('지역');
            $table->string('name', 50)->comment('업체명');
            $table->double('lat')->comment('좌표 lat');
            $table->double('lng')->comment('좌표 lng');
            $table->string('tel', 30)->nullable()->comment('연락처');
            $table->string('addr', 150)->nullable()->comment('신주소');
            $table->string('addr_old', 150)->nullable()->comment('구주소');
            $table->double('area')->nullable()->comment('면적');
            $table->string('hygiene_conditions', 15)->nullable()->comment('구분');
            $table->string('hygiene_type', 15)->nullable()->comment('대분류');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('cafes');
    }
}
