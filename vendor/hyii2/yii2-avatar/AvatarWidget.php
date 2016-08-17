<?php
namespace hyii2\avatar;
/**
 * 设置挂件
 * @author 上班偷偷打酱油 （xianan_huang@163.com）
 * @copyright Yii中文网 （www.yii-china.com）
 */
use Yii;
use yii\bootstrap\Widget;
use hyii2\avatar\assets\AvatarAsset;

class AvatarWidget extends Widget
{
    public  $imageUrl;
    public function init()
    {
       parent::init();
        if($this->imageUrl===null){
            $this->imageUrl= '/uploads/thumb-test-image.jpg';
        }else{
            $this->imageUrl=$this->imageUrl;
        }
    }
    
    public function run()
    {
        //$this->registerClientScript();
        return $this->render('index',['url'=>$this->imageUrl]);
    }
    
    public function registerClientScript()
    {
        AvatarAsset::register($this->view);
        //$script = "FormFileUpload.init();";
        //$this->view->registerJs($script, View::POS_READY);
    }
}