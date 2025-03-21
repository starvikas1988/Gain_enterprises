<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
    **/
    public function up()
    {
        Schema::create('admins_role', function (Blueprint $table) {
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('role_id');

            $table->primary(['admin_id','role_id']);

            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
    **/
    public function down()
    {
        Schema::dropIfExists('admins_role');
    }
}
