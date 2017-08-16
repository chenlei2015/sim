<?php
use yii\helpers\Url;
?>
    <table class="table table-bordered">
        <caption>边框表格布局</caption>
        <thead>
        <tr>
            <th>名称</th>
            <th>名称</th>
            <th>名称</th>
            <th>城市</th>
            <th>邮编</th>
            <th>邮编</th>
            <th>邮编</th>
            <th id="add">添加</th>
        </tr>
        </thead>
        <tbody id="content">
        <?php foreach ($data as $v){ ?>
               <tr>
                   <td><label><input class="form-control" style="width: 50px" type="text" name="qi" placeholder="" value="<?=?>"></label></td>
                   <td><label><input class="form-control" style="width: 100px" type="text" name="hao" placeholder="" value="<?=?>"></label></td>
                   <td>
                       <label class="radio-inline"><input type="radio" name="wan"  <?=$v['wan']==1?'checked':''?> value="1">44444</label>
                       <label class="radio-inline"> <input type="radio" name="wan" <?=$v['wan']==2?'checked':''?>  value="2">44444</label>
                       <label class="radio-inline"> <input type="radio" name="wan" <?=$v['wan']==3?'checked':''?>  value="3">44444</label>
                       <label class="radio-inline"><input class="form-control" name="wan_bei" style="width: 70px" type="text" placeholder=""></label>
                   </td>
                   <td>
                       <label class="radio-inline"> <input type="radio" name="qian" <?=$v['qian']==1?'checked':''?> value="1">44444</label>
                       <label class="radio-inline"> <input type="radio" name="qian" <?=$v['qian']==2?'checked':''?> value="2">44444</label>
                       <label class="radio-inline"> <input type="radio" name="qian" <?=$v['qian']==3?'checked':''?> value="3">44444</label>
                       <label class="radio-inline"><input class="form-control" name="qian_bei" style="width: 70px" type="text" placeholder=""></label>
                   </td>
                   <td>
                       <label class="radio-inline"> <input type="radio" name="bai"  <?=$v['bai']==3?'checked':''?> value="1">44444</label>
                       <label class="radio-inline"> <input type="radio" name="bai"  <?=$v['bai']==3?'checked':''?> value="2">44444</label>
                       <label class="radio-inline"> <input type="radio" name="bai"  <?=$v['bai']==3?'checked':''?> value="3">44444</label>
                       <label class="radio-inline"><input class="form-control" name="bai_bei" style="width: 70px" type="text" placeholder=""></label>
                   </td>
                   <td>
                       <label class="radio-inline"> <input type="radio" name="shi"   value="1">44444</label>
                       <label class="radio-inline"> <input type="radio" name="shi"   value="2">44444</label>
                       <label class="radio-inline"> <input type="radio" name="shi"   value="3">44444</label>
                       <label class="radio-inline"><input class="form-control" name="shi_bei" style="width: 70px" type="text" placeholder=""></label>
                   </td>
                   <td>
                       <label class="radio-inline"> <input type="radio" name="ge"    value="1">44444</label>
                       <label class="radio-inline"> <input type="radio" name="ge"    value="2">44444</label>
                       <label class="radio-inline"> <input type="radio" name="ge"    value="3">44444</label><label class="radio-inline">
                           <input class="form-control" name="ge_bei" style="width: 70px" type="text" placeholder=""></label>
                   </td>
                   <td class="save">删除</td>
               </tr>
        <?php } ?>
        </tbody>
    </table>
<script>
    $(function () {
          var html='<tr>'+
              '<td><label><input class="form-control" style="width: 50px" type="text" name="qi" placeholder=""></label></td>' +
              '<td><label><input class="form-control" style="width: 100px" type="text" name="hao" placeholder=""></label></td>' +
              '<td><label class="radio-inline"> <input type="radio" name="wan"   value="1">44444</label><label class="radio-inline"> <input type="radio" name="wan"   value="2">44444</label><label class="radio-inline"> <input type="radio" name="wan"   value="3">44444</label><label class="radio-inline"><input class="form-control" name="wan_bei" style="width: 70px" type="text" placeholder=""></label></td>' +
              '<td><label class="radio-inline"> <input type="radio" name="qian"  value="1">44444</label><label class="radio-inline"> <input type="radio" name="qian"  value="2">44444</label><label class="radio-inline"> <input type="radio" name="qian"  value="3">44444</label><label class="radio-inline"><input class="form-control" name="qian_bei" style="width: 70px" type="text" placeholder=""></label></td>' +
              '<td><label class="radio-inline"> <input type="radio" name="bai"   value="1">44444</label><label class="radio-inline"> <input type="radio" name="bai"   value="2">44444</label><label class="radio-inline"> <input type="radio" name="bai"   value="3">44444</label><label class="radio-inline"><input class="form-control" name="bai_bei" style="width: 70px" type="text" placeholder=""></label></td>' +
              '<td><label class="radio-inline"> <input type="radio" name="shi"   value="1">44444</label><label class="radio-inline"> <input type="radio" name="shi"   value="2">44444</label><label class="radio-inline"> <input type="radio" name="shi"   value="3">44444</label><label class="radio-inline"><input class="form-control" name="shi_bei" style="width: 70px" type="text" placeholder=""></label></td>' +
              '<td><label class="radio-inline"> <input type="radio" name="ge"    value="1">44444</label><label class="radio-inline"> <input type="radio" name="ge"    value="2">44444</label><label class="radio-inline"> <input type="radio" name="ge"    value="3">44444</label><label class="radio-inline"><input class="form-control" name="ge_bei" style="width: 70px" type="text" placeholder=""></label></td>' +
              '<td class="save">删除</td>' +
              '<tr>';

          $("#add").click(function () {
              $("#content").append(html);
          })

          $("table").on('click','.save',function () {
                   var  qi=$(this).siblings().children('label').children("input[name='qi']").val();
                   var  hao=$(this).siblings().children('label').children("input[name='hao']").val();
                   var  wan=$(this).siblings().children('label').children("input[name='wan']:checked").val();
                   var  wan_bei=$(this).siblings().children('label').children("input[name='wan_bei']").val();
                   var  qian=$(this).siblings().children('label').children("input[name='qian']:checked").val();
                   var  qian_bei=$(this).siblings().children('label').children("input[name='qian_bei']").val();
                   var  bai=$(this).siblings().children('label').children("input[name='bai']:checked").val();
                   var  bai_bei=$(this).siblings().children('label').children("input[name='bai_bei']").val();
                   var  shi=$(this).siblings().children('label').children("input[name='shi']:checked").val();
                   var  shi_bei=$(this).siblings().children('label').children("input[name='shi_bei']").val();
                   var  ge=$(this).siblings().children('label').children("input[name='ge']:checked").val();
                   var  ge_bei=$(this).siblings().children('label').children("input[name='ge_bei']").val();

                   $.ajax({
                       url:'<?=Url::to(['win/save'])?>',
                       type:'post',
                       data:{'qi':qi,'hao':hao,'wan':wan,'wan_bei':wan_bei,'qian':qian,'qian_bei':qian_bei,'bai':bai,'bai_bei':bai_bei,'shi':shi,'shi_bei':shi_bei,'ge':ge,"ge_bei":ge_bei},
                       dataType:'json',
                       success: function(data){

                       }
                   })
          })

    })
</script>
