<?
/**
 * Belgian Police Web Platform - About Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<?= helper('behavior.keepalive') ?>
<?= helper('behavior.validator') ?>

<!--
<script src="assets://js/koowa.js" />
-->

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<? if($article->isTranslatable()) : ?>
    <ktml:module position="actionbar" content="append">
        <?= helper('com:languages.listbox.languages', array('attribs' => array('disabled' => 'true'))) ?>
    </ktml:module>
<? endif ?>

<form action="" method="post" id="article-form" class="-koowa-form">
    <input type="hidden" name="published" value="0" />
    <input type="hidden" name="attachments_attachment_id" value="0" />

    <div class="main">
        <div class="title">
            <input class="required" type="text" name="title" maxlength="255" value="<?= escape($article->title) ?>" placeholder="<?= translate('Title') ?>" />
            <div class="slug">
                <span class="add-on"><?= translate('Slug') ?></span>
                <input type="text" name="slug" maxlength="255" value="<?= escape($article->slug) ?>" />
            </div>
        </div>
        <?= object('com:ckeditor.controller.editor')->render(array('name' => 'text', 'text' => $article->text, 'attribs' => array('class' => 'ckeditor-required'))) ?>
    </div>
    <div class="sidebar">
        <?= import('default_sidebar.html'); ?>
    </div>
</form>
