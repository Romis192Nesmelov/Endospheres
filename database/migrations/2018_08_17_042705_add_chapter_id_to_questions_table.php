<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChapterIdToQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('questions', function (Blueprint $table) {
//            $table->integer('chapter_id', false, true);
//            $table->foreign('chapter_id')->references('id')->on('chapters')->onDelete('cascade')->onUpdate('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('questions', function (Blueprint $table) {
//            $table->dropForeign('questions_chapter_id_foreign');
//            $table->dropColumn('chapter_id');
//        });
    }
}
