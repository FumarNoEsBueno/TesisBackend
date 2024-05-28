<?php

namespace App\Http\Controllers;

use App\Models\compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $discos = DB::table('disco_duro')
            ->whereIn('id',$request->discos)
            ->whereNull('compra_id');

        if($discos->count() == 0) return response()->json("Discos duro/s no disponibles", 500);

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
        $discos->update(['compra_id' => $compra->id]);

        return response()->json($compra, 200);
    }

    public function get_all_compras(Request $request){
        $compras = Compra::with('discos')
            ->with('estado_compra')
            ->with('metodo_despacho')
            ->with('metodo_pago')
            ->get();

        return $compras;
    }
    public function get_compras_by_user_id(Request $request){
        $compras = Compra::where('users_id', $request->user()->id)
            ->with('discos')
            ->with('estado_compra')
            ->with('metodo_despacho')
            ->with('metodo_pago')
            ->get();

        return $compras;
    }
}
