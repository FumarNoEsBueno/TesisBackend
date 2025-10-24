<?php

namespace App\Http\Controllers;

use App\Models\direccion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class controller_user extends Controller
{
    public function get_provincias_por_region(Request $request)
    {
        return DB::table('provincia')
            ->where('id','=',$request->id)
            ->get();
    }

    public function get_ciudades_por_provincia(Request $request)
    {
        return DB::table('ciudad')
            ->where('id','=',$request->id)
            ->get();
    }

    public function get_region(Request $request)
    {
        return DB::table('region')->get();
    }

    public function delete_direccion(Request $request)
    {

        $direccion = DB::table('direccion')
            ->where('id','=',$request->id)
            ->delete();

        return $direccion;
    }

    public function create_direccion(Request $request)
    {
        $direccion = direccion::create([
            'direccion_nombre' => $request->calle_nombre,
            'ciudad_id' => $request->id,
            'user_id' => $request->user()->id,
        ]);

        return $direccion;
    }

    public function get_direcciones_by_users(Request $request)
    {
        $direcciones = DB::table('direccion')
            ->where('user_id','=',$request->user()->id)
            ->join('ciudad','ciudad.id','=','direccion.ciudad_id')
            ->join('provincia','provincia.id','=','ciudad.provincia_id')
            ->join('region','region.id','=','provincia.region_id')
            ->select('direccion.id',
                'direccion.direccion_nombre',
                'ciudad.ciudad_nombre',
                'provincia.provincia_nombre',
                'region.region_nombre'
                )->get();
        return $direcciones;
    }

    public function revoke_token(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json("Token revocado correctamente", 200);
    }


    public function register(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'password' => bcrypt($request->password),
        ]);

        return response()->json("Cuenta registrada correctamente", 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json($user);
        }
        
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function checkLogin(Request $request)
    {
        return response()->json([
            'id' => $request->user()->id,
            'name' => $request->user()->name,
            'email' => $request->user()->email
        ]);
    }


    public function update_password(Request $request)
    {
        $users = DB::table('users')
            ->where('id','=', $request->user()->id);
        return bcrypt($request->actual);

        if(bcrypt($request->actual) != $users->first()->password){
            return response()->json("Contraseña mal proporcionada", 500);
        }
        $users->update(['password' => bcrypt($request->contreasena_nueva)]);

        return response()->json("Contraseña cambiada correctamente", 200);
    }

    public function get_all_roles(Request $request)
    {
        return DB::table('rol')->get();
    }
}
