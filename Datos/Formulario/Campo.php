<?php

namespace Gof\Datos\Formulario;

use Gof\Datos\Errores\Mensajes\Error;
use Gof\Interfaz\Formulario\Campo as ICampo;

/**
 * Dato de tipo campo para almacenar información
 *
 * Clase creada para el sistema de formularios que almacena información típica y básica de
 * un campo de un formulario como: clave, valor, tipo y errores.
 *
 * @package Gof\Datos\Formulario
 */
class Campo implements ICampo
{
    /**
     * Clave asociada al campo
     *
     * En un formulario sería el valor del atributo *name* de un campo.
     *
     * @var string
     */
    public string $clave;

    /**
     * @var int Tipo de dato.
     */
    public int $tipo;

    /**
     * @var Error Almacena el o los errores asociados al campo.
     */
    public Error $error;

    /**
     * @var mixed Valor del campo
     */
    public mixed $valor;

    /**
     * Constructor
     *
     * @param string $clave Clave asociada al campo del formulario.
     * @param int    $tipo  Tipo de dato del campo.
     */
    public function __construct(string $clave, int $tipo = 0)
    {
        $this->valor = null;
        $this->tipo  = $tipo;
        $this->clave = $clave;
        $this->error = new Error();
    }

    /**
     * Clave asociada al campo
     *
     * @return string Devuelve el nombre del campo.
     */
    public function clave(): string
    {
        return $this->clave;
    }

    /**
     * Obtiene el tipo de dato del campo
     *
     * @return int Devuelve el tipo de dato.
     */
    public function tipo(): int
    {
        return $this->tipo;
    }

    /**
     * Obtiene el valor del campo
     *
     * @return mixed Devuelve el valor que tiene el campo.
     */
    public function valor(): mixed
    {
        return $this->valor;
    }

    /**
     * Lista de errores
     *
     * Almacena errores asociados al campo.
     *
     * @return Error Devuelve una instancia de la lista interna de errores.
     */
    public function error(): Error
    {
        return $this->error;
    }

}