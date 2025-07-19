<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id', 12)->unique(); // 12-digit unique ID
            $table->string('name');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->unsignedTinyInteger('age');
            $table->string('company');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
