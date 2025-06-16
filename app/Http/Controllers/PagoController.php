<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Pagos;

class PagoController extends Controller
{
    public function storeFicticio(Request $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);

        $data = $request->validate([
            'reserva_id'       => 'required|exists:reservas,id',
            'cardholder_name'  => 'required|string|max:255',
            'card_number'      => 'required|digits_between:13,19',
            'expiration_month' => 'required|digits:2',
            'expiration_year'  => 'required|digits:4',
            'cvv'              => 'required|digits_between:3,4',
        ]);

        $data['vehiculo_id'] = $vehiculo->id;
        $data['amount']      = $vehiculo->precio_por_dia;

        Pagos::create($data);

        return redirect()
            ->route('vehiculos.show', $vehiculo->id)
            ->with('status', 'Pago (ficticio) y reserva vinculada correctamente.');
    }
}
