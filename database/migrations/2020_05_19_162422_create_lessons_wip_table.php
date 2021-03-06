<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsWipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons_wip', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('level_id');
            $table->string('number');
            $table->text('name');
            $table->timestamps(); 

            // $table->foreign('level_id')
            //     ->references('id')
            //     ->on('levels')
            //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons_wip');
    }
}
