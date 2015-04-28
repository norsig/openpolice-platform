<?
/**
 * Belgian Police Web Platentry - Forms Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platentry
 */
?>

<!--
<script src="assets://js/koowa.js" />
<style src="assets://css/koowa.css" />
-->

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<form action="" method="get" class="-koowa-grid">
    <?= import('default_scopebar.html'); ?>
    <table>
        <thead>
        <tr>
            <th width="10">
                <?= helper( 'grid.checkall'); ?>
            </th>
            <th width="1"></th>
            <th width="100%">
                <?= helper('grid.sort', array('column' => 'title')) ?>
            </th>
            <th width="100%">
                <?= helper('grid.sort', array('column' => 'email')) ?>
            </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="7">
                <?= helper('com:application.paginator.pagination', array('total' => $total)) ?>
            </td>
        </tr>
        </tfoot>
        <tbody>
        <? foreach ($entries as $entry) : ?>
            <tr>
                <td align="center">
                    <?= helper('grid.checkbox', array('row' => $entry))?>
                </td>
                <td align="center">
                    <?= helper('grid.enable', array('row' => $entry, 'field' => 'published')) ?>
                </td>
                <td class="ellipsis">
                    <a href="<?= route( 'view=entry&task=edit&id='.$entry->id ); ?>">
                        <?= escape($entry->title) ?>
                    </a>
                </td>
                <td>
                    <?= $entry->email ?>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
</form>