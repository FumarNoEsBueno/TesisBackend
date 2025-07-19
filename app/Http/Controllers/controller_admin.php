<?php

namespace App\Http\Controllers;

use App\Mail\EstadoCompraActualizado;
use App\Mail\Mailablee;
use App\Models\Cable;
use App\Models\Compra;
use App\Models\Compra_cable;
use App\Models\DiscoDuro;
use App\Models\EstadoCompra;
use App\Models\Periferico;
use App\Models\Ram;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Throwable;

class controller_admin extends Controller
{
    public function update_estado_compra(Request $request)
    {
        $estado = EstadoCompra::where('id','=',$request->estadoId)
            ->first();

        $disponibilidad = DB::table('disponibilidad')
            ->where('disponibilidad_nombre','=','En bodega')
            ->first();

        $response = Compra::where('id', $request->compraId)
            ->with('usuario')
            ->with('discos')
            ->with('estado_compra')
            ->with('metodo_despacho')
            ->with('metodo_pago');

        $response->update(['estado_compra_id' => $request->estadoId]);

        if($estado->estado_compra_nombre == 'Entregado' ||
            $estado->estado_compra_nombre == 'Retirado'){
            $response->update(['compra_garantia' => Carbon::now()->addMonth()]);
        }

        if($estado->estado_compra_slug = 'cancelado'){

            DiscoDuro::whereHas('compras', function($query) use ($request) {
                $query->where('compra.id', $request->compraId);
            })->update(['disponibilidad_id' => $disponibilidad->id]);

            Periferico::whereHas('compras', function($query) use ($request) {
                $query->where('compra.id', $request->compraId);
            })->update(['disponibilidad_id' => $disponibilidad->id]);

            Ram::whereHas('compras', function($query) use ($request) {
                $query->where('compra.id', $request->compraId);
            })->update(['disponibilidad_id' => $disponibilidad->id]);

            $cable = Cable::
                join('compra_cable','compra_cable.cable_id','cable.id')
                ->join('compra','compra.id','compra_cable.compra_id')
                ->where('compra.id', $request->compraId);

            $cable->update(['cable_cantidad' => DB::raw("`compra_cable_cantidad` + `cable_cantidad`")]);
        }

        $data = [
            'nombre' => $response->first()->usuario->name,
            'codigo' => $response->first()->compra_codigo,
            'estado' => $estado->estado_compra_nombre,
        ];

        Mail::to($response->first()->usuario->email)->send(new EstadoCompraActualizado($data));

        return response()->json($response->first(), 200);

    }

    public function set_producto(Request $request)
    {
        switch($request->tipoProducto){
            case ("disco"):
                $response = DB::table('disco_duro')->where('id', $request->id)->first();
                if ($response) {
                    DB::table('disco_duro')
                        ->where('id', $request->id)
                        ->update(['disco_duro_destacado' => $request->destacado,'disco_duro_descuento' => $request->descuento]);
                }
            break;
            case ("ram"):
                $response = DB::table('ram')->where('id', $request->id)->first();
                if ($response) {
                    DB::table('ram')
                        ->where('id', $request->id)
                        ->update(['ram_destacado' => $request->destacado,'ram_descuento' => $request->descuento]);
                }
            break;
            case ("periferico"):
                $response = DB::table('periferico')->where('id', $request->id)->first();
                if ($response) {
                    DB::table('periferico')
                        ->where('id', $request->id)
                        ->update(['periferico_destacado' => $request->destacado,'periferico_descuento' => $request->descuento]);
                }
            break;
            case ("cable"):
                $response = DB::table('cable')->where('id', $request->id)->first();
                if ($response) {
                    DB::table('cable')
                        ->where('id', $request->id)
                        ->update(['cable_destacado' => $request->destacado,'cable_descuento' => $request->descuento]);
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

        $s = $request->user();

        if(!$users->trabajador) return response()->json("Credenciales no validas", 500);

        $token = $users->createToken('auth-token');
        $token->expires_at = Carbon::now()->addWeeks(1);

        $tokenResult = $token->accessToken;

        return response()->json(
            $tokenResult,
        );
    }

    public function check_admin_login(Request $request)
    {
        $users = $request->user();

        if(!$users->trabajador) return response()->json("Usuarion sin permisos", 500);
        return response()->json($request->user());
    }

    public function create_users(Request $request)
    {
        $users = DB::table('users')->insert([
            'name' => $request->name,
            'number' => $request->number,
            'email' => $request->email,
            'trabajador' => true,
            'password' => bcrypt('password'),
        ]);

        return response()->json($request->user());
    }


    public function enviarCorreo()
    {
        $data = [
            'nombre' => 'Juan Pérez',
        ];

        Mail::to('marcelo.murillo1701@alumnos.ubiobio.cl')->send(new Mailablee($data));

        return response()->json("Wena los k", 200);
    }

}
