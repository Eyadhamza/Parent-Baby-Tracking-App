<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('parent_users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('name');
            $table->foreignId('partner_id')
                ->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('parent_users');
    }
};
