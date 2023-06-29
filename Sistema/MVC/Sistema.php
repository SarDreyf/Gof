<?php

namespace Gof\Sistema\MVC;

use Gof\Gestor\Autoload\Autoload;
use Gof\Gestor\Autoload\Cargador\Archivos;
use Gof\Gestor\Autoload\Filtro\PSR4 as FiltroPSR4;
use Gof\Sistema\MVC\Registros\Registros;

/**
 * Sistema MVC
 *
 * Conjunto de herramientas que ofrecen un servicio capaz de ejecutar y mantener
 * una aplicación web para la arquitectura MVC (Modelo-Vista-Controlador).
 *
 * @package Gof\Sistema\MVC
 */
class Sistema
{
    /**
     * @var Registros Instancia del gestor de registros de errores
     */
    private Registros $registros;

    /**
     * @var Autoload Instancia del gestor de autoload
     */
    private Autoload $autoload;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->registros = new Registros();

        // Autoload
        $cargadorDeArchivos = new Archivos();
        $cargadorDeArchivos->configuracion()->activar(Archivos::INCLUIR_EXTENSION);

        $this->autoload = new Autoload($cargadorDeArchivos, new FiltroPSR4());
        $this->autoload->registrar();
    }

    /**
     * Obtiene el gestor de registros de errores
     *
     * @return Registros
     */
    public function registros(): Registros
    {
        return $this->registros;
    }

    /**
     * Obtiene el gestor de autoload
     *
     * @return Autoload
     */
    public function autoload(): Autoload
    {
        return $this->autoload;
    }

}
