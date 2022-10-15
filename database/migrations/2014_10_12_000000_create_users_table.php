<?php

use Illuminate\Database\Migrations\Migration;
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
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('national_code')->unique();
            $table->string('mobile')->unique();
            $table->timestamp('birthday_date')->nullable();
            $table->tinyInteger('sexuality')->comment('0 => male, 1 => female');
            $table->tinyInteger('soldiering_status')->comment('0 => no, 1 => yes');
            $table->string('email')->unique();
            $table->tinyInteger('status')->default(0)->comment('0 => active, 1 => inactive');
            $table->tinyInteger('user_type')->default(0)->comment('0 => user, 1 => admin ,manager =>2');
            $table->enum('role',  ['user', 'manager', 'admin'])->default('user');
            $table->text('image')->nullable();
            $table->string('user_name')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('verification_code')->nullable();
            $table->string('province')->nullable();
            $table->string('small_province')->nullable();
            $table->rememberToken();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
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
