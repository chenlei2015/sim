<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\ticket\Code;

class TicketController extends Controller
{
       public  function actionIndex(){
           $src = 'http://kaijiang.500.com/static/public/ssc/xml/qihaoxml/20170627.xml?_A=ZLYTUPDA'.time().mt_rand(100,999);
           $xml=file_get_contents($src);
           $xml = simplexml_load_string($xml);
           $data=[];
           for ($i = 0; $i < count($xml->row); $i++) {
               $code = new code();
               $p = $xml->row[$i]->attributes()->expect;
               $code->no = substr($p, 0, 8) . '-' . substr($p, -3, 3);
               $code_str = (array)$xml->row[$i]->attributes()->opencode;
               $codes = explode(',', $code_str[0]);
               $code->wan = intval($codes[0]);
               $code->wan_type=in_array(intval($codes[0]),[3,4,5,6,7])?1:0;
               $code->qian = intval($codes[1]);
               $code->qian_type=in_array(intval($codes[1]),[3,4,5,6,7])?1:0;
               $code->bai = intval($codes[2]);
               $code->bai_type=in_array(intval($codes[2]),[3,4,5,6,7])?1:0;
               $code->shi = intval($codes[3]);
               $code->shi_type=in_array(intval($codes[3]),[3,4,5,6,7])?1:0;
               $code->ge = intval($codes[4]);
               $code->ge_type=in_array(intval($codes[4]),[3,4,5,6,7])?1:0;
               $time = (array)$xml->row[$i]->attributes()->opentime;
               $add_time = $data[$i]['time'] = strtotime($time[0]);
               $code->time = $add_time;
               $code->save();
           }
       }


    /**
     * 文章编辑功能
     * @param string $article_id
     * @return string|\yii\web\Response
     */
    public function actionArticleEdit($article_id = '')
    {
        $model = $article_id ? PackageArticleForm::findOne($article_id) : new PackageArticleForm();
        if($model == null){
            throw new NotFoundHttpException('不存在的记录');
        }
        $model->setScenario('edit');
        if($model->load(\Yii::$app->request->post()) && $model->save()){
            \Yii::$app->session->setFlash('success','编辑成功');
            return $this->redirect(\Yii::$app->request->referrer);
        }
        return $this->renderAjax('article_edit',[
            'model' => $model
        ]);
    }

    /**
     * 删除文章
     * @param $article_id
     * @return \yii\web\Response
     */
    public function actionArticleDelete($article_id)
    {
        $model = PackageArticleForm::findOne($article_id);
        ($model != null && $model->delete())
            ? \Yii::$app->session->setFlash('success','删除成功')
            : \Yii::$app->session->setFlash('error','删除失败');
        return $this->redirect(\Yii::$app->request->referrer);
    }

    /**
     * 图册列表
     * @param $crop_id
     * @return string
     */
    public function actionGallery($crop_id)
    {
        $searchModel = new PackageGallerySearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams,$crop_id);
        return $this->render('gallery', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 编辑图册
     * @param string $gallery_id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionGalleryEdit($gallery_id ='')
    {
        $model = $gallery_id ? PackageGalleryForm::findOne($gallery_id) : new PackageGalleryForm();
        if ($model == null) {
            throw new NotFoundHttpException('不存在的记录');
        }
        $model->setScenario('edit');
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', '编辑成功');
            return $this->redirect(\Yii::$app->request->referrer);
        }
        return $this->renderAjax('gallery_edit', [
            'model' => $model
        ]);
    }


       public function actionShow(){
               $data=Yii::$app->request->get();
               $query=Code::find();
               if(!empty($data['begin'])){
                  $query->andWhere(['between','time',$data['begin'],$data['end']]);
               }else{
                   $query->andWhere(['between','time',strtotime(date('Y-m-d',time())),time()]);
               }
               if(!empty($data['num'])){
                   $query->limit($data['num']);
               }
               $condition=$query;
               $query=clone $condition;
               $codes=$query->asArray()->all();
               unset($query);
               $query=clone $condition;
               $nei[] =$query->andWehere(['wan_type'=>1])->count();
               unset($query);
               $query=clone $condition;
               $nei[] =$query->andWehere(['qian_type'=>1])->count();
               unset($query);
               $query=clone $condition;
               $nei[] =$query->andWehere(['bai_type'=>1])->count();
               unset($query);
               $query=clone $condition;
               $nei[] =$query->andWehere(['shi_type'=>1])->count();
               unset($query);
               $query=clone $condition;
               $nei[] =$query->andWehere(['ge_type'=>1])->count();
               unset($query);

               $query=clone $condition;
               $wai[] =$query->andWehere(['wan_type'=>0])->count();
               unset($query);
               $query=clone $condition;
               $wai[] =$query->andWehere(['qian_type'=>0])->count();
               unset($query);
               $query=clone $condition;
               $wai[] =$query->andWehere(['bai_type'=>0])->count();
               unset($query);
               $query=clone $condition;
               $wai[] =$query->andWehere(['shi_type'=>0])->count();
               unset($query);
               $query=clone $condition;
               $wai[] =$query->andWehere(['ge_type'=>0])->count();
               unset($query);

               $wan_count_nei=0;
               $wan_count_wai=0;
               $wan_count_nei_arr=[];
               $wan_count_wai_arr=[];
               foreach ($codes as $code ){
                     if($code['wan_type']){
                         array_push($wan_count_wai_arr,$wan_count_wai);
                         $wan_count_nei++;
                         $wan_count_wai=0;
                     }else{
                         array_push($wan_count_nei_arr,$wan_count_nei);
                         $wan_count_wai++;
                         $wan_count_nei=0;
                     }
               }
               $wan_value_nei_count=array_count_values ($wan_count_nei_arr);
               $wan_value_wai_count=array_count_values ($wan_count_wai_arr);
               $wan_nei_count=[
                   $wan_value_nei_count[1]?:0,$wan_value_nei_count[2]?:0,$wan_value_nei_count[2]?:0,$wan_value_nei_count[4]?:0,
                   $wan_value_nei_count[5]?:0,$wan_value_nei_count[6]?:0,$wan_value_nei_count[7]?:0,$wan_value_nei_count[8]?:0,
                   $wan_value_nei_count[9]?:0,$wan_value_nei_count[10]?:0,$wan_value_nei_count[11]?:0,$wan_value_nei_count[12]?:0,
                   $wan_value_nei_count[13]?:0,$wan_value_nei_count[14]?:0,$wan_value_nei_count[15]?:0,$wan_value_nei_count[16]?:0,
               ];
              $wan_wai_count=[
                   $wan_value_wai_count[1]?:0,$wan_value_wai_count[2]?:0,$wan_value_wai_count[2]?:0,$wan_value_wai_count[4]?:0,
                   $wan_value_wai_count[5]?:0,$wan_value_wai_count[6]?:0,$wan_value_wai_count[7]?:0,$wan_value_wai_count[8]?:0,
                   $wan_value_wai_count[9]?:0,$wan_value_wai_count[10]?:0,$wan_value_wai_count[11]?:0,$wan_value_wai_count[12]?:0,
                   $wan_value_wai_count[13]?:0,$wan_value_wai_count[14]?:0,$wan_value_wai_count[15]?:0,$wan_value_wai_count[16]?:0,
               ];
               return $this->render('show',[
                   'nei'=>$nei,
                   'wai'=>$wai,
                   'codes'=>$codes,
                   'wan_nei_count'=>$wan_nei_count,
                   'wan_wai_count'=>$wan_wai_count,
               ]);
       }
}