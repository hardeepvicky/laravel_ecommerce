<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_logs', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->id();
            $table->string("from_name", 80);
            $table->string("from_email", 255);
            $table->string("to_name", 80);
            $table->string("to_email", 255);
            $table->string("subject", 80);
            $table->string("content_file", 255);
            $table->timestamps();
            $table->bigInteger("created_by")->nullable();            
            $table->index("created_by");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_logs');
    }
}
