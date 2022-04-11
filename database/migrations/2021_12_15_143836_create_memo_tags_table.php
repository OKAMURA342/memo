<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemoTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memo_tag', function (Blueprint $table) {
                $table->unsignedBigInteger('memo_id');
                $table->unsignedBigInteger('tagu_id');
                $table->primary(['memo_id','tagu_id']);
                
                // 外部キー制約
                $table->foreign('memo_id')->references('id')->on('memo')->onDelete('cascade');
                $table->foreign('tagu_id')->references('tagu_id')->on('tags')->onDelete('cascade');
            });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memo_tags');
    }
}
