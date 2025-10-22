<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;

class Transfert extends Model
{
    protected $fillable = [
        'montant',
        'rib_source',
        'rib_destination',
        'user_id',
        'contact_name',
        'contact_email',
    ];

    protected $casts = [
        'montant' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function compteSource()
    {
        return Compte::where('rib', $this->rib_source)->first();
    }

    public function compteDestination()
    {
        return Compte::where('rib', $this->rib_destination)->first();
    }

    public function execute()
    {
        $source = $this->compteSource();
        $destination = $this->compteDestination();

        Log::info('Transfert execute - Source RIB: ' . $this->rib_source . ', Destination RIB: ' . $this->rib_destination);
        Log::info('Source account: ' . ($source ? 'Found (ID: ' . $source->id . ', Solde: ' . $source->solde . ')' : 'Not found'));
        Log::info('Destination account: ' . ($destination ? 'Found (ID: ' . $destination->id . ', Solde: ' . $destination->solde . ')' : 'Not found'));
        Log::info('Transfer amount: ' . $this->montant . ', Source user_id: ' . ($source ? $source->user_id : 'N/A') . ', Transfer user_id: ' . $this->user_id);

        if (!$source || !$destination) {
            Log::error('Transfert failed: Source or destination account not found');
            return false;
        }

        if ($source->user_id !== $this->user_id) {
            Log::error('Transfert failed: Source account does not belong to user');
            return false;
        }

        $sourceSolde = floatval($source->solde);
        $transferAmount = floatval($this->montant);

        Log::info('Balance check: Source solde ' . $sourceSolde . ' vs transfer amount ' . $transferAmount);

        if ($sourceSolde < $transferAmount) {
            Log::error('Transfert failed: Insufficient balance');
            return false;
        }

        $source->solde = $sourceSolde - $transferAmount;
        $source->save();

        $destination->solde = floatval($destination->solde) + $transferAmount;
        $destination->save();

        Log::info('Transfert successful: New source solde: ' . $source->solde . ', New destination solde: ' . $destination->solde);

        return true;
    }
}
