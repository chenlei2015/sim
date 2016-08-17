<?php
use yii\helpers\Url;
?>

<div>
    <form action="<?=Url::toRoute(['index/index'])?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_csrf" value="<?=\Yii::$app->request->csrfToken?>">
        <input type="file" name="pictrue">
        <input type="submit" value="提交">
    </form>
</div>
<div>
    <?php if(isset($name) && !empty($name)){?>
    <img src="/uploads/<?=$name?>" alt="">
    <?php }?>
</div>



