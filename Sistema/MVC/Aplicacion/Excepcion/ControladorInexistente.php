<?php

namespace Gof\Sistema\MVC\Aplicacion\Excepcion;

/**
 * Excepción lanzada cuando el controlador no existe
 *
 * @package Gof\Sistema\MVC\Aplicacion\Excepcion
 */
class ControladorInexistente extends Excepcion
{

    /**
     * Constructor
     *
     * @param string $controlador Nombre del controlador inexistente
     */
    public function __construct(string $controlador)
    {
        parent::__construct("No existe ningún controlador o clase llamado: {$controlador}");
    }

}
