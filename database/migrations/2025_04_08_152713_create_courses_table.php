<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('teacher_id', false, true)->comment('教师id')->index();
            $table->string('name', 40)->comment('课程名称');
            $table->string('period', 10)->comment('课程年月');
            $table->decimal('charge', 10)->comment('费用');
            $table->string('description', 255)->comment('课程介绍');

            $table->timestamps();
            $table->softDeletes();
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
}
