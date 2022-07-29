<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('baby_parent_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('baby_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('parent_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('baby_parent_user');
    }
};
