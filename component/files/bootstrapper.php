<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Files;

use Nooku\Library;

/**
 * Bootstrapper
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Files
 */
 class Bootstrapper extends Library\BootstrapperAbstract
{
    public function bootstrap()
    {
        $this->getClassLoader()
             ->getLocator('psr')
             ->registerNamespace('Imagine', JPATH_VENDOR.'/imagine/imagine/lib');

        $manager = $this->getObjectManager();
        $manager->registerAlias('com:files.database.rowset.directories', 'com:files.database.rowset.folders');
        $manager->registerAlias('com:files.database.row.directory', 'com:files.database.row.folder');
    }
}