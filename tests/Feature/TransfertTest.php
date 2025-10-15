<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Transfert;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransfertTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_transfert_peut_etre_cree()
    {
        $data = [
            'montant' => 250.75,
            'rib_source' => 'FR760000111122223333',
            'rib_destination' => 'FR761111222233334444',
        ];

        $response = $this->postJson('/transferts', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'montant' => 250.75,
                     'rib_source' => 'FR760000111122223333',
                 ]);

        $this->assertDatabaseHas('transferts', [
            'montant' => 250.75,
            'rib_source' => 'FR760000111122223333',
        ]);
    }
}
