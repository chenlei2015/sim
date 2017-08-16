<?php
use yii\helpers\Html;
use app\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="/js/jquery.min.js"></script>
</head>
<body>
<?php $this->beginBody() ?>
<div style="margin: 10px 20px">
<?= $content ?>
<?php $this->endBody() ?>
</div>
</body>
</html>
<?php $this->endPage() ?>
