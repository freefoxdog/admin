<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->increments('id',0);
             $table->string('name',255);
             $table->string('password',255);
             $table->string('remember_token',255)->default('');
             $table->string('pic',512)->default('');
             $table->tinyinteger('id_ype',0)->default(2);//2普通管理员
             $table->integer('created_at',0)->nullable();
             $table->integer('updated_at',0)->nullable();
             $table->integer('deleted_at',0)->nullable()->default(null);
             $table->engine = 'Innodb';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_users');
    }
}
