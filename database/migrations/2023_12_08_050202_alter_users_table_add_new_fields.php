<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTableAddNewFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('uid', 45)->nullable()->after('id');
            $table->string('type', 45)->nullable()->after('uid');
            $table->string('email_otp', 10)->nullable()->after('email');
            $table->dateTime('email_otp_sent_datetime')->nullable()->after('email_otp');
            $table->string('mobile', 10)->nullable()->after('avatar');
            $table->string('mobile_otp', 10)->nullable()->after('mobile');
            $table->dateTime('mobile_otp_sent_datetime')->nullable()->after('mobile_otp');
            $table->dateTime('mobile_verify_at')->nullable()->after('mobile_otp');
            $table->integer("created_by")->nullable()->after('updated_at');
            $table->integer("updated_by")->nullable()->after('created_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('uid');
            $table->dropColumn('type');
            $table->dropColumn('email_otp');
            $table->dropColumn('email_otp_sent_datetime');
            $table->dropColumn('mobile');
            $table->dropColumn('mobile_otp');
            $table->dropColumn('mobile_otp_sent_datetime');
            $table->dropColumn('mobile_verify_at');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
    }
}
