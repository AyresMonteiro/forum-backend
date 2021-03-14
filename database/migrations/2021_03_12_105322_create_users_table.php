<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigInteger('id')->default(new Expression('UUID_SHORT()'))->primary();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('fullName');
            $table->string('picture')->nullable();
            $table->string('country');
            $table->date('birthday')->nullable();
            $table->timestamp('created_at')->default(new Expression('NOW()'));
            $table->timestamp('updated_at')->default(new Expression('NOW()'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
