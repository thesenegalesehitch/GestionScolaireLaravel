<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration pour ajouter le champ solde à la table comptes
 * Permet de stocker le solde actuel de chaque compte bancaire
 */
return new class extends Migration
{
    /**
     * Exécute la migration - Ajoute la colonne solde
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('comptes', function (Blueprint $table) {
            // Ajoute une colonne décimale pour le solde avec 15 chiffres dont 2 décimales
            $table->decimal('solde', 15, 2)->default(0)->after('user_id');
        });
    }

    /**
     * Annule la migration - Supprime la colonne solde
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comptes', function (Blueprint $table) {
            // Supprime la colonne solde
            $table->dropColumn('solde');
        });
    }
};
