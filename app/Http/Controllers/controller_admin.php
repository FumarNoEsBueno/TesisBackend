<?php

namespace App\Http\Controllers;

use App\Models\cable;
use App\Models\compra;
use App\Models\disco_duro;
use App\Models\model_estado_compra;
use App\Models\periferico;
use App\Models\ram;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class controller_admin extends Controller
{
    public function update_estado_compra(Request $request)
    {
        $estado = model_estado_compra::where('id','=',$request->estadoId)
            ->first();

        $disponibilidad = DB::table('disponibilidad')
            ->where('disponibilidad_nombre','=','En bodega')
            ->first();

        $response = Compra::where('id', $request->compraId)
            ->with('discos')
            ->with('estado_compra')
            ->with('metodo_despacho')
            ->with('metodo_pago');

        $response->update(['estado_compra_id' => $request->estadoId]);

        if($estado->estado_compra_slug = 'cancelado'){

            disco_duro::whereHas('compras', function($query) use ($request) {
                $query->where('compra.id', $request->compraId);
            })->update(['disponibilidad_id' => $disponibilidad->id]);

            periferico::whereHas('compras', function($query) use ($request) {
                $query->where('compra.id', $request->compraId);
            })->update(['disponibilidad_id' => $disponibilidad->id]);

            ram::whereHas('compras', function($query) use ($request) {
                $query->where('compra.id', $request->compraId);
            })->update(['disponibilidad_id' => $disponibilidad->id]);

        }

        return response()->json($response->first(), 200);
    }

    public function set_producto(Request $request)
    {
        switch($request->tipoProducto){
            case ("disco"):
                $response = DB::table('disco_duro')->where('id', $request->id)->first();
                if ($response) {
                    $response->descuento_id = $request->descuentoId;
                    DB::table('disco_duro')->where('id', $request->id)->update(['descuento_id' => $request->descuentoId]);
                }
            break;
            case ("ram"):
                $response = DB::table('ram')->where('id', $request->id)->first();
                if ($response) {
                    $response->descuento_id = $request->descuentoId;
                    DB::table('ram')->where('id', $request->id)->update(['descuento_id' => $request->descuentoId]);
                }
            break;
            case ("periferico"):
                $response = DB::table('periferico')->where('id', $request->id)->first();
                if ($response) {
                    $response->descuento_id = $request->descuentoId;
                    DB::table('periferico')->where('id', $request->id)->update(['descuento_id' => $request->descuentoId]);
                }
            break;
            case ("cable"):
                $response = DB::table('cable')->where('id', $request->id)->first();
                if ($response) {
                    $response->descuento_id = $request->descuentoId;
                    DB::table('cable')->where('id', $request->id)->update(['descuento_id' => $request->descuentoId]);
                }
            break;
        }
        return response()->json($response, 200);
    }

    public function get_descuentos(Request $request)
    {
        return DB::table('descuento')->get();
    }

    public function admin_login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        if(!Auth::attempt($credentials)) return response()->json("Credenciales no validas", 500);

        $user = $request->user();

        if(!$user->admin_privilegies) return response()->json("Credenciales no validas", 500);

        $token = $user->createToken('auth-token');
        $token->expires_at = Carbon::now()->addWeeks(1);

        $tokenResult = $token->accessToken;

        return response()->json(
            $tokenResult,
        );
    }

    public function check_admin_login(Request $request)
    {
        $user = $request->user();

        if(!$user->admin_privilegies) return response()->json("Usuarion sin permisos", 500);
        return response()->json($request->user());
    }
}
