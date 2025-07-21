<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id', 13)->unique(); // Now 13 digits as per latest request
           
            $table->enum('gender', ['Male', 'Female', 'Other']);
            
           

            // 🆕 Newly added fields
            $table->year('year')->nullable();
            $table->unsignedTinyInteger('month')->nullable();
            $table->unsignedTinyInteger('day')->nullable();
            $table->string('county')->nullable();
            $table->string('registration_code')->nullable();
            $table->string('control_code')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
