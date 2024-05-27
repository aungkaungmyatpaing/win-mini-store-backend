<?php

use App\Models\Address;
use App\Models\Customer;
use App\Models\PaymentAccount;
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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customer::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('address_id');
            $table->boolean('cod')->default(true);
            $table->unsignedInteger('payment_account_id')->nullable();
            $table->unsignedInteger('total');
            $table->unsignedInteger('grand_total');
            $table->decimal('order_time_exchange_rate',10,4);
            $table->unsignedInteger('grand_total_exchange');
            $table->enum('status', ['pending', 'confirmed', 'delivered', 'completed', 'cancelled'])->default('pending');
            $table->string('note');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
