<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controller_disco_duro extends Controller
{
    private $intervalo_precio = 10000;
    private $intervalo_capacidad = 6;
    private $intervalo_esperanza = 5000;
    private $intervalo_horas = 5000;

    public function get_all_discos_duros(Request $request)
    {
        $discos = DB::table('disco_duro')
            ->join('disponibilidad','disponibilidad.id','=','disco_duro.disponibilidad_id')
            ->join('estado','estado.id','=','disco_duro.estado_id')
            ->join('tamano','tamano.id','=','disco_duro.tamano_id')
            ->join('marca','marca.id','=','disco_duro.marca_id')
            ->join('sistema_archivos','sistema_archivos.id','=','disco_duro.sistema_archivos_id')
            ->join('tipo_entrada','tipo_entrada.id','=','disco_duro.tipo_entrada_id')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Vendido')
            ->select('disco_duro.id',
                'disco_duro.disco_duro_memoria',
                'disco_duro.disco_duro_precio',
                'disco_duro.disco_duro_nombre',
                'disco_duro.disco_duro_foto',
                'disco_duro.disco_duro_horas_encendido',
                'disco_duro.disco_duro_esperanza_vida',
                'disco_duro.disco_duro_crystaldisk',
                'disponibilidad.disponibilidad_nombre',
                'disponibilidad.disponibilidad_descripcion',
                'estado.estado_nombre',
                'tamano.tamano_nombre',
                'tamano.tamano_descripcion',
                'marca.marca_nombre',
                'disco_duro.disco_duro_descuento',
                'disco_duro.disco_duro_destacado',
                'sistema_archivos.sistema_archivos_nombre');

        if($request->disponibilidad != null) $discos = $discos->whereIn('disponibilidad.id',$request->disponibilidad);
        if($request->estado != null) $discos = $discos->whereIn('estado.id',$request->estado);
        if($request->tamano != null) $discos = $discos->whereIn('tamano.id',$request->tamano);
        if($request->marca != null) $discos = $discos->whereIn('marca.id',$request->marca);
        if($request->sistema_archivos != null) $discos = $discos->whereIn('sistema_archivos.id',$request->sistema_archivos);
        if($request->precio != null){
            foreach ($request->precio as $precio) {
                $discos = $discos->where('disco_duro_precio','>', ($precio - 1) * $this->intervalo_precio);
                $discos = $discos->where('disco_duro_precio','<', $precio * $this->intervalo_precio);
            }
        }
        if($request->capacidad != null){
            foreach ($request->capacidad as $capacidad) {
                $discos = $discos->where('disco_duro_memoria','>', pow(2, $capacidad + $this->intervalo_capacidad - 1));
                $discos = $discos->where('disco_duro_memoria','<', pow(2, $capacidad + $this->intervalo_capacidad));
            }
        }
        if($request->esperanza != null){
            foreach ($request->esperanza as $esperanza) {
                $discos = $discos->where('disco_duro_esperanza_vida','>', ($esperanza - 1) * $this->intervalo_esperanza);
                $discos = $discos->where('disco_duro_esperanza_vida','<', $esperanza * $this->intervalo_esperanza);
            }
        }
        if($request->horas != null){
            foreach ($request->horas as $horas) {
                $discos = $discos->where('disco_duro_horas_encendido','>', ($horas - 1) * $this->intervalo_horas);
                $discos = $discos->where('disco_duro_horas_encendido','<', $horas * $this->intervalo_horas);
            }
        }

        $discos = $discos->paginate(12);
        return $discos;
    }

    public function discosDurosPaginated(Request $request)
    {
        $discos = DB::table('disco_duro')
            ->join('disponibilidad','disponibilidad.id','=','disco_duro.disponibilidad_id')
            ->join('estado','estado.id','=','disco_duro.estado_id')
            ->join('tamano','tamano.id','=','disco_duro.tamano_id')
            ->join('marca','marca.id','=','disco_duro.marca_id')
            ->join('sistema_archivos','sistema_archivos.id','=','disco_duro.sistema_archivos_id')
            ->join('tipo_entrada','tipo_entrada.id','=','disco_duro.tipo_entrada_id')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Vendido')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Reparacion pendiente')
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
                'sistema_archivos.sistema_archivos_nombre');

        if($request->disponibilidad != null) $discos = $discos->whereIn('disponibilidad.id',$request->disponibilidad);
        if($request->estado != null) $discos = $discos->whereIn('estado.id',$request->estado);
        if($request->tamano != null) $discos = $discos->whereIn('tamano.id',$request->tamano);
        if($request->marca != null) $discos = $discos->whereIn('marca.id',$request->marca);
        if($request->precio != null){
            foreach ($request->precio as $precio) {
                $discos = $discos->where('disco_duro_precio','>', ($precio - 1) * $this->intervalo_precio);
                $discos = $discos->where('disco_duro_precio','<', $precio * $this->intervalo_precio);
            }
        }
        if($request->capacidad != null){
            foreach ($request->capacidad as $capacidad) {
                $discos = $discos->where('disco_duro_memoria','>', pow(2, $capacidad + $this->intervalo_capacidad - 1));
                $discos = $discos->where('disco_duro_memoria','<', pow(2, $capacidad + $this->intervalo_capacidad));
            }
        }
        if($request->esperanza != null){
            foreach ($request->esperanza as $esperanza) {
                $discos = $discos->where('disco_duro_esperanza_vida','>', ($esperanza - 1) * $this->intervalo_esperanza);
                $discos = $discos->where('disco_duro_esperanza_vida','<', $esperanza * $this->intervalo_esperanza);
            }
        }
        if($request->horas != null){
            foreach ($request->horas as $horas) {
                $discos = $discos->where('disco_duro_horas_encendido','>', ($horas - 1) * $this->intervalo_horas);
                $discos = $discos->where('disco_duro_horas_encendido','<', $horas * $this->intervalo_horas);
            }
        }
        if($request->sistema_archivos != null) $discos = $discos->whereIn('sistema_archivos.id',$request->sistema_archivos);

        $discos = $discos->paginate(12);
        return $discos;
    }
}
