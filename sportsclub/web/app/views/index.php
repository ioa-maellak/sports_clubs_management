<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RefRolesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-roles-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ref Roles', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'role_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
