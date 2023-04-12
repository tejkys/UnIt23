<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

class InvoicesController extends Controller
{
    public function updateInvoiceItems(Request $request)
    {
        $invoiceId = $request->id;
        $items = json_decode($request->items);
        $jsonString = '{
                      "winstrom": {
                        "@version": "1.0",
                        "faktura-prijata": [
                          {
                            "id": "'.$invoiceId.'",
                            "bezPolozek": false,
                            "polozkyFaktury@removeAll": true,
                            "polozkyFaktury": [

                            ]
                          }
                        ]
                      }
                    }';
        $objekt = json_decode($jsonString);
        foreach ($items as $item) {
            $polozka = (object)array(
                'mnozMj' => '1',
                'cenaMj' => $item->price, //here
                'typSzbDphK' => 'typSzbDph.dphOsv',
                'kopStred' => 'false',
                'stredisko' => $item->resort_id); //here
            $objekt->winstrom->{"faktura-prijata"}[0]->polozkyFaktury[] = $polozka;
        }
        $response = Http::withBody(json_encode($objekt), 'application/json')
            ->post(session('companyUrl') . "/faktura-prijata.json?authSessionId=" . session('authSessionId'));

        return $response;
    }
}
