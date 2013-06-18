<?
/**
 * Belgian Police Web Platform - Questions Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>

<ul class="nav nav-pills nav-stacked column--triple">
<? foreach ($categories as $category): ?>
    <li>
        <a href="<?= @helper('route.category', array('row' => $category)) ?>">
            <?= $category->title ?>
        </a>
    </li>
<? endforeach ?>
</ul>