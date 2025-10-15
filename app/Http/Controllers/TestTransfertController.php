<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TransfertController;

class TestTransfertController extends Controller
{
    public function simulate()
    {
        $request = Request::create('/transferts', 'POST', [
            'montant' => 100.50,
            'rib_source' => 'FR761234567890',
            'rib_destination' => 'FR760987654321',
        ]);

        $controller = new TransfertController();
        return $controller->store($request);
    }
}
