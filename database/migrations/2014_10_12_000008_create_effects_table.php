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
        Schema::create('effects', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->integer('hp_change');
            $table->integer('dexterity_change');
            $table->integer('strength_change');
            $table->integer('luck_change');
            $table->integer('intelligence_change');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('effects');
    }
};
