<?php

namespace Gof\Sistema\Formulario\Interfaz;

/**
 * Interfaz con constantes predefinidas de errores
 *
 * @package Gof\Sistema\Formulario\Interfaz
 */
interface Errores
{
    /**
     * @var int Indica que el campo no existe en los datos recibidos
     */
    public const ERROR_CAMPO_INEXISTENTE = 1;

    /**
     * @var int Indica que el valor del campo no es un string válido
     */
    public const ERROR_NO_ES_STRING = 200;

    /**
     * @var int Indica que el valor del campo no es un int válido
     */
    public const ERROR_NO_ES_INT = 201;
}