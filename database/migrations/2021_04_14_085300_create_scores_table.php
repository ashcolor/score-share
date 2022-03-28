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
//        if (!Schema::hasTable('scores')) {
            Schema::create('scores', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->string('title', 1000)->comment('曲名');
                $table->string('artist', 1000)->nullable()->comment('アーティスト');
                $table->integer('score_created_by')->comment('作成者');
                $table->date('score_created_at')->nullable()->comment('作成日');
                $table->date('score_updated_at')->nullable()->comment('更新日');
                $table->string('genre', 100)->nullable()->comment('ジャンル');
                $table->text('remarks')->nullable()->comment('備考');
                $table->string('url', 1000)->nullable()->comment('url');
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
        Schema::drop('scores');
    }
};
