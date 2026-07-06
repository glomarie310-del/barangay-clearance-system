<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('business_clearances', function (Blueprint $table) {
        $table->id();
        $table->foreignId('barangay_id')->constrained()->cascadeOnDelete();
        $table->string('clearance_no')->unique();

        $table->string('applicant_name');
        $table->string('applicant_address');

        $table->string('business_name');
        $table->string('business_type')->nullable();
        $table->string('business_address');

        $table->string('purpose')->default('Business Permit');
        $table->date('issued_date');

        $table->string('or_number')->nullable();
        $table->decimal('amount_paid', 8, 2)->nullable();

        $table->string('status')->default('Issued');
        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_clearances');
    }
};