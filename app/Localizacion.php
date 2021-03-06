<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localizacion extends Model
{
    protected $table = 'localizacions';

    protected $casts = [
        'latitud' => 'double',
        'longitud' => 'double',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "id",
        "direccion",
        "latitud",
        "longitud",
    ];
    /**
     * buscar ciudad
     */
    function buscar($latitud, $longitud, $direccion, $ciudad)
    {
        $localizacion = $this->where('latitud', $latitud)->where("longitud", $longitud)->where("id_ciudad", $ciudad->id)->first();
        if (!empty($localizacion)) {
            return $localizacion;
        } else {
            return $this->crear($latitud, $longitud, $direccion, $ciudad);
        }
    }
    /**
     * crear localizacion
     */
    function crear($latitud, $longitud, $direccion, $ciudad)
    {
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $this->direccion = $direccion;
        $this->id_ciudad = $ciudad->id;
        $this->save();
        return $this;
    }

    public function usuarios()    {
        return $this->hasMany('App\Usuario','id_localizacion');
    }


    public function sedes()    {
        return $this->hasMany(Sede::class,'id_localizacion');
    }

}
