<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLcmdatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lcmdatas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('number');
            $table->string('lcmtype')->nullable();
            $table->string('calculatedlcm')->nullable();
            $table->string('executiontime')->nullable();
            $table->string('space')->nullable();
            $table->string('bestmethod')->nullable();
            $table->string('bestexecution')->nullable();
            $table->string('bestspace')->nullable();
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
        Schema::dropIfExists('lcmdatas');
    }
}
