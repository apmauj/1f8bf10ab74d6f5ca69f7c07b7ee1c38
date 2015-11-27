<?php
use dmstr\widgets\Alert;
use yii\widgets\Breadcrumbs;

?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?php
            if ($this->title !== null) {
                //echo $this->title;
            } else {
                echo \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($this->context->module->id));
                echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
            } ?>
        </h1>
        <?php if (Yii::$app->user->isGuest == false) { ?>

            <?=
            Breadcrumbs::widget(
                [
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]
            );
            ?>
        <?php } ?>
    </section>

    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>