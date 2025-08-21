<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\CurrencyEnums;
use App\Enums\PaymentMethodEnums;
use App\Enums\PaymentGatewayEnums;
use App\Enums\PaymentStatusEnums;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2)->default(0);
            $table->enum('currency', CurrencyEnums::getCasesArray())->default(CurrencyEnums::NGN->value);
            $table->string('payment_reference')->unique(); // from Paystack
            $table->enum('payment_status', PaymentStatusEnums::getCasesArray())->default(PaymentStatusEnums::FAILED->value);
            $table->enum('payment_method', PaymentMethodEnums::getCasesArray())->default(PaymentMethodEnums::CASH->value);
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
