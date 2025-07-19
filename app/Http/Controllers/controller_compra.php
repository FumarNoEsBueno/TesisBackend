<?php

namespace App\Http\Controllers;

use App\Mail\AgradecimientoTrans;
use App\Mail\GraciasPorComprar;
use App\Mail\Mailablee;
use App\Models\Cable;
use App\Models\Compra;
use App\Models\Compra_cable;
use App\Models\DiscoDuro;
use App\Models\DiscoDuroCompra;
use App\Models\Periferico;
use App\Models\PerifericoCompra;
use App\Models\RamCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Event\Code\Throwable;
use stdClass;
use Throwable as GlobalThrowable;

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
try{
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

        if($request->ram!= []){
            $ram= DB::table('ram')
                ->where('disponibilidad_id', '!=', $disponibilidad->id)
                ->whereIn('id',$request->ram);

            if($ram->count() != count($request->ram))
                return response()->json("Ram/s no disponibles", 500);
        }

        if($request->cablesId != []){
            $cable = DB::table('cable')
                ->where('disponibilidad_id', '!=', $disponibilidad->id)
                ->whereIn('id',$request->cablesId);

            if($cable->count() != count($request->cablesId))
                return response()->json("cable no disponibles", 500);
        }

        $despacho = DB::table('metodo_despacho')
            ->where('metodo_despacho_slug','=',$request->metodoDespacho)
            ->first();

        $pago = DB::table('metodo_pago')
            ->where('metodo_pago_slug','=',$request->metodoPago)
            ->first();

        $compra = new compra();

        $randomCode = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'), 0, 6);
        $compra->compra_codigo = $randomCode;
        $compra->compra_costo = $request->costoTotal;
        $compra->compra_email = $request->user()->email;
        $compra->estado_compra_id = 1;
        $compra->direccion_id = $request->direccionId;
        $compra->metodo_despacho_id = $despacho->id;
        $compra->metodo_pago_id = $pago->id;
        $compra->user_id = $request->user()->id;

        $compra->save();

        if($request->discos != []){
            foreach($discos->get() as $disco){
                disco_duro_compra::create([
                    'disco_duro_id' => $disco->id,
                    'disco_duro_compra_descuento' => $disco->disco_duro_descuento,
                    'compra_id' => $compra->id
                ]);
            }
            $discos->update(['disponibilidad_id' => $disponibilidad->id]);
        }

        if($request->perifericos != []){
            foreach($perifericos->get() as $periferico){
                periferico_compra::create([
                    'periferico_id' => $periferico->id,
                    'periferico_compra_descuento' => $periferico->periferico_descuento,
                    'compra_id' => $compra->id
                ]);
            }
            $perifericos->update(['disponibilidad_id' => $disponibilidad->id]);
        }

        if($request->ram!= []){
            foreach($ram->get() as $ram){
                ram_compra::create([
                    'ram_id' => $ram->id,
                    'ram_compra_descuento' => $ram->ram_descuento,
                    'compra_id' => $compra->id
                ]);
            }
            $ram->update(['disponibilidad_id' => $disponibilidad->id]);
        }

        if($request->cablesId != []){
            $index = 0;
            foreach($cable->get() as $cable){
                compra_Cable::create([
                    'compra_cable_cantidad' => $request->cablesCantidad[$index],
                    'cable_id' => $cable->id,
                    'compra_cable_descuento' => $cable->cable_descuento,
                    'compra_id' => $compra->id
                ]);
                DB::table('cable')
                    ->where('id','=',$request->cablesId[$index])
                    ->decrement('cable_cantidad', $request->cablesCantidad[$index]);
                $index++;
            }
        }

        $data = [
            'codigo' => $randomCode,
            'costo' => $request->costoTotal,
            'metodo_entrega' => $despacho->metodo_despacho_nombre,
            'nombre' => $request->user()->name,
        ];

        if(strcmp($pago->metodo_pago_nombre, 'Transferencia')){
            Mail::to($request->user()->email)->send(new GraciasPorComprar($data));
        }else{
            Mail::to($request->user()->email)->send(new AgradecimientoTrans($data));
        }

        return response()->json($compra, 200);
}catch(Throwable $e){
        return response()->json($e, 500);
}
    }

    public function get_all_compras(Request $request){
        $compras = Compra::
            with('discos')
            ->with('usuario')
            ->with('perifericos')
            ->with('ram')
            ->with('cable')
            ->with('estado_compra')
            ->with('metodo_despacho')
            ->with('metodo_pago')
            ->where('compra_codigo','LIKE','%'.$request->codigo.'%')
            ->where('compra_email','LIKE','%'.$request->correo.'%')
            ->where('estado_compra_id','=',$request->estado)
            ->latest()
            ->paginate(5);

        return $compras;
    }

    public function get_compras_by_user_id(Request $request){
        $compras = Compra::where('user_id', $request->user()->id)
            ->with('usuario')
            ->with('discos')
            ->with('perifericos')
            ->with('ram')
            ->with('cable')
            ->with('estado_compra')
            ->with('metodo_despacho')
            ->with('metodo_pago')
            ->latest()
            ->paginate(5);

        return response()->json($compras, 200);
    }

    public function get_ventas_para_estadisticas(Request $request){
        $compras = Compra::
            with('discos')
            ->with('perifericos')
            ->with('ram')
            ->with('cable')
            ->with('usuario')
            ->with('estado_compra')
            ->with('metodo_despacho')
            ->with('metodo_pago')
            ->get();

        return response()->json($compras, 200);

    }

    public function get_productos_destacados(Request $request)
    {
        $cable = DB::table('cable')
            ->join('disponibilidad','disponibilidad.id','=','cable.disponibilidad_id')
            ->join('estado','estado.id','=','cable.estado_id')
            ->join('marca','marca.id','=','cable.marca_id')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Vendido')
            #->where('disponibilidad.disponibilidad_nombre', '!=', 'Reparacion pendiente')
            ->where('cable.cable_cantidad', '>', 0)
            #->where('estado.estado_nombre', '!=', 'Para repuesto')
            #->where('estado.estado_nombre', '!=', 'Por revisar')
            ->where('cable.cable_destacado', true)
            ->orderBy('cable.id', 'desc')
            ->limit(3)
            ->get();

        $ram= DB::table('ram')
            ->join('disponibilidad','disponibilidad.id','=','ram.disponibilidad_id')
            ->join('estado','estado.id','=','ram.estado_id')
            ->join('marca','marca.id','=','ram.marca_id')
            ->join('velocidad_ram','velocidad_ram.id','=','ram.velocidad_ram_id')
            ->join('tipo_ram','tipo_ram.id','=','ram.tipo_ram_id')
            ->join('tamano_ram','tamano_ram.id','=','ram.tamano_ram_id')
            ->join('CapacidadRam','CapacidadRam.id','=','ram.CapacidadRam_id')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Vendido')
            #->where('disponibilidad.disponibilidad_nombre', '!=', 'Reparacion pendiente')
            #->where('estado.estado_nombre', '!=', 'Para repuesto')
            #->where('estado.estado_nombre', '!=', 'Por revisar')
            ->where('ram.ram_destacado', true)
            ->select('ram.id',
                'ram.ram_nombre',
                'ram.ram_precio',
                'ram.ram_foto',
                'disponibilidad.disponibilidad_nombre',
                'tipo_ram.tipo_ram_nombre',
                'tamano_ram.tamano_ram_nombre',
                'CapacidadRam.CapacidadRam_capacidad',
                'velocidad_ram.velocidad_ram_velocidad',
                'estado.estado_nombre',
                'marca.marca_nombre')
            ->orderBy('ram.id', 'desc')
            ->get();

        $discos = DB::table('disco_duro')
            ->join('disponibilidad','disponibilidad.id','=','disco_duro.disponibilidad_id')
            ->join('estado','estado.id','=','disco_duro.estado_id')
            ->join('tamano','tamano.id','=','disco_duro.tamano_id')
            ->join('marca','marca.id','=','disco_duro.marca_id')
            ->join('sistema_archivos','sistema_archivos.id','=','disco_duro.sistema_archivos_id')
            ->join('tipo_entrada','tipo_entrada.id','=','disco_duro.tipo_entrada_id')
            ->whereNotIn('disponibilidad.disponibilidad_nombre', ['Vendido','Reparacion pendiente'])
            #->where('estado.estado_nombre', '!=', 'Para repuesto')
            #->where('estado.estado_nombre', '!=', 'Por revisar')
            ->where('disco_duro.disco_duro_destacado', true)
            ->select('disco_duro.id',
                'disco_duro.disco_duro_memoria',
                'disco_duro.disco_duro_precio',
                'disco_duro.disco_duro_nombre',
                'disco_duro.disco_duro_foto',
                'disco_duro.disco_duro_horas_encendido',
                'disco_duro.disco_duro_esperanza_vida',
                'disco_duro.disco_duro_crystaldisk',
                'disco_duro.disco_duro_descuento',
                'disco_duro.disco_duro_destacado',
                'tipo_entrada.tipo_entrada_nombre',
                'disponibilidad.disponibilidad_nombre',
                'disponibilidad.disponibilidad_descripcion',
                'estado.estado_nombre',
                'tamano.tamano_nombre',
                'tamano.tamano_descripcion',
                'marca.marca_nombre',
                'sistema_archivos.sistema_archivos_nombre')
            ->orderBy('disco_duro.id', 'desc')
            ->get();

        $perifericos = DB::table('periferico')
            ->join('disponibilidad','disponibilidad.id','=','periferico.disponibilidad_id')
            ->join('estado','estado.id','=','periferico.estado_id')
            ->join('marca','marca.id','=','periferico.marca_id')
            ->join('tipo_entrada','tipo_entrada.id','=','periferico.tipo_entrada_id')
            ->join('tipo_periferico','tipo_periferico.id','=','periferico.tipo_periferico_id')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Vendido')
            #->where('disponibilidad.disponibilidad_nombre', '!=', 'Reparacion pendiente')
            #->where('estado.estado_nombre', '!=', 'Para repuesto')
            #->where('estado.estado_nombre', '!=', 'Por revisar')
            ->where('periferico.periferico_destacado', true)
            ->select('periferico.id',
                'periferico.periferico_nombre',
                'periferico.periferico_precio',
                'periferico.periferico_foto',
                'disponibilidad.disponibilidad_nombre',
                'disponibilidad.disponibilidad_descripcion',
                'tipo_periferico.nombre_tipo_periferico',
                'tipo_entrada.tipo_entrada_nombre',
                'estado.estado_nombre',
                'marca.marca_nombre')
            ->orderBy('periferico.id', 'desc')
            ->get();

        $response = [$ram, $discos, $perifericos, $cable];

        return response()->json($response, 200);
    }

    public function get_productos_nuevos(Request $request)
    {
        $cable = DB::table('cable')
            ->join('disponibilidad','disponibilidad.id','=','cable.disponibilidad_id')
            ->join('estado','estado.id','=','cable.estado_id')
            ->join('marca','marca.id','=','cable.marca_id')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Vendido')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Reparacion pendiente')
            ->where('cable.cable_cantidad', '>', 0)
            ->where('estado.estado_nombre', '!=', 'Para repuesto')
            ->where('estado.estado_nombre', '!=', 'Por revisar')
            ->orderBy('cable.id', 'desc')
            ->limit(3)
            ->get();

        $ram= DB::table('ram')
            ->join('disponibilidad','disponibilidad.id','=','ram.disponibilidad_id')
            ->join('estado','estado.id','=','ram.estado_id')
            ->join('marca','marca.id','=','ram.marca_id')
            ->join('velocidad_ram','velocidad_ram.id','=','ram.velocidad_ram_id')
            ->join('tipo_ram','tipo_ram.id','=','ram.tipo_ram_id')
            ->join('tamano_ram','tamano_ram.id','=','ram.tamano_ram_id')
            ->join('CapacidadRam','CapacidadRam.id','=','ram.CapacidadRam_id')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Vendido')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Reparacion pendiente')
            ->where('estado.estado_nombre', '!=', 'Para repuesto')
            ->where('estado.estado_nombre', '!=', 'Por revisar')
            ->select('ram.id',
                'ram.ram_nombre',
                'ram.ram_precio',
                'ram.ram_foto',
                'disponibilidad.disponibilidad_nombre',
                'tipo_ram.tipo_ram_nombre',
                'tamano_ram.tamano_ram_nombre',
                'CapacidadRam.CapacidadRam_capacidad',
                'velocidad_ram.velocidad_ram_velocidad',
                'estado.estado_nombre',
                'marca.marca_nombre')
            ->orderBy('ram.id', 'desc')
            ->limit(3)
            ->get();

        $discos = DB::table('disco_duro')
            ->join('disponibilidad','disponibilidad.id','=','disco_duro.disponibilidad_id')
            ->join('estado','estado.id','=','disco_duro.estado_id')
            ->join('tamano','tamano.id','=','disco_duro.tamano_id')
            ->join('marca','marca.id','=','disco_duro.marca_id')
            ->join('sistema_archivos','sistema_archivos.id','=','disco_duro.sistema_archivos_id')
            ->join('tipo_entrada','tipo_entrada.id','=','disco_duro.tipo_entrada_id')
            ->whereNotIn('disponibilidad.disponibilidad_nombre', ['Vendido','Reparacion pendiente'])
            ->where('estado.estado_nombre', '!=', 'Para repuesto')
            ->where('estado.estado_nombre', '!=', 'Por revisar')
            ->select('disco_duro.id',
                'disco_duro.disco_duro_memoria',
                'disco_duro.disco_duro_precio',
                'disco_duro.disco_duro_nombre',
                'disco_duro.disco_duro_foto',
                'disco_duro.disco_duro_horas_encendido',
                'disco_duro.disco_duro_esperanza_vida',
                'disco_duro.disco_duro_crystaldisk',
                'disco_duro.disco_duro_descuento',
                'disco_duro.disco_duro_destacado',
                'tipo_entrada.tipo_entrada_nombre',
                'disponibilidad.disponibilidad_nombre',
                'disponibilidad.disponibilidad_descripcion',
                'estado.estado_nombre',
                'tamano.tamano_nombre',
                'tamano.tamano_descripcion',
                'marca.marca_nombre',
                'sistema_archivos.sistema_archivos_nombre')
            ->orderBy('disco_duro.id', 'desc')
            ->limit(3)
            ->get();

        $perifericos = DB::table('periferico')
            ->join('disponibilidad','disponibilidad.id','=','periferico.disponibilidad_id')
            ->join('estado','estado.id','=','periferico.estado_id')
            ->join('marca','marca.id','=','periferico.marca_id')
            ->join('tipo_entrada','tipo_entrada.id','=','periferico.tipo_entrada_id')
            ->join('tipo_periferico','tipo_periferico.id','=','periferico.tipo_periferico_id')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Vendido')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Reparacion pendiente')
            ->where('estado.estado_nombre', '!=', 'Para repuesto')
            ->where('estado.estado_nombre', '!=', 'Por revisar')
            ->select('periferico.id',
                'periferico.periferico_nombre',
                'periferico.periferico_precio',
                'periferico.periferico_foto',
                'disponibilidad.disponibilidad_nombre',
                'disponibilidad.disponibilidad_descripcion',
                'tipo_periferico.nombre_tipo_periferico',
                'tipo_entrada.tipo_entrada_nombre',
                'estado.estado_nombre',
                'marca.marca_nombre')
            ->orderBy('periferico.id', 'desc')
            ->limit(3)
            ->get();

        $response = [$ram, $discos, $perifericos, $cable];

        return response()->json($response, 200);
    }

    public function check_carrito(Request $productos)
    {
        $response = 0;
        return response()->json($response, 500);
    }

    public function enviarCorreo()
    {
        $data = [
            'nombre' => 'Juan Pérez',
        ];

        Mail::to('marcelo.murillo.99@hotmail.com')->send(new Mailablee($data));

        return response()->json("Wena los k", 200);
    }
}
