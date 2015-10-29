<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Addresses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-address-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ref Address', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'street name',
            'street number',
            'town',
            'region',
            // 'postcode',
            // 'area',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
