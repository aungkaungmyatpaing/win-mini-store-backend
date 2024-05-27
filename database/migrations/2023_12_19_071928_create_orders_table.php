<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->string('payment_photo')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('sub_total')->nullable();
            $table->foreignId('region_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->string('delivery_fee')->nullable();
            $table->foreignId('deli_fee_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->string('grand_total')->nullable();
            $table->text('cancel_message')->nullable();
            $table->string('refund_date')->nullable();
            $table->text('refund_message')->nullable();
            $table->string('refund_image')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
