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
        Schema::create('leavebalance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leavetype');
            $table->foreign('leavetype')->references('id')->on('leaveMaster')->onDelete('cascade');
            $table->unsignedBigInteger('employeecode');
            $table->foreign('employeecode')->references('id')->on('employee_master')->onDelete('cascade');
            $table->integer('leavebalance');
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
        Schema::dropIfExists('leavebalance');
    }
};
