<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVerifiedAtToTrustSealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trust_seals', function (Blueprint $table) {
            $table->timestamp('verified_at')->nullable()->after('qr_code_path'); // Add 'verified_at' column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trust_seals', function (Blueprint $table) {
            $table->dropColumn('verified_at'); // Drop the 'verified_at' column on rollback
        });
    }
}