<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeTableDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_table_details', function (Blueprint $table) {
            $table->bigIncrements('jadual_detail_id');
            $table->integer('jadual_id');
            $table->integer('subject_id');
            $table->date('date');
            $table->integer('slot_id');
            $table->integer('staff_id');
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
        Schema::dropIfExists('time_table_details');
    }
}
