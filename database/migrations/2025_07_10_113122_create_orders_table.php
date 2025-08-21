<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\OrderEnums;
use App\Enums\PaymentMethodEnums;
use App\Enums\PaymentStatusEnums;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('total_price',10,2)->default(0);
            $table->text('shipping_address')->nullable();
            $table->string('phone')->nullable();
            $table->string('payment_reference')->nullable()->unique();
            $table->text('notes')->nullable();//for extra delivery info
            $table->enum('status', OrderEnums::getCasesArray())->default(OrderEnums::PENDING->value);
            $table->enum('payment_method',PaymentMethodEnums::getCasesArray())->default(PaymentMethodEnums::CASH->value);
            $table->enum('payment_status',PaymentStatusEnums::getCasesArray())->default(PaymentStatusEnums::FAILED->value);
            $table->date('delivery_date')->nullable();
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
