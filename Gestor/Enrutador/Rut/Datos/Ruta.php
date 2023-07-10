<?php

namespace Gof\Gestor\Enrutador\Rut\Datos;

use Gof\Gestor\Enrutador\Rut\Interfaz\Ruta as IRuta;

/**
 * Ruta con datos para el gestor de rutas
 *
 * @package Gof\Gestor\Enrutador\Rut\Datos
 */
class Ruta implements IRuta
{
    /**
     * @var array<int, IRuta> Lista de nodos hijos.
     */
    private array $nodos;

    /**
     * @var string[] Lista de páginas asociadas a la clase.
     */
    private array $paginas;

    /**
     * @var bool Indica si la ruta contempla parámetros o no.
     */
    private bool $parametros;

    /**
     * @var string Nombre completo de la clase.
     */
    private string $nombreClase;

    /**
     * Constructor
     *
     * @param string $pagina Nombre del recurso (URL) que apuntará a la clase.
     * @param string $clase  Nombre de la clase a la que apuntará.
     */
    public function __construct(string $pagina, string $nombreClase)
    {
        $this->nodos = [];
        $this->alias($pagina);
        $this->parametros = false;
        $this->nombreClase = $nombreClase;
    }

    /**
     * Agrega una nueva ruta hijo al array interno
     *
     * @param IRuta $nodo Nuevo nodo hijo.
     *
     * @return IRuta Devuelve una instancia del mismo nodo recibido por parámetro.
     */
    public function agregar(IRuta $nodo): IRuta
    {
        return $this->nodos[] = $nodo;
    }

    /**
     * Crea un nuevo alias para la clase
     *
     * Agrega un nuevo recurso que apuntará a la misma clase.
     *
     * @param string $pagina Nombre del recurso que apuntará a la clase.
     */
    public function alias(string $pagina)
    {
        $this->paginas[] = $pagina;
    }

    /**
     * Obtiene el nombre completo de la clase asociada
     *
     * @return string Devuelve el nombre de la clase
     */
    public function clase(): string
    {
        return $this->nombreClase;
    }

    /**
     * Obtiene una lista con los recursos asociados a la clase
     *
     * @return array Devuelve una lista de páginas asociadas a la clase
     */
    public function paginas(): array
    {
        return $this->paginas;
    }

    /**
     * Obtiene los nodos hijos
     *
     * @return array Devuelve el conjunto de nodos hijos
     */
    public function hijos(): array
    {
        return $this->nodos;
    }

    /**
     * Indica si el nodo tiene parámetros
     *
     * @return bool Devuelve **true** si tiene parámetros o **false** de lo contrario.
     */
    public function parametros(?bool $tiene = null): bool
    {
        return $tiene === null ? $this->parametros : $this->parametros = $tiene;
    }

}
