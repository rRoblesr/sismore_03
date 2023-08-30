<?php

namespace App\Models\Educacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImporPadronWeb extends Model
{
    use HasFactory;

    protected $table = "edu_impor_padronweb";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'importacion_id',
        'cod_Mod',
        'cod_Local',
        'cen_Edu',
        'niv_Mod',
        'd_Niv_Mod',
        'modalidad',
        'd_Forma',
        'cod_Car',
        'd_Cod_Car',
        'TipsSexo',
        'd_TipsSexo',
        'gestion',
        'd_Gestion',
        'ges_Dep',
        'd_Ges_Dep',
        'director',
        'telefono',
        'email',
        'dir_Cen',
        'localidad',
        'codcp_Inei',
        'codccpp',
        'cen_Pob',
        'area_Censo',
        'd_areaCenso',
        'codGeo',
        'd_Prov',
        'd_Dist',
        'codOOII',
        'd_DreUgel',
        'nLat_IE',
        'nLong_IE',
        'cod_Tur',
        'D_Cod_Tur',
        'estado',
        'd_Estado',
        'tAlum_Hom',
        'tAlum_Muj',
        'tAlumno',
        'tDocente',
        'tSeccion',
        'fechaReg',
        'fecha_Act'
    ];

    protected $hide = [
        'created_at',
        'updated_at'
    ];
}
