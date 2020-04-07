<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostnamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostnames', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tenant_id')->nullable();
            $table->string('fqdn')->unique();
            $table->timestamps();

            $table->foreign('tenant_id')->references('id')->on(app(App\Tenant::class)->getTable());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hostnames');
    }
}
