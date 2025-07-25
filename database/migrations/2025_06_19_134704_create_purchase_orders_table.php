<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('site_id')

                  ->constrained('sites')
                  ->cascadeOnDelete();
        $table->string('order_number')->unique();

            $table->date('order_date');
            $table->string('supplier_name');
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->enum('status', ['To Order','Ordered','Received'])
                  ->default('To Order');
            $table->date('delivery_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
