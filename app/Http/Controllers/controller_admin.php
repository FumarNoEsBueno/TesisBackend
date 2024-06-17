<?php

namespace App\Http\Controllers;

use App\Models\compra;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class controller_admin extends Controller
{
    public function update_estado_compra(Request $request)
    {
        $response = Compra::where('id', $request->compraId)
            ->with('discos')
            ->with('estado_compra')
            ->with('metodo_despacho')
            ->with('metodo_pago');
        $response->update(['estado_compra_id' => $request->estadoId]);
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
