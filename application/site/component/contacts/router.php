<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

/**
 * Router
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Component\Contacts
 */
class ContactsRouter extends Library\DispatcherRouter
{
    public function build(Library\HttpUrl $url)
    {
        $segments = array();
        $query    = &$url->query;

        if(isset($query['Itemid'])) {
            $page = $this->getObject('application.pages')->getPage($query['Itemid']);
        } else {
            $page = $this->getObject('application.pages')->getActive();
        }

        $view = $page->getLink()->query['view'];

        if($view == 'categories')
        {
            if(isset($query['category'])) {
                $segments[] = $query['category'];
            }

            if(isset($query['id'])) {
                $segments[] = $query['id'];
            }
        }

        if($view == 'contacts')
        {
            if(isset($query['id'])) {
                $segments[] = $query['id'];
            }
        }

        if(isset($query['view']) && $query['view'] == 'message') {
            $segments[] = 'message';
        }

        unset($query['category']);
        unset($query['id']);
        unset($query['view']);

        return $segments;
    }

    public function parse(Library\HttpUrl $url)
    {
        $vars = array();
        $path = &$url->path;

        $page = $this->getObject('application.pages')->getActive();

        $view  = $page->getLink()->query['view'];
        $count = count($path);

        if($view == 'categories')
        {
            if ($count)
            {
                $count--;
                $segment = array_shift( $path );

                $vars['category'] = $segment;
                $vars['view'] = 'contacts';
            }

            if ($count)
            {
                $count--;
                $segment = array_shift( $path ) ;

                $vars['id'] = $segment;
                $vars['view'] = 'contact';
            }
        }

        if($view == 'contacts')
        {
            $segment = array_shift( $path) ;

            $vars['id'] = $segment;
            $vars['view'] = 'contact';
        }

        if(count($path) && $path[0] == 'message') {
            $vars['view'] = 'message';
        }

        return $vars;
    }
}

