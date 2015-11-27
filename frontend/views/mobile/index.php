<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jQuery Mobile: Theme Download</title>
    <link rel="stylesheet" href="/frontend/views/mobile/themes/mulisrelevadores.min.css" />
    <link rel="stylesheet" href="/frontend/views/mobile/themes/jquery.mobile.icons.min.css" />
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>


<!--<div data-role="page" data-theme="a">-->
<!--    <div data-role="header" data-position="inline">-->
<!--        <h1>It Worked!</h1>-->
<!--    </div>-->
<!--    <div data-role="content" data-theme="a">-->
<!--        <p>Your theme was successfully downloaded. You can use this page as a reference for how to link it up!</p>-->
<!--			<pre>-->
<!--<strong>&lt;link rel=&quot;stylesheet&quot; href=&quot;themes/mulisrelevadores.min.css&quot; /&gt;</strong>-->
<!--<strong>&lt;link rel=&quot;stylesheet&quot; href=&quot;themes/jquery.mobile.icons.min.css&quot; /&gt;</strong>-->
<!--&lt;link rel=&quot;stylesheet&quot; href=&quot;http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css&quot; /&gt;-->
<!--&lt;script src=&quot;http://code.jquery.com/jquery-1.11.1.min.js&quot;&gt;&lt;/script&gt;-->
<!--&lt;script src=&quot;http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js&quot;&gt;&lt;/script&gt;-->
<!--			</pre>-->
<!--        <p>This is content color swatch "A" and a preview of a <a href="#" class="ui-link">link</a>.</p>-->
<!--        <label for="slider1">Input slider:</label>-->
<!--        <input type="range" name="slider1" id="slider1" value="50" min="0" max="100" data-theme="a" />-->
<!--        <fieldset data-role="controlgroup"  data-type="horizontal" data-role="fieldcontain">-->
<!--            <legend>Cache settings:</legend>-->
<!--            <input type="radio" name="radio-choice-a1" id="radio-choice-a1" value="on" checked="checked" />-->
<!--            <label for="radio-choice-a1">On</label>-->
<!--            <input type="radio" name="radio-choice-a1" id="radio-choice-b1" value="off"  />-->
<!--            <label for="radio-choice-b1">Off</label>-->
<!--        </fieldset>-->
<!--    </div>-->
<!--</div>-->





<div class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main" data-role="page" id="home">

    <div data-theme="a" data-form="ui-body-a" class="ui-body ui-body-a ui-corner-all">
        <p>Body</p>
        <p>
            Sample text and <a data-form="ui-link-a" href="#" data-theme="a">links</a>.
        </p>
    </div>

    <ul data-role="listview" data-inset="true">
        <li data-role="list-divider" data-theme="a" data-swatch="a" data-form="ui-bar-a">List Header</li>
        <li data-form="ui-body-a" data-swatch="a" data-theme="a">Read-only list item</li>
        <li><a class="ui-btn-a ui-btn ui-btn-icon-right ui-icon-carat-r" data-form="ui-btn-up-a" data-swatch="a" data-theme="a" href="#rutas">Linked list item</a></li>
    </ul>

    <div data-role="fieldcontain">
        <fieldset data-role="controlgroup">
            <input data-theme="a" type="radio" name="radio-choice-a" id="radio-choice-1-a" value="choice-1" checked="checked" />
            <label for="radio-choice-1-a" data-form="ui-btn-up-a">Radio</label>

            <input data-theme="a" type="checkbox" name="checkbox-a" id="checkbox-a" checked="checked" />
            <label for="checkbox-a" data-form="ui-btn-up-a">Checkbox</label>

        </fieldset>
    </div>

    <div data-role="fieldcontain">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <input data-theme="a" type="radio" name="radio-view-a" id="radio-view-a-a" value="list" checked="checked"/>
            <label for="radio-view-a-a" data-form="ui-btn-up-a">On</label>
            <input data-theme="a" type="radio" name="radio-view-a" id="radio-view-b-a" value="grid" />
            <label for="radio-view-b-a" data-form="ui-btn-up-a">Off</label>
        </fieldset>
    </div>

    <div data-role="fieldcontain">
        <select name="select-choice" id="select-choice-a" data-native-menu="false" data-theme="a" data-form="ui-btn-up-a">
            <option value="standard">Option 1</option>
            <option value="rush">Option 2</option>
            <option value="express">Option 3</option>
            <option value="overnight">Option 4</option>
        </select>
    </div>

    <a class="ui-btn-a ui-btn ui-btn-icon-right ui-icon-carat-r" data-form="ui-btn-up-a" data-swatch="a" data-theme="a" href="rutas.php">Linked list item</a>


    <input type="text" data-theme="a" value="Text Input" class="input" data-form="ui-body-a" />

    <div data-role="fieldcontain">
        <input type="range" name="slider" value="50" min="0" max="100" data-form="ui-body-a" data-theme="a" data-highlight="true" />
    </div>

    <button data-icon="star" data-theme="a" data-form="ui-btn-up-a">Button</button>
</div>



<div class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main" data-role="page" id="rutas">

    <div data-role="fieldcontain">
        <input type="range" name="slider" value="50" min="0" max="100" data-form="ui-body-a" data-theme="a" data-highlight="true" />
    </div>    <div data-role="fieldcontain">
        <input type="range" name="slider" value="50" min="0" max="100" data-form="ui-body-a" data-theme="a" data-highlight="true" />
    </div>


</div>




<div class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main" data-role="page" id="pedidos">


    <div data-role="fieldcontain">
        <input type="range" name="slider" value="50" min="0" max="100" data-form="ui-body-a" data-theme="a" data-highlight="true" />
    </div>

    <div data-role="fieldcontain">
        <input type="range" name="slider" value="50" min="0" max="100" data-form="ui-body-a" data-theme="a" data-highlight="true" />
    </div>


</div>




<div class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main" data-role="page" id="stock">

    <div data-role="fieldcontain">
        <input type="range" name="slider" value="50" min="0" max="100" data-form="ui-body-a" data-theme="a" data-highlight="true" />
    </div>

    <div data-role="fieldcontain">
        <input type="range" name="slider" value="50" min="0" max="100" data-form="ui-body-a" data-theme="a" data-highlight="true" />
    </div>

</div>



</body>
</html>


<!--<div class="site-index">-->
<!---->
<!--    <div class="jumbotron">-->
<!--        var_dump(file_get_contents('http://localhost/yii2-grupo8/api/web/v1/productos'));-->
<!--    </div>-->
<!---->
<!--</div>-->
