<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barangays', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('address')->nullable();
        $table->string('contact_no')->nullable();
        $table->string('email')->nullable();
        $table->string('captain')->nullable();
        $table->string('secretary')->nullable();
        $table->string('logo')->nullable();
        $table->string('dry_seal')->nullable();
        $table->string('captain_signature')->nullable();
        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('barangays');
    }
};
