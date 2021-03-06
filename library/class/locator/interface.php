<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2007 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Library;

/**
 * Class Locator Interface
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Library\Class
 */
interface ClassLocatorInterface
{
    /**
     * Constructor
     *
     * @param array $config Array of configuration options.
     */
    public function __construct($config = array());

    /**
     * Register a namespace
     *
     * @param  string $namespace
     * @param  string $paths The location(s) of the namespace
     * @return ClassLocatorInterface
     */
    public function registerNamespace($namespace, $paths);

    /**
     * Registers an array of namespaces
     *
     * @param array $namespaces An array of namespaces (namespaces as keys and locations as values)
     * @return ClassLocatorInterface
     */
    public function registerNamespaces(array $namespaces);

    /**
     * Get the registered namespaces
     *
     * @return array An array with namespaces as keys and path as values
     */
    public function getNamespaces();

    /**
     * Get the locator type
     *
     * @return string
     */
    public function getType();

    /**
     * Get a fully qualified path based on a class name
     *
     * @param  string  $classname The class name
     * @return string|false   Returns canonicalized absolute pathname or FALSE of the class could not be found.
     */
    public function locate($class);
}