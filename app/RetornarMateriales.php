<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RetornarMateriales extends Model
{
    protected $fillable = [
        'id_material_inventario','id_ubicaciones','id_servicios','id_cubiculo',
        'id_material_ing',
        'id_cant_esp','id_material_medida',
        'material_cantidad','material_cantidad_minima','material_valor','material_cantidad_calculada',
        'id_documento','n_documento','id_ticket','id_estados','id_categoria'
    ];
}
