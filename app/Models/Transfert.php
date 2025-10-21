<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modèle Transfert - Représente un transfert d'argent entre comptes
 * Gère l'exécution des transferts avec vérification des soldes
 */
class Transfert extends Model
{
    /**
     * Attributs qui peuvent être assignés en masse
     * @var array
     */
    protected $fillable = [
        'montant',         // Montant du transfert
        'rib_source',      // RIB du compte source
        'rib_destination', // RIB du compte destination
        'user_id',         // ID de l'utilisateur effectuant le transfert
        'contact_name',    // Nom du destinataire (optionnel)
        'contact_email',   // Email du destinataire (optionnel)
    ];

    /**
     * Conversion automatique des types d'attributs
     * @var array
     */
    protected $casts = [
        'montant' => 'decimal:2', // Précision de 2 décimales pour les montants
    ];

    /**
     * Relation Many-to-One avec User
     * Un transfert appartient à un utilisateur
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Récupère le compte source du transfert
     * Recherche le compte par son RIB
     *
     * @return Compte|null
     */
    public function compteSource()
    {
        return Compte::where('rib', $this->rib_source)->first();
    }

    /**
     * Récupère le compte destination du transfert
     * Recherche le compte par son RIB
     *
     * @return Compte|null
     */
    public function compteDestination()
    {
        return Compte::where('rib', $this->rib_destination)->first();
    }

    /**
     * Exécute le transfert d'argent
     * Vérifie les soldes et effectue les opérations de débit/crédit
     *
     * @return bool True si le transfert a réussi, false sinon
     */
    public function execute()
    {
        $source = $this->compteSource();
        $destination = $this->compteDestination();

        // Vérifie que les comptes existent et que le retrait est possible
        if ($source && $destination && $source->retirer($this->montant)) {
            $destination->deposer($this->montant);
            return true;
        }

        return false; // Échec du transfert
    }
}
