<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bestellingens', function (Blueprint $table) {
            $table->id();
            $table->string("firstname");
            $table->string("prefix")->nullable();
            $table->string("lastname");
            $table->string("email");
            $table->string("phonenumber");
            $table->string("adress");
            $table->string("housenumber");
            $table->string("residence");
            $table->string("postalcode");
            $table->integer("archived")->default(0);
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
        Schema::dropIfExists('bestellingens');
    }
};
