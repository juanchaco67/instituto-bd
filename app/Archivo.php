<?php

namespace App;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Archivo
{

    private $file;

    /**
     * constructor de la clase recibe un archivo
     * @param  $file
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * nombre de la ruta de los archivos
     * @param  $dateServidor
     * @param  $extension
     * @param  $nombre
     * @return string
     */
    private function nombreRutaArchivos($usuario, $nombre)
    {
        if(!empty($usuario) && !is_null($usuario)){

            return $usuario->tipo . '/' . $usuario->cedula . '/' . $nombre;
        }
        return 'img/'.$nombre;
    }

    /**
     * nombre de la ruta del archivo
     * @param  $dateServidor
     * @return string
     */
    private function nombreRutaArchivo($usuario)
    {

        return $this->nombreRutaArchivos(
            $usuario,
            $this->file->getClientOriginalName()
        );
    }

    /**
     * metodo que guarda el archivo en la ruta especifica
     */
    public function guardarArchivo($usuario)
    {

        Storage::disk("local")->put(
            $this->nombreRutaArchivo($usuario),
            File::get($this->file)
        );
    }

    /**
     * metodo que guarda el archivo en la ruta especifica
     */
    public function guardarArchivoNoticia($ruta)
    {

        Storage::disk("local")->put(
            $ruta.$this->file->getClientOriginalName(),
            File::get($this->file)
        );
    }

    public function getArchivoNombreExtension()
    {
        return $this->file->getClientOriginalName();
    }
}
