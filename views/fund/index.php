<?php
?>
<ul>
        <li hr="<?=\yii\helpers\Url::to(['fund/one-week'])?>">一周</li>
        <li hr="<?=\yii\helpers\Url::to(['fund/one-month'])?>">一个月</li>
        <li hr="<?=\yii\helpers\Url::to(['fund/three-month'])?>">三个月</li>
        <li hr="<?=\yii\helpers\Url::to(['fund/six-month'])?>">六个月</li>
        <li hr="<?=\yii\helpers\Url::to(['fund/one-year'])?>">一年</li>
        <li hr="<?=\yii\helpers\Url::to(['fund/two-year'])?>">二年</li>
        <li hr="<?=\yii\helpers\Url::to(['fund/three-year'])?>">三年</li>
</ul>

<script>
    $(function () {
        $('ul li').click(function () {
            var url =$(this).attr('hr');
            $.ajax({
                url: url,
                type: 'get',
                dataType:'json',
                success: function (data) {
                    if(data.state == 1 ){
                       alert(data.message);
                    }else{
                       alert('失败');
                    }
                }
            })
        })
    })
</script>
