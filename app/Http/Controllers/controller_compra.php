<?php

namespace App\Http\Controllers;

use App\Models\compra;
use Illuminate\Http\Request;
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

        $compra = new compra();
        $randomCode = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
        $compra->compra_codigo = $randomCode;
        $compra->compra_email = "Emal de testeo";
        $compra->compra_direccion = "Dirección de testeo";
        $compra->metodo_despacho_id = 1;
        $compra->metodo_pago_id = 1;

        $compra->save();

        $discos->update(['compra_id' => $compra->id]);

        return response()->json($compra, 200);
    }
}
