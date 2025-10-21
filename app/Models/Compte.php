<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modèle Compte - Représente un compte bancaire
 * Gère les opérations de dépôt et retrait avec vérification des soldes
 */
class Compte extends Model
{
    /**
     * Attributs qui peuvent être assignés en masse
     * @var array
     */
    protected $fillable = [
        'rib',      // Relevé d'Identité Bancaire (numéro unique du compte)
        'user_id',  // ID de l'utilisateur propriétaire
        'solde'     // Solde actuel du compte
    ];

    /**
     * Conversion automatique des types d'attributs
     * @var array
     */
    protected $casts = [
        'solde' => 'decimal:2', // Précision de 2 décimales pour les montants
    ];

    /**
     * Relation Many-to-One avec User
     * Un compte appartient à un utilisateur
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Effectuer un dépôt sur le compte
     * Ajoute le montant au solde existant
     *
     * @param float $montant Montant à déposer (doit être positif)
     * @return void
     */
    public function deposer($montant)
    {
        $this->solde += $montant;
        $this->save();
    }

    /**
     * Effectuer un retrait du compte
     * Soustrait le montant du solde si suffisant
     *
     * @param float $montant Montant à retirer
     * @return bool True si le retrait a réussi, false sinon
     */
    public function retirer($montant)
    {
        if ($this->solde >= $montant) {
            $this->solde -= $montant;
            $this->save();
            return true;
        }
        return false; // Solde insuffisant
    }

    /**
     * Génère un RIB unique au format SN-XXXXXX
     * @return string
     */
    public static function generateUniqueRib()
    {
        do {
            $rib = 'SN-' . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (self::where('rib', $rib)->exists());

        return $rib;
    }
}
