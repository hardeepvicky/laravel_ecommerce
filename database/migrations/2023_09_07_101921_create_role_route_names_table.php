<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleRouteNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_route_names', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->id();
            $table->bigInteger("role_id");
            $table->bigInteger("route_name_id");
            $table->timestamps();
            $table->bigInteger("created_by")->nullable();
            $table->bigInteger("updated_by")->nullable();
            $table->index('role_id');            
            $table->index('route_name_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_route_names');
    }
}
