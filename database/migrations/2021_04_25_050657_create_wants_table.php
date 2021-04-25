<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        if (!Schema::hasTable('wants')) {
            Schema::create('wants', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->integer('user_id')->nullable()->comment('ユーザID');
                $table->integer('score_id')->nullable()->comment('楽曲ID');
            });
//        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wants');
    }
}
