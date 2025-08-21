<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\BusinessTypeEnums;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('vendor_name')->nullable();
            $table->string('government_nin')->nullable();//photo
            $table->string('business_address')->nullable();
            $table->enum('business_type',BusinessTypeEnums::getCasesArray())->default(BusinessTypeEnums::INDIVIDUAL->value);
            $table->string('bank_account_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->boolean('is_active')->nullable()->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sellers');
    }
};
