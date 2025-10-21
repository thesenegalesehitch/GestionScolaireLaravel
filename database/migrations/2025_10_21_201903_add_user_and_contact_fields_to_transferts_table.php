<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration pour ajouter les champs user_id, contact_name et contact_email à la table transferts
 * Permet d'associer les transferts aux utilisateurs et de stocker les informations des destinataires
 */
return new class extends Migration
{
    /**
     * Exécute la migration - Ajoute les nouvelles colonnes
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transferts', function (Blueprint $table) {
            // Clé étrangère vers la table users (cascade delete)
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->after('id');

            // Informations du destinataire (optionnelles)
            $table->string('contact_name')->nullable()->after('rib_destination');   // Nom du destinataire
            $table->string('contact_email')->nullable()->after('contact_name');    // Email du destinataire
        });
    }

    /**
     * Annule la migration - Supprime les colonnes ajoutées
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transferts', function (Blueprint $table) {
            // Supprime d'abord la clé étrangère
            $table->dropForeign(['user_id']);

            // Puis supprime les colonnes
            $table->dropColumn(['user_id', 'contact_name', 'contact_email']);
        });
    }
};
