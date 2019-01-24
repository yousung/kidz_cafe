<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalsTable extends Migration
{
    public function up()
    {
        Schema::create('medicals', function (Blueprint $table) {
            $table->increments('id');

            // 기관정보
            $table->string('type', 15)->comment('구분 [pharmacy,hospital]');
            $table->string('name', 45)->comment('기관명');
            $table->string('hpid', 15)->unique()->comment('기관 ID');
            $table->string('tel', 20)->comment('대표번호');
            $table->string('etc')->nullable()->comment('비고');

            // 주소
            $table->string('addr', 150)->comment('주소');
            $table->double('lat')->comment('좌표 Lat');
            $table->double('lng')->comment('좌표 lng');

            //영업시간
            $table->string('weekday_s', 15)->comment('평일 시작');
            $table->string('weekday_e', 15)->comment('평일 끝');

            $table->string('saturday_s', 15)->nullable()->comment('토요일 시작');
            $table->string('saturday_e', 15)->nullable()->comment('토요일 끝');
            $table->string('sunday_s', 15)->nullable()->comment('일요일 시작');
            $table->string('sunday_e', 15)->nullable()->comment('일요일 끝');

            $table->string('holiday_s', 15)->nullable()->comment('휴일 시작');
            $table->string('holiday_e', 15)->nullable()->comment('휴일 끝');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medicals');
    }
}
