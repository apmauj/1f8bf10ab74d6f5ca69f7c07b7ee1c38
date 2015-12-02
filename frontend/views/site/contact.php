<?php
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */
$asset = frontend\assets\AppAsset::register($this);
$baseUrl = $asset->baseUrl;
$this->title = Yii::t('app', 'Contact');
?>
<style>
    section {
        background-image: url("<?=$baseUrl?>/images/mulirelevadores/contact.png");
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }
</style>

<div >
    <br>
    <h2 style="color: whitesmoke; margin-left: 100px;">
        <?= Yii::t('app', 'If you have business inquiries or other questions, please fill out the following form to contact us.'); ?>
    </h2>
    <br>
    <div >
        <div style="width:40%;margin-left: 100px; padding-right: auto; color: whitesmoke">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'subject') ?>
                <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
                <div >
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
