<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany; // Import pour la relation

/**
 * Modèle User - Représente un utilisateur de l'application bancaire
 * Gère l'authentification et les relations avec comptes et transferts
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * Attributs qui peuvent être assignés en masse lors de la création/modification
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',     // Nom de l'utilisateur
        'email',    // Adresse email (unique)
        'password', // Mot de passe hashé
    ];

    /**
     * The attributes that should be hidden for serialization.
     * Attributs cachés lors de la sérialisation (API, JSON)
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',        // Ne jamais exposer le mot de passe
        'remember_token',  // Token de connexion persistante
    ];

    /**
     * Get the attributes that should be cast.
     * Conversion automatique des types d'attributs
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Conversion en objet DateTime
            'password' => 'hashed',           // Hash automatique des mots de passe
        ];
    }

    /**
     * Get the accounts (comptes) associated with the user.
     * Relation One-to-Many : Un utilisateur peut avoir plusieurs comptes bancaires
     *
     * @return HasMany
     */
    public function comptes(): HasMany
    {
        return $this->hasMany(Compte::class);
    }

    /**
     * Get the transfers (transferts) associated with the user.
     * Relation One-to-Many : Un utilisateur peut effectuer plusieurs transferts
     *
     * @return HasMany
     */
    public function transferts(): HasMany
    {
        return $this->hasMany(Transfert::class);
    }

    /**
     * Get the contacts (contacts) associated with the user.
     * Relation One-to-Many : Un utilisateur peut avoir plusieurs contacts
     *
     * @return HasMany
     */
    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }
}
