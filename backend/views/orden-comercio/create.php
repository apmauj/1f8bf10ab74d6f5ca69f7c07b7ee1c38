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

    var map;
    var geocoder;
    var originIcon = 'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=O|FFFF00|000000';
    var ubicacion = new google.maps.LatLng("<?php echo $inicio->latitud; ?>", "<?php echo $inicio->longitud; ?>");
    var titulo = "<?php echo Yii::t('app', 'Name: ').$inicio->username;?> ?>";

    var origins = [ubicacion];
    var destinations = [];

    <?php foreach($comercios as $comercio){?>
        alert(<?= $comercio->latitud ?> + "  -  " + <?= $comercio->longitud ?>);
        var dire1 = new google.maps.LatLng("<?php echo $comercio->latitud; ?>", "<?php echo $inicio->longitud; ?>");

        destinations.push(dire1);

    <?php } ?>

    alert("lenght = " + destinations.length);

    calculateDistances(origins, destinations);

    function initMap() {

        var map = new google.maps.Map(document.getElementById('map-canvas'), {
            zoom: 16,
            center: ubicacion
        });

        var marker = new google.maps.Marker({
            position: ubicacion,
            map: map,
            title: titulo
        });

        console.log(marker);
    }
    google.maps.event.addDomListener(window, 'load', initMap);






</script>



<div class="orden-comercio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<div id="map-canvas" style="height: 500px; width: 100%;border: 1px solid black"></div>