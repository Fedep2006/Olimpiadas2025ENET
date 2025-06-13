<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preferencia;

class PreferenciasController extends Controller
{
    public function buscar(Request $request)
    {
        // Arranca la query de Preferencia
        $query = Preferencia::query();

        // 1) Búsqueda general por nombre o descripción
        if ($term = $request->input('q')) {
            $query->where(function($qb) use ($term) {
                $qb->where('nombre', 'LIKE', "%{$term}%")
                   ->orWhere('descripcion', 'LIKE', "%{$term}%");
            });
        }

        // 2) Filtros avanzados
        if ($origin = $request->input('origin')) {
            $query->where('origen', 'LIKE', "%{$origin}%");
        }

        if ($destination = $request->input('destination')) {
            $query->where('destino', 'LIKE', "%{$destination}%");
        }

        if ($checkin = $request->input('checkin')) {
            $query->whereDate('fecha_entrada', '>=', $checkin);
        }

        if ($checkout = $request->input('checkout')) {
            $query->whereDate('fecha_salida', '<=', $checkout);
        }

        if ($guests = $request->input('guests')) {
            $query->where('max_huespedes', '>=', intval($guests));
        }

        if (null !== $priceMin = $request->input('price_min')) {
            $query->where('precio', '>=', floatval($priceMin));
        }

        if (null !== $priceMax = $request->input('price_max')) {
            $query->where('precio', '<=', floatval($priceMax));
        }

        // 3) Ejecuta la consulta y ordena
        $results = $query->orderBy('nombre')->get();

        // 4) Devuelve la vista con resultados
        return view('preferencias.results', [
            'results' => $results,
            'q'       => $term,
        ]);
    }
}
