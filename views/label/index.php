<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/* @var $this yii\web\View */
/* @var $data yii\data\ActiveDataProvider */
/* @var $sort string */
/* @var $country string */
/* @var $tag string */
/* @var $search string */

use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'Labels - '.app()->name;
?>
<?php Pjax::begin() ?>
    <div class="row">
        <div id="tile-search" class="col-xs-12 col-sm-4">
            <?= $this->render('_search', [
                'sort' => $sort,
                'country' => $country,
                'tag' => $tag,
                'search' => $search,
                'total' => $data->totalCount,
            ]) ?>
            <h2>Labels</h2>
        </div>
        <div class="col-xs-12 col-sm-8">
            <div id="tile-container" class="row">
                <?php /* @var $model app\models\Label */ ?>
                <?php foreach ($data->models as $model): ?>
                    <div class="col-xs-12 col-sm-6 list">
                        <div class="thumbnail">
                            <div class="caption">
                                <?= Html::a(h($model->name), h($model->url), [
                                    'class' => 'external-link',
                                    'rel' => 'noopener',
                                    'target' => '_blank',
                                ]) ?>
                                <br>
                                <div class="label label-default">
                                    <?= h($model->getAttributeLabel('country')) ?>:
                                </div>
                                <?= h($model->country) ?>
                                <br>
                                <div class="label label-default">
                                    <?= h($model->getAttributeLabel('link')) ?>:
                                </div>
                                <?= formatter()->asSnsIconLink($model->link, "\n", custom_domains_for_as_sns_icon_link(), [
                                    'rel' => 'noopener',
                                    'target' => '_blank',
                                ]) ?>
                                <br>
                                <span class="label label-default"><?= h($model->getAttributeLabel('tagValues')) ?>:</span>
                                <?php foreach ($model->labelTags as $tag): ?>
                                    <?= Html::a(h($tag->name), ['', 'tag' => $tag->name], [
                                        'class' => 'label label-default',
                                    ]) ?>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div><!-- /.row -->

            <?= $this->render('/common/pagination', ['pagination' => $data->pagination]) ?>
        </div>
    </div><!-- /.row -->
<?php Pjax::end() ?>

<?= $this->render('/common/js/tile-list') ?>
