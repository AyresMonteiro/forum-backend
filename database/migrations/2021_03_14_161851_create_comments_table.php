<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigInteger('uuid')->default(new Expression('UUID_SHORT()'))->primary();
            $table->bigInteger('owner_post');
            $table->bigInteger('owner_user');
            $table->text('body');
            $table->timestamp('created_at')->default(new Expression('NOW()'));
            $table->timestamp('updated_at')->default(new Expression('NOW()'));
        });

        $table
            ->foreign('owner_post')
            ->references('uuid')
            ->on('posts')
            ->onDelete('set null')
            ->onUpdate('cascade');

        $table
            ->foreign('owner_user')
            ->references('uuid')
            ->on('users')
            ->onDelete('set null')
            ->onUpdate('cascade');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
