<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TblMemberAddressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Member Addresses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-member-address-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tbl Member Address', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'address_member_id',
            'address_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
