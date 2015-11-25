<?php

use yii\helpers\Html;
use backend\helpers\sysconfigs;
use backend\models\Comercio;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model backend\models\OrdenComercio */

$this->title = Yii::t('app', 'Create Store Order');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Store Order'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>


<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/js/agregarMarcaMapa.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false&callback=iniciar"></script>

<script>

    initialize();

    <?php foreach($comercios as $comercio){?>

        var dire1 = new google.maps.LatLng($comercio->latitud, $comercio->longitud);
        addMarker(dire1, false);

    <?php } ?>

</script>



<div class="orden-comercio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<div id="map-canvas" style="height: 500px; width: 100%;border: 1px solid black"></div>