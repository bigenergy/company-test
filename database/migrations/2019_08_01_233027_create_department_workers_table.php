<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_worker', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('family');
            $table->string('patronymic');
            $table->string('image');
            $table->string('email');
            $table->bigInteger('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('department_worker');
    }
}
