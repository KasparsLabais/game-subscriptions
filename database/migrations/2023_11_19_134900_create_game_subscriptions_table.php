<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('subscription_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->integer('price');
            $table->integer('duration');
            $table->string('duration_type')->default('month');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscription_packages');
    }
};