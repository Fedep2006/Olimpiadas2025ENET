<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Viaje;
use App\Models\Hospedaje;
use App\Models\Vehiculo;
use App\Models\Paquete;

class ResultsController extends Controller
{
    public function index(Request $request)
    {
        // Parámetros
        $search      = $request->query('search');
        $origin      = $request->query('origin');
        $destination = $request->query('destination');
        $checkin     = $request->query('checkin');
        $checkout    = $request->query('checkout');
        $guests      = $request->query('guests');
        $priceMin    = $request->query('price_min');
        $priceMax    = $request->query('price_max');
        $sort        = $request->query('sort'); // si implementas orden

        // Construir querybuilders
        $viajes     = Viaje::query();
        $hospedajes = Hospedaje::query();
        $vehiculos  = Vehiculo::query();
        $paquetes   = Paquete::query();

        // 1) Búsqueda libre
        if ($search) {
            $viajes->where('nombre', 'like', "%{$search}%");
            $hospedajes->where('nombre', 'like', "%{$search}%");
            $vehiculos->where(function($q) use ($search) {
                $q->where('marca','like',"%{$search}%")
                  ->orWhere('modelo','like',"%{$search}%");
            });
            $paquetes->where('nombre', 'like', "%{$search}%");
        }

        // 2) Filtros avanzados para viajes
        if ($origin)      $viajes->where('origen', 'like', "%{$origin}%");
        if ($destination) $viajes->where('destino','like', "%{$destination}%");

        // Filtro por fechas para viajes
        if ($checkin && $checkout) {
            // Ambos campos completos: filtrar entre ambos
            $viajes->whereDate('fecha_salida', '>=', $checkin)
                   ->whereDate('fecha_llegada', '<=', $checkout);
        } elseif ($checkin) {
            // Solo entrada: SOLO los de esa fecha exacta de salida
            $viajes->whereDate('fecha_salida', '=', $checkin);
        } elseif ($checkout) {
            // Solo salida: SOLO los de esa fecha exacta de llegada
            $viajes->whereDate('fecha_llegada', '=', $checkout);
        }

        // --- Nuevo: filtrar hospedajes por ciudad de destino ---
        if ($destination) {
            $hospedajes->where('ciudad', 'like', "%{$destination}%");
        }

        // Filtros avanzados para hospedajes por fechas y huéspedes
        if ($checkin)     $hospedajes->whereDate('check_in','>=',$checkin);
        if ($checkout)    $hospedajes->whereDate('check_out','<=',$checkout);
        if ($guests)      $hospedajes->where('estrellas','>=',intval($guests));

        // Filtros de precio
        if (! is_null($priceMin)) {
            $viajes->where('precio_base','>=',$priceMin);
            $hospedajes->where('precio_noche','>=',$priceMin);
            $vehiculos->where('precio_por_dia','>=',$priceMin);
            $paquetes->where('precio_total','>=',$priceMin);
        }
        if (! is_null($priceMax)) {
            $viajes->where('precio_base','<=',$priceMax);
            $hospedajes->where('precio_noche','<=',$priceMax);
            $vehiculos->where('precio_por_dia','<=',$priceMax);
            $paquetes->where('precio_total','<=',$priceMax);
        }

        // 3) Ordenación (opcional)
        if ($sort === 'price_asc') {
            $viajes->orderBy('precio_base','asc');
            $hospedajes->orderBy('precio_noche','asc');
            $vehiculos->orderBy('precio_por_dia','asc');
            $paquetes->orderBy('precio_total','asc');
        } elseif ($sort === 'price_desc') {
            $viajes->orderBy('precio_base','desc');
            $hospedajes->orderBy('precio_noche','desc');
            $vehiculos->orderBy('precio_por_dia','desc');
            $paquetes->orderBy('precio_total','desc');
        }

        // Ejecutar consultas con orden por defecto si no se aplicó sort
        $results = [
            'viajes'     => $viajes->get(),
            'hospedajes' => $hospedajes->get(),
            'vehiculos'  => $vehiculos->get(),
            'paquetes'   => $paquetes->get(),
        ];

        // Retornar la vista results.blade.php
        return view('results', array_merge(
            ['results' => $results],
            compact('search','origin','destination','checkin','checkout','guests','priceMin','priceMax','sort')
        ));
    }
}
