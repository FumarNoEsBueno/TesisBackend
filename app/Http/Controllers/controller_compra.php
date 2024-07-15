<?php

namespace App\Http\Controllers;

use App\Models\compra;
use App\Models\compra_cable;
use App\Models\disco_duro;
use App\Models\disco_duro_compra;
use App\Models\periferico;
use App\Models\periferico_compra;
use App\Models\ram_compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class controller_compra extends Controller
{
    public function compras(Request $request)
    {
        return DB::table('compra')
            ->where('compra_codigo','=',$request->codigo)
            ->join('disco_duro','disco_duro.compra_id','=','compra.id')
            ->get();
    }

    public function comprar(Request $request)
    {
        $disponibilidad = DB::table('disponibilidad')
            ->where('disponibilidad_nombre','=','Vendido')
            ->first();

        if($request->discos != []){
            $discos = DB::table('disco_duro')
                ->where('disponibilidad_id', '!=', $disponibilidad->id)
                ->whereIn('id',$request->discos);

            if($discos->count() != count($request->discos))
                return response()->json("Discos duro/s no disponibles", 500);
        }

        if($request->perifericos != []){
            $perifericos = DB::table('periferico')
                ->where('disponibilidad_id', '!=', $disponibilidad->id)
                ->whereIn('id',$request->perifericos);

            if($perifericos->count() != count($request->perifericos))
                return response()->json("Periferico no disponible", 500);
        }

        if($request->rams != []){
            $rams = DB::table('ram')
                ->where('disponibilidad_id', '!=', $disponibilidad->id)
                ->whereIn('id',$request->rams);

            if($rams->count() != count($request->rams))
                return response()->json("Ram/s no disponibles", 500);
        }

        if($request->cablesId != []){
            $cables = DB::table('cable')
                ->where('disponibilidad_id', '!=', $disponibilidad->id)
                ->whereIn('id',$request->cablesId);

            if($cables->count() != count($request->cablesId))
                return response()->json("Cables no disponibles", 500);
        }

        $despacho = DB::table('metodo_despacho')
            ->where('metodo_despacho_slug','=',$request->metodoDespacho)
            ->first();

        $pago = DB::table('metodo_pago')
            ->where('metodo_pago_slug','=',$request->metodoPago)
            ->first();

        $compra = new compra();

        $randomCode = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
        $compra->compra_codigo = $randomCode;
        $compra->compra_email = $request->user()->email;
        $compra->estado_compra_id = 1;
        $compra->direccion_id = $request->direccionId;
        $compra->metodo_despacho_id = $despacho->id;
        $compra->metodo_pago_id = $pago->id;
        $compra->users_id = $request->user()->id;

        $compra->save();

        if($request->discos != []){
            foreach($discos->get() as $disco){
                disco_duro_compra::create([
                    'disco_duro_id' => $disco->id,
                    'compra_id' => $compra->id
                ]);
            }
            $discos->update(['disponibilidad_id' => $disponibilidad->id]);
        }

        if($request->perifericos != []){
            foreach($perifericos->get() as $periferico){
                periferico_compra::create([
                    'periferico_id' => $periferico->id,
                    'compra_id' => $compra->id
                ]);
            }
            $perifericos->update(['disponibilidad_id' => $disponibilidad->id]);
        }

        if($request->rams != []){
            foreach($rams->get() as $ram){
                ram_compra::create([
                    'ram_id' => $ram->id,
                    'compra_id' => $compra->id
                ]);
            }
            $rams->update(['disponibilidad_id' => $disponibilidad->id]);
        }

        if($request->cablesId != []){
            $index = 0;
            foreach($cables->get() as $cable){
                compra_cable::create([
                    'compra_cable_cantidad' => $request->cablesCantidad[$index],
                    'cable_id' => $cable->id,
                    'compra_id' => $compra->id
                ]);
                $index++;
            }
        }

        return response()->json($compra, 200);
    }

    public function get_all_compras(Request $request){
        $compras = Compra::with('discos')
            ->with('perifericos')
            ->with('estado_compra')
            ->with('metodo_despacho')
            ->with('metodo_pago')
            ->latest()
            ->paginate(12);

        return $compras;
    }

    public function get_compras_by_user_id(Request $request){
        $compras = Compra::where('users_id', $request->user()->id)
            ->with('discos')
            ->with('perifericos')
            ->with('rams')
            ->with('cables')
            ->with('estado_compra')
            ->with('metodo_despacho')
            ->with('metodo_pago')
            ->latest()
            ->paginate(12);

        return $compras;
    }

    public function get_ventas_para_estadisticas(Request $request){
        $compras = Compra::
            with('discos')
            ->with('perifericos')
            ->with('rams')
            ->with('usuario')
            ->with('estado_compra')
            ->with('metodo_despacho')
            ->with('metodo_pago')
            ->get();

        return response()->json($compras, 200);
    }

}
