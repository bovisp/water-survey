<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTopicIdColumnToLessonsWipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lessons_wip', function (Blueprint $table) {
            $table->integer('topic_id')->unsigned()->nullable();

            // $table->foreign('topic_id')
            //     ->references('id')
            //     ->on('topics')
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
        Schema::table('lessons_wip', function (Blueprint $table) {
            $table->dropColumn('topic_id');
        });
    }
}
