<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigInteger('id')->default(new Expression('UUID_SHORT()'))->primary();
            $table->bigInteger('owner_subtopic')->nullable();
            $table->bigInteger('owner_user')->nullable();
            $table->string('title');
            $table->text('body')->nullable();
            $table->timestamp('created_at')->default(new Expression('NOW()'));
            $table->timestamp('updated_at')->default(new Expression('NOW()'));

            $table
                ->foreign('owner_subtopic')
                ->references('id')
                ->on('subtopics')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table
                ->foreign('owner_user')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('posts');
    }
}
