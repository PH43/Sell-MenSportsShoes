<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('role_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('role_id')->references('id')->on('roles');
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
        // Schema::table('users_roles',function (Blueprint $table)
        // {
        //     $table->dropForeign('users_roles_user_id_foreign');
        //     $table->dropColumn('user_id');
        //     $table->dropForeign('users_roles_role_id_foreign');
        //     $table->dropColumn('role_id');
        // });
        Schema::dropIfExists('users_roles');
    }
}
