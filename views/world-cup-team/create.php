<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\WorldCupTeam */

$this->title = Yii::t('app', 'Create World Cup Team');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'World Cup Teams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="world-cup-team-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
