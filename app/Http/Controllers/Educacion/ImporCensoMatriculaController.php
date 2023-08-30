<?php

namespace App\Http\Controllers\Educacion;

use App\Exports\ImporPadronSiagieExport;
use App\Http\Controllers\Controller;
use App\Imports\tablaXImport;
use App\Models\Administracion\Entidad;
use App\Models\Educacion\ImporCensoMatricula;
use App\Models\Educacion\Importacion;
use App\Repositories\Educacion\ImportacionRepositorio;
use App\Utilities\Utilitario;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

use function PHPUnit\Framework\isNull;

class ImporCensoMatriculaController extends Controller
{
    public static $FUENTE = 33;
    public $fuente = 33;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function importar()
    {
        $mensaje = "";
        return view('educacion.ImporCensoMatricula.Importar', compact('mensaje'));
    }

    public function exportar()
    {
        /* $imp = Importacion::where(['fuenteimportacion_id' => $this->fuente, 'estado' => 'PR'])->orderBy('fechaActualizacion', 'desc')->first();
        $mat = Matricula::where('importacion_id', $imp->id)->first();
        $mensaje = "";
        return view('educacion.ImporPoblacion.Exportar', compact('mensaje', 'imp', 'mat')); */
    }

    function json_output($status = 200, $msg = 'OK!!', $data = null)
    {
        header('Content-Type:application/json');
        echo json_encode([
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        ]);
        die;
    }

