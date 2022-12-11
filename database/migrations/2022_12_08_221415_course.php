<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('credits');
        $table->string('teacher_name');
        $table->string('prerequisit');
        $table->bigInteger('autonomy_hours');
        $table->bigInteger('directed_hours');
        $table->unsignedBigInteger('semester_id')->unsigned();
        $table->foreign('semester_id')->references('id')->on('semesters');
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
        Schema::dropIfExists('courses');
    }
};
