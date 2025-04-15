<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_no', 30)->unique()->comment('订单号');
            $table->integer('student_id', false, true)->comment('学生id')->index();
            $table->integer('teacher_id', false, true)->comment('教师id')->index();
            $table->integer('course_id', false, true)->comment('课程id')->index();
            $table->integer('sender_id', false, true)->comment('发送人id')->default(0)->index();
            $table->dateTime('send_time')->nullable()->comment('发送时间');
            $table->decimal('amount', 10)->comment('订单金额');
            $table->tinyInteger('status', false, true)->default(0)->commnet('订单状态: 0,待发送 1,已发送');
            $table->tinyInteger('pay_status', false, true)->default(0)->commnet('支付状态: 0,未支付 1,已支付 2,支付失败');
            $table->dateTime('pay_time')->nullable()->comment('支付时间');
            $table->json('pay_info')->nullable()->comment('三方回调支付信息');
            $table->string('pay_id')->nullable()->unique()->comment('三方订单号');

            $table->timestamps();
            $table->unique(['student_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
