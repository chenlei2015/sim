<?php
use yii\helpers\Url;
?>
<link href="/assets/3de91c3f/css/cropper.min.css" rel="stylesheet">
<link href="/assets/3de91c3f/css/main.css" rel="stylesheet">
<link href="/assets/3de91c3f/css/site.css" rel="stylesheet">
<link href="/assets/d19ae8c1/css/bootstrap.css" rel="stylesheet">
<link href="/css/site.css" rel="stylesheet">
</script><script src="/assets/bdd7c59e/jquery.js"></script>
<script src="/assets/f98ec72f/yii.js"></script>
<script src="/assets/3de91c3f/js/cropper.min.js"></script>
<script src="/assets/3de91c3f/js/main.js"></script>
<script src="/assets/3de91c3f/js/site.js"></script>
<script src="/assets/d19ae8c1/js/bootstrap.js"></script>
<div class="panel">
    <div class="menu-title">
        <span>账户设置</span>
    </div>
    <div class="panel-body">
        <div class="set-avatar">
            <label>头像设置</label>
            <div id="crop-avatar">
                <div class="avatar-view">
                  <img src="/uploads/default.jpg" alt="Avatar">
                </div>
        
                <!-- Cropping modal -->
                <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <form class="avatar-form" action="<?=Url::toRoute(['avatar/index'])?>" enctype="multipart/form-data" method="post">
                          <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken?>">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title" id="avatar-modal-label">头像上传</h4>
                        </div>
                        <div class="modal-body">
                          <div class="avatar-body">
            
                            <!-- Upload image and data -->
                            <div class="avatar-upload">
                              <input type="hidden" class="avatar-src" name="avatar_src">
                              <input type="hidden" class="avatar-data" name="avatar_data">
                              <label for="avatarInput">本地上传：</label>
                              <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
                            </div>
            
                            <!-- Crop and preview -->
                            <div class="row">
                              <div class="col-md-9">
                                <div class="avatar-wrapper"></div>
                              </div>
                              <div class="col-md-3">
                                <div class="avatar-preview preview-lg"></div>
                                <div class="avatar-preview preview-md"></div>
                                <div class="avatar-preview preview-sm"></div>
                              </div>
                            </div>
            
                            <div class="row avatar-btns">
                              <div class="col-md-3">
                                <button type="submit" class="btn btn-hyii btn-block avatar-save">上传</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div><!-- /.modal -->
        
            <!-- Loading state -->
            <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
          </div>
        </div>
        <div class="set-avatar">
            <label>个人资料</label>
            <div>...</div>
        </div>
    </div>
</div>