    public function guardar(Request $request)
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);

        $existeMismaFecha = ImportacionRepositorio::Importacion_PE($request->fechaActualizacion, $this->fuente);
        if ($existeMismaFecha != null) {
            $mensaje = "Error, Ya existe archivos prendientes de aprobar para la fecha de versión ingresada";
            $this->json_output(400, $mensaje);
        }

        $existeMismaFecha = ImportacionRepositorio::Importacion_PR($request->fechaActualizacion, $this->fuente);
        if ($existeMismaFecha != null) {
            $mensaje = "Error, Ya existe archivos procesados para la fecha de versión ingresada";
            $this->json_output(400, $mensaje);
        }

        $this->validate($request, ['file' => 'required|mimes:xls,xlsx']);
        $archivo = $request->file('file');
        $array = (new tablaXImport)->toArray($archivo);

        if (count($array) != 1) {
            $this->json_output(400, 'Error de Hojas, Solo debe tener una HOJA, el LIBRO EXCEL');
        }

        try {
            foreach ($array as $value) {
                foreach ($value as $celda => $row) {
                    if ($celda > 0) break;
                    $cadena =
                        $row['codooii'] .
                        $row['codgeo'] .
                        $row['codlocal'] .
                        $row['cod_mod'] .
                        $row['nroced'] .
                        $row['cuadro'] .
                        $row['tipdato'] .
                        $row['niv_mod'] .
                        $row['ges_dep'] .
                        $row['area_censo'] .
                        $row['tipoprog'] .
                        $row['d01'] .
                        $row['d02'] .
                        $row['d03'] .
                        $row['d04'] .
                        $row['d05'] .
                        $row['d06'] .
                        $row['d07'] .
                        $row['d08'] .
                        $row['d09'] .
                        $row['d10'] .
                        $row['d11'] .
                        $row['d12'] .
                        $row['d13'] .
                        $row['d14'] .
                        $row['d15'] .
                        $row['d16'] .
                        $row['d17'] .
                        $row['d18'] .
                        $row['d19'] .
                        $row['d20'] .
                        $row['d21'] .
                        $row['d22'] .
                        $row['d23'] .
                        $row['d24'] .
                        $row['d25'] .
                        $row['d26'] .
                        $row['d27'] .
                        $row['d28'] .
                        $row['d29'] .
                        $row['d30'] .
                        $row['d31'] .
                        $row['d32'] .
                        $row['d33'] .
                        $row['d34'] .
                        $row['d35'] .
                        $row['d36'] .
                        $row['d37'] .
                        $row['d38'] .
                        $row['d39'] .
                        $row['d40'];
                }
            }
        } catch (Exception $e) {
            $mensaje = "Formato de archivo no reconocido, porfavor verifique si el formato es el correcto";
            $this->json_output(403, $mensaje);
        }

        try {
            $importacion = Importacion::Create([
                'fuenteImportacion_id' => $this->fuente, // valor predeterminado
                'usuarioId_Crea' => auth()->user()->id,
                'usuarioId_Aprueba' => null,
                'fechaActualizacion' => $request['fechaActualizacion'],
                'comentario' => $request['comentario'],
                'estado' => 'PR'
            ]);

            /* $tableta = Tableta::Create([
                'importacion_id' => $importacion->id,
                'anio_id' => Anio::where('anio', date('Y', strtotime($importacion->fechaActualizacion)))->first()->id,
                'created_at' => date('Y-m-d h:i:s'),
            ]); */


            foreach ($array as $key => $value) {
                foreach ($value as $row) {
                    ImporCensoMatricula::Create([
                        'importacion_id' => $importacion->id,
                        'codooii' => $row['codooii'],
                        'codgeo' => $row['codgeo'],
                        'codlocal' => $row['codlocal'],
                        'cod_mod' => $row['cod_mod'],
                        'nroced' => $row['nroced'],
                        'cuadro' => $row['cuadro'],
                        'tipdato' => $row['tipdato'],
                        'niv_mod' => $row['niv_mod'],
                        'ges_dep' => $row['ges_dep'],
                        'area_censo' => $row['area_censo'],
                        'tipoprog' => $row['tipoprog'],
                        'd01' => $row['d01'] ? $row['d01'] : 0,
                        'd02' => $row['d02'] ? $row['d02'] : 0,
                        'd03' => $row['d03'] ? $row['d03'] : 0,
                        'd04' => $row['d04'] ? $row['d04'] : 0,
                        'd05' => $row['d05'] ? $row['d05'] : 0,
                        'd06' => $row['d06'] ? $row['d06'] : 0,
                        'd07' => $row['d07'] ? $row['d07'] : 0,
                        'd08' => $row['d08'] ? $row['d08'] : 0,
                        'd09' => $row['d09'] ? $row['d09'] : 0,
                        'd10' => $row['d10'] ? $row['d10'] : 0,
                        'd11' => $row['d11'] ? $row['d11'] : 0,
                        'd12' => $row['d12'] ? $row['d12'] : 0,
                        'd13' => $row['d13'] ? $row['d13'] : 0,
                        'd14' => $row['d14'] ? $row['d14'] : 0,
                        'd15' => $row['d15'] ? $row['d15'] : 0,
                        'd16' => $row['d16'] ? $row['d16'] : 0,
                        'd17' => $row['d17'] ? $row['d17'] : 0,
                        'd18' => $row['d18'] ? $row['d18'] : 0,
                        'd19' => $row['d19'] ? $row['d19'] : 0,
                        'd20' => $row['d20'] ? $row['d20'] : 0,
                        'd21' => $row['d21'] ? $row['d21'] : 0,
                        'd22' => $row['d22'] ? $row['d22'] : 0,
                        'd23' => $row['d23'] ? $row['d23'] : 0,
                        'd24' => $row['d24'] ? $row['d24'] : 0,
                        'd25' => $row['d25'] ? $row['d25'] : 0,
                        'd26' => $row['d26'] ? $row['d26'] : 0,
                        'd27' => $row['d27'] ? $row['d27'] : 0,
                        'd28' => $row['d28'] ? $row['d28'] : 0,
                        'd29' => $row['d29'] ? $row['d29'] : 0,
                        'd30' => $row['d30'] ? $row['d30'] : 0,
                        'd31' => $row['d31'] ? $row['d31'] : 0,
                        'd32' => $row['d32'] ? $row['d32'] : 0,
                        'd33' => $row['d33'] ? $row['d33'] : 0,
                        'd34' => $row['d34'] ? $row['d34'] : 0,
                        'd35' => $row['d35'] ? $row['d35'] : 0,
                        'd36' => $row['d36'] ? $row['d36'] : 0,
                        'd37' => $row['d37'] ? $row['d37'] : 0,
                        'd38' => $row['d38'] ? $row['d38'] : 0,
                        'd39' => $row['d39'] ? $row['d39'] : 0,
                        'd40' => $row['d40'] ? $row['d40'] : 0
                    ]);
                }
            }
        } catch (Exception $e) {
            $importacion->estado = 'EL';
            $importacion->save();

            $mensaje = "Error en la carga de datos, verifique los datos de su archivo y/o comuniquese con el administrador del sistema" . $e->getMessage();
            $this->json_output(400, $mensaje);
        }

        /* try {
            DB::select('call par_pa_procesarImporTableta(?,?,?)', [$importacion->id, $tableta->id, $importacion->usuarioId_Crea]);
        } catch (Exception $e) {
            $importacion->estado = 'EL';
            $importacion->save();

            $mensaje = "Error al procesar la normalizacion de datos." . $e;
            $tipo = 'danger';
            $this->json_output(400, $mensaje);
        } */
        $mensaje = "Archivo excel subido y Procesado correctamente .";
        $this->json_output(200, $mensaje, '');
    }

    public function ListarDTImportFuenteTodos(Request $rq)
    {
        $draw = intval($rq->draw);
        $start = intval($rq->start);
        $length = intval($rq->length);
        $query = ImportacionRepositorio::Listar_FuenteTodos($this->fuente);
        $data = [];
        foreach ($query as $key => $value) {
            $nom = '';
            if (strlen($value->cnombre) > 0) {
                $xx = explode(' ', $value->cnombre);
                $nom = $xx[0];
            }
            $ape = '';
            if (strlen($value->capellido1) > 0) {
                $xx = explode(' ', $value->capellido1 . ' ' . $value->capellido2);
                $ape = $xx[0];
            }

            $ent = Entidad::select('adm_entidad.*');
            $ent = $ent->join('adm_entidad as v2', 'v2.dependencia', '=', 'adm_entidad.id');
            $ent = $ent->join('adm_entidad as v3', 'v3.dependencia', '=', 'v2.id');
            $ent = $ent->where('v3.id', $value->entidad);
            $ent = $ent->first();

            if (date('Y-m-d', strtotime($value->created_at)) == date('Y-m-d') || session('perfil_id') == 3 || session('perfil_id') == 8 || session('perfil_id') == 9 || session('perfil_id') == 10 || session('perfil_id') == 11)
                $boton = '<button type="button" onclick="geteliminar(' . $value->id . ')" class="btn btn-danger btn-xs" id="eliminar' . $value->id . '"><i class="fa fa-trash"></i> </button>';
            else
                $boton = '';
            $boton2 = '<button type="button" onclick="monitor(' . $value->id . ')" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> </button>';
            $data[] = array(
                $key + 1,
                date("d/m/Y", strtotime($value->fechaActualizacion)),
                $value->fuente,
                $nom . ' ' . $ape,
                $ent ? $ent->apodo : '',
                date("d/m/Y", strtotime($value->created_at)),
                $value->estado == "PR" ? "PROCESADO" : ($value->estado == "PE" ? "PENDIENTE" : "ELIMINADO"),
                $boton . '&nbsp;' . $boton2,
            );
        }
        $result = array(
            "draw" => $draw,
            "recordsTotal" => $start,
            "recordsFiltered" => $length,
            "data" => $data
        );
        return response()->json($result);
    }

    public function ListaImportada($importacion_id) //(Request $request, $importacion_id)
    {
        $data = ImporCensoMatricula::where('importacion_id', $importacion_id)->get();
        return DataTables::of($data)->make(true);
    }

    public function eliminar($id)
    {
        ImporCensoMatricula::where('importacion_id', $id)->delete();
        Importacion::find($id)->delete();
        return response()->json(array('status' => true));
    }

    public function download()
    {
        $name = 'SIAGIE MATRICULAS ' . date('Y-m-d') . '.xlsx';
        return Excel::download(new ImporPadronSiagieExport, $name);
    }
}
