<?php
/**
 * Created by PhpStorm.
 * User: El Perro
 * Date: 30/11/2015
 * Time: 03:04
 */
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use scotthuangzl\googlechart\GoogleChart;

?>
<div class="col-sm-5">
    <?php


    echo GoogleChart::widget(array('visualization' => 'PieChart',
        'data' => array(
            array('Task', 'Hours per Day'),
            array('Work', 5),
            array('Eat', 5),
            array('Commute', 2),
            array('Watch TV', 2),
            array('Sleep', 7)
        ),
        'options' => array('title' => 'My Daily Activity')));
    echo GoogleChart::widget(array('visualization' => 'LineChart',
        'data' => array(
            array('Task', 'Hours per Day'),
            array('Work', 11),
            array('Eat', 2),
            array('Commute', 2),
            array('Watch TV', 2),
            array('Sleep', 7)
        ),
        'options' => array('title' => 'My Daily Activity')));

    echo GoogleChart::widget(array('visualization' => 'LineChart',
        'data' => array(
            array('Year', 'Sales', 'Expenses'),
            array('2004', 1000, 400),
            array('2005', 1170, 460),
            array('2006', 660, 1120),
            array('2007', 1030, 540),
        ),
        'options' => array(
            'title' => 'My Company Performance2',
            'titleTextStyle' => array('color' => '#FF0000'),
            'vAxis' => array(
                'title' => 'Scott vAxis',
                'gridlines' => array(
                    'color' => 'transparent'  //set grid line transparent
                )),
            'hAxis' => array('title' => 'Scott hAixs'),
            'curveType' => 'function', //smooth curve or not
            'legend' => array('position' => 'bottom'),
        )));
    echo GoogleChart::widget( array('visualization' => 'Gauge', 'packages' => 'gauge',
        'data' => array(
            array('Label', 'Value'),
            array('Memory', 80),
            array('CPU', 55),
            array('Network', 68),
        ),
        'options' => array(
            'width' => 400,
            'height' => 120,
            'redFrom' => 90,
            'redTo' => 100,
            'yellowFrom' => 75,
            'yellowTo' => 90,
            'minorTicks' => 5
        )
    ));
    echo GoogleChart::widget( array('visualization' => 'Map',
        'packages'=>'map',//default is corechart
        'loadVersion'=>1,//default is 1.  As for Calendar, you need change to 1.1
        'data' => array(
            ['Country', 'Population'],
            ['China', 'China: 1,363,800,000'],
            ['India', 'India: 1,242,620,000'],
            ['US', 'US: 317,842,000'],
            ['Indonesia', 'Indonesia: 247,424,598'],
            ['Brazil', 'Brazil: 201,032,714'],
            ['Pakistan', 'Pakistan: 186,134,000'],
            ['Nigeria', 'Nigeria: 173,615,000'],
            ['Bangladesh', 'Bangladesh: 152,518,015'],
            ['Russia', 'Russia: 146,019,512'],
            ['Japan', 'Japan: 127,120,000']
        ),
        'options' => array('title' => 'My Daily Activity',
            'showTip'=>true,
        )));
    ?>
</div>


