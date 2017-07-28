<?php
?>

<div class="time">时间</div>
<div class="button">按钮</div>

<script>
    $(function () {
        $(".time"). click(function () {
            var int=self.setInterval("clock()",1000);
            function clock()
            {
                var d=new Date();
                var t=d.toLocaleTimeString();
                $(".time").text(t);
            }
        })
    })
</script>
