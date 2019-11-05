<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHadirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hadirs', function (Blueprint $table) {
            $table->bigIncrements('hadir_id');
            $table->integer('jadual_detail_id');
            $table->integer('enrolment_id');
            $table->date('date');
            $table->integer('status_id');
            $table->time('time');
            $table->time('updated_by');
            $table->integer('created_by');
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
        Schema::dropIfExists('hadirs');
    }
}
