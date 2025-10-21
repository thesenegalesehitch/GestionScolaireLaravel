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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Propriétaire du contact
            $table->string('first_name'); // Prénom du contact
            $table->string('last_name'); // Nom du contact
            $table->string('phone')->nullable(); // Téléphone du contact
            $table->text('address')->nullable(); // Adresse du contact
            $table->string('rib')->unique(); // RIB unique du contact (format: SN-XXXXXX)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
