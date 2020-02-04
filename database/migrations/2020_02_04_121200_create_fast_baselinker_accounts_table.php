<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Ramsey\Uuid\Uuid;

class CreateFastBaselinkerAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fast_baselinker_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('owner_uuid', 36)->index();
            $table->string('uuid', 36)->index();

            $table->string('name');
            $table->string('api_token');

            $table->softDeletes();
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
        Schema::dropIfExists('fast_baselinker_accounts');
    }
}
