<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubtopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subtopics', function (Blueprint $table) {
            $table->bigInteger('id')->default(new Expression('UUID_SHORT()'))->primary();
            $table->bigInteger('owner_topic')->nullable();
            $table->string('title');
            $table->string('summary')->nullable();
            $table->timestamp('created_at')->default(new Expression('NOW()'));
            $table->timestamp('updated_at')->default(new Expression('NOW()'));

            $table
                ->foreign('owner_topic')
                ->references('id')
                ->on('topics')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subtopics');
    }
}
