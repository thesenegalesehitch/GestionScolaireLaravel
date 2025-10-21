<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modèle Contact - Représente un contact bancaire de l'utilisateur
 * Permet de sauvegarder les destinataires fréquents pour les transferts
 */
class Contact extends Model
{
    /**
     * Attributs qui peuvent être assignés en masse
     * @var array
     */
    protected $fillable = [
        'user_id',     // ID de l'utilisateur propriétaire
        'first_name',  // Prénom du contact
        'last_name',   // Nom du contact
        'phone',       // Téléphone du contact
        'address',     // Adresse du contact
        'rib'          // RIB unique du contact
    ];

    /**
     * Attributs qui doivent être cachés lors de la sérialisation
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

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

    /**
     * Accesseur pour obtenir le nom complet
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Relation Many-to-One avec User
     * Un contact appartient à un utilisateur
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
