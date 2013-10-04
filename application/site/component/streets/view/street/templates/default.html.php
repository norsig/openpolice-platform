<? if($street->id) : ?>
<ktml:module position="left">
    <img src="http://maps.googleapis.com/maps/api/staticmap?center=<?= $street->title ?>,Leuven,Belgium&zoom=12&size=200x400&maptype=roadmap
&markers=color:blue%7Clabel:S%7C<?= $street->title ?>,Leuven,Belgium&sensor=false">
</ktml:module>

<h1><?= $street->title ?></h1>

<? $articles = object('com:traffic.model.articles')->street($street->id)->getRowset(); ?>

<? $categories = object('com:categories.model.categories')->table('traffic')->getRowset(); ?>

<? foreach($categories as $category) : ?>
    <? $items = $articles->find(array('categories_category_id' => $category->id)) ?>
    <? if(count($items)) : ?>
    <h2><?= $category->title ?></h2>
    <? foreach($items as $article) : ?>
        <h3>
            <?= helper('date.format', array('date'=> $article->start_on, 'format' => translate('DATE_FORMAT_LC3'), 'attribs' => array('class' => 'dtstart'))) ?>
            <? if($article->end_on && ($article->end_on != $article->start_on)) : ?>
                <?= translate('till') ?>
                <?= helper('date.format', array('date'=> $article->end_on, 'format' => translate('DATE_FORMAT_LC3'), 'attribs' => array('class' => 'dtend'))); ?>
            <? endif ?>

            <small>
                <?= $article->title ?>
            </small>
        </h3>
        <?= $article->text ?>
    <? endforeach ?>
<? endif ?>
<? endforeach ?>
<? endif ?>