<?php

namespace Gof\Gestor\Autoload\Cargador;

use Gof\Datos\Bits\Mascara\MascaraDeBits;
use Gof\Gestor\Autoload\Excepcion\ArchivoInaccesible;
use Gof\Gestor\Autoload\Excepcion\ArchivoInexistente;
use Gof\Gestor\Autoload\Interfaz\Cargador;
use Gof\Interfaz\Bits\Mascara;

class Archivos implements Cargador
{
    // const VALIDAR_EXISTENCIA = 1;
    // CONST VALIDAR_LECTURA = 2;

    /**
     *  @var int Indica que se lanzará una excepción cuando ocurra un error
     */
    const LANZAR_EXCEPCIONES = 4;

    /**
     *  @var int Indica que se agregará automaticamente la extensión '.php' a las rutas
     */
    const INCLUIR_EXTENSION = 8;

    /**
     *  @var int Máscara de bits con la configuración por defecto
     */
    const CONFIGURACION_POR_DEFECTO = self::LANZAR_EXCEPCIONES;

    /**
     *  @var int Indica que no existe el archivo
     */
    const ERROR_ARCHIVO_INEXISTENTE = 1;

    /**
     *  @var int Indica que el archivo no es legible
     */
    const ERROR_ARCHIVO_ILEGIBLE = 2;

    /**
     *  @var int Último error ocurrido
     */
    private $error = 0;

    /**
     *  @var int Máscara de bits con la configuración interna
     */
    private $configuracion;

    /**
     *  Crea una instancia del cargador de archivos del gestor de Autoloads
     *
     *  @param int $configuracion Máscara de bits con la configuración deseada
     */
    public function __construct(int $configuracion = self::CONFIGURACION_POR_DEFECTO)
    {
        $this->configuracion = new MascaraDeBits($configuracion);
    }

    /**
     *  Simplemente carga el archivo
     *
     *  Si INCLUIR_EXTENSION está activo se agregará la cadena '.php' a la ruta recibida.
     *
     *  @param string $rutaDelArchivo Ruta del archivo a ser cargado
     *
     *  @throws ArchivoInexistente si la ruta no apunta a ningún archivo
     *  @throws ArchivoInaccesible si el archivo no puede ser leído
     *
     *  @see Archivos::error() para ver el error ocurrido si falla la carga
     *
     *  @return bool Devuelve **true** en caso de éxito o **false** de lo contrario
     */
    public function cargar(string $rutaDelArchivo): bool
    {
        if( $this->configuracion->activados(self::INCLUIR_EXTENSION) ) {
            $rutaDelArchivo .= '.php';
        }

        if( file_exists($rutaDelArchivo) === false ) {
            if( $this->configuracion->activados(self::LANZAR_EXCEPCIONES) ) {
                throw new ArchivoInexistente($rutaDelArchivo);
            }

            $this->error = self::ERROR_ARCHIVO_INEXISTENTE;
            return false;
        }

        if( is_readable($rutaDelArchivo) === false ) {
            if( $this->configuracion->activados(self::LANZAR_EXCEPCIONES) ) {
                throw new ArchivoInaccesible($rutaDelArchivo);
            }

            $this->error = self::ERROR_ARCHIVO_ILEGIBLE;
            return false;
        }

        require $rutaDelArchivo;
        return true;
    }

    /**
     *  Obtiene la configuracion interna
     *
     *  @return Mascara Devuelve una tipo de datos Mascara de bits
     */
    public function configuracion(): Mascara
    {
        return $this->configuracion;
    }

    /**
     *  Obtiene el identificador del último error ocurrido
     *
     *  @return int Devuelve el último error
     */
    public function error(): int
    {
        return $this->error;
    }

    /**
     *  Limpia los errores
     */
    public function limpiarErrores()
    {
        $this->error = 0;
    }

}
