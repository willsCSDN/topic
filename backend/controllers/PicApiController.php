<?php

namespace backend\modules\base\controllers;

use Yii;
use yii\web\HttpException;
use common\components\Uploader;
use backend\modules\base\models\Picture;
use backend\models\UploadForm;
use yii\web\UploadedFile;
use common\components\Aliyunoss;
use yii\imagine\Image;
use dosamigos\qrcode\QrCode;
use backend\modules\content\models\Content;
 

/**
 * BuildingController implements the CRUD actions for Building model.
 */
class PicApiController extends \yii\rest\Controller
{

   
/*   protected function getArr($res_data=array(),&$info)
  {
     
      switch (count($res_data))
      {
          case 1:
              $info[$res_data[0]][] = $res_data[0];
              break;
          case 2:
              $info[$res_data[0]][][$res_data[1]][] = $res_data[1];
              break;
          case 3:
              $info[$res_data[0]][][$res_data[1]][][$res_data[2]][]  = $res_data[2];
              break;
          case 4:
              $info[$res_data[0]][][$res_data[1]][][$res_data[2]][][$res_data[3]][]  = $res_data[3];
              break;
          case 5:
              $info[$res_data[0]][][$res_data[1]][][$res_data[2]][][$res_data[3]][][$res_data[4]][]  = $res_data[4];
              break;
          case 6:
              $info[$res_data[0]][][$res_data[1]][][$res_data[2]][][$res_data[3]][][$res_data[4]][$res_data[5]][]  = $res_data[5];
              break;
          default :
      
              break;
      
      }
      return $info;
  }
    
    
    
    
    public function actionGetData()
    {
        $key = 128;
        $arr = [
            0=>[128],
            128=>[129,132],
            129=>[130]
        ];
        $res_data = [
            [128],
            [128,130],
            [128,130,132],
            [128,133],
            [128,133,134],
            [128,133,134,135]
            
            
        ];
        var_dump($res_data);
        $list = [];
        foreach ($res_data as $v)
        {
            $test = $this->getArr($v,$list);
            
        }
         
        var_dump(json_encode($test));die;
  
 
        die;
         
    } */

    /**
     * 图片合成测试
     */
    public function actionComposePic()
    {

        //给图片加文字
        $fontFile = Yii::getAlias('@webroot/fonts/msyhbd.ttf');
        $textOpt = ['color'=>'E1E100','size'=>'70'];
        $save_img = Yii::getAlias('@webroot/base'.build_order_no().'.png');
        image::text(Yii::getAlias('@webroot/base.png'), '没能把所有的旗下主播都培养成年收入百万的主播。', $fontFile ,[400,330],$textOpt)->save($save_img,['quality' => 100]);
         
        
        /**
         * 将二维码印到图片之上
         */
        $img_code = Yii::getAlias('@webroot/base'.build_order_no().'.png');
        
        QrCode::png('http://www.dodobook.net/php/3387',$img_code,0,6);
        
        $res_img = 'base'.build_order_no().'.png';
        var_dump(Yii::getAlias('@webroot/base.png'));
        Image::watermark($save_img,$img_code , [100, 100])
        ->save(Yii::getAlias('@webroot/'.$res_img), ['quality' => 100]);
        var_dump($res_img);die;
    }
    
    public function actionUploadOss()
    {
        $aliyun = new  Aliyunoss();
        $aliyun->test(); 
        $aliyun->upload('test1.jpg', 'D:/wamp/www/sass/backend/web/image/frontend_14890352273245.jpg');
        die;
    }
    //删除文件素材
    public function actionDelete(){
        return response();
    }
    
    
    
    /**
     * 文件上传（体检报告）
     */
    public function actionReport()
    {
        $req = Yii::$app->request;
        if (!$req->isPost) {
           return response(10001,'无效数据');
        }
     
        $getdata = \Yii::$app->request->get();
        if (empty($getdata['username']) || empty($getdata['hos_name']) || empty($getdata['report_sn']) || empty($getdata['token']) || empty($_FILES['file']))
        {
            return response(20001,'无效数据');
        }
        
        if (md5("6666".$getdata['report_sn']) != $getdata['token'])
        {
            return response(20003,'无效token'.md5("6666".$getdata['report_sn']));
        }
       
        
        $model = new Picture();
        /**
         * 将图片存入素材库
         * @var unknown
        */
        $getdata  = $this->picuploadlocal();
        if (empty($getdata))
        {
            return response(20002,'上传失败，请刷新重试');
        } 
        $model->setAttributes($getdata);
        if ($model->validate() && $model->save())
        { 
            
        }
        $this->rec_log(json_encode($getdata));
        return response(0,'success'); 
    }
    
    
    public static function rec_log($content)
    {
       
        $model = new Content();
        $addMsg = [
            'title' => Yii::t('app', '检测报告记录'),
            'content' => Yii::t('app', $content),
            'type' => 102,
        ];
        $model->setAttributes($addMsg);
        return $model->save();
    }
    /**
     * 
     * @param string $pic_type
     * @throws HttpException
     */
    
        public function actionUpload($pic_type='dev'){
        $req = Yii::$app->request;
        if (!$req->isPost) {
            throw new  HttpException(400);
        }
         
        $model = new Picture();
        /**
         * 将图片存入素材库 
         * @var unknown
         */
        $getdata  = $this->picuploadlocal();
        if (empty($getdata))
        {
            return response(20001,'上传失败，请刷新重试',$getdata);
        }
       
        if ($pic_type == 'local')
        {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $getdata['url'] = strstr($getdata['url'], 'backend');
            return $getdata;
        }
        return response(0,'success',$getdata);
    }
    
    public function actionUeUpload(){
        $req = Yii::$app->request;
        if (!$req->isPost) {
            throw new  HttpException(400);
        }
         
        $model = new Picture();
        /**
         * 将图片存入素材库
         * @var unknown
        */
        $getdata  = $this->picuploadlocal('upfile');
        if (empty($getdata))
        {
            return response(20001,'上传失败，请刷新重试',$getdata);
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $getdata;
 
    }
    
    public function actionUploads(){
        $req = Yii::$app->request;
  
        if (!$req->isPost) {
            throw new  HttpException(400);
        }



 
        /**
         * 将图片存入素材库
         * @var unknown
        */
        $getdata  = $this->picuploadlocal('file',true);
        if (empty($getdata))
        {
            return response(20001,'上传失败，请刷新重试',$getdata);
        }

        foreach ($getdata as $v){
            $modle = new Picture();
            $addmsg = [
                'type' => Yii::t('app', 'image'),
                'path' =>  $v['path'],
                'url' => $v['url'],
                'md5' => md5_file($v['path']),
                'sha1' => sha1_file($v['path']),
                'status' => 1,
                'originalname' => $v['name'],
            ];
            $modle->setAttributes($addmsg);
            $modle->save();

        }
        return response(0,'success',$getdata);
    }
    
    /**
     * 处理图片的上传
     */
    protected function picuploadlocal($file='file',$model=FALSE)
    {
        $config = [
            'savePath' => \Yii::getAlias('@webroot/image/'), //存储文件夹
            'maxSize' => 1024*20 ,//允许的文件最大尺寸，单位KB  最大50M
            'allowFiles' => ['.gif' , '.png' , '.jpg' , '.jpeg' , '.bmp'],  //允许的文件格式
        ];
    
        $up = new Uploader($file, $config, 'frontend',$model);
    
        if ($model)
        {
            $info = $up->getFileInfos();
        }
        else {
            $info = $up->getFileInfo();
        }
        
        
        return $info;
    }
    
    
    /**
     * 处理图片的上传
     */
    protected function picupload($model=FALSE)
    {
        $model = new UploadForm();
        $resdata = [];
    
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstanceByName('file');
//             print_r($model->file);die;
            /**
             * 先验证文件是否存在
             * @var unknown
             */
            $ret['md5'] = md5_file($model->file->tempName);
            $ret['sha1'] = sha1_file($model->file->tempName);
            $picModel = Picture::findOne(['md5'=>$ret['md5'],'sha1'=>$ret['sha1']]);
            if (!empty($picModel))
            {
                $resdata['original'] = $picModel->originalname;
                $resdata['type'] = $picModel->type;
                $resdata['size'] = 0;
                $resdata['url'] = $picModel->url;
                $resdata['title'] = $picModel->originalname;
                $resdata['state'] = 'success';
                $resdata['md5'] = $picModel->md5;
                $resdata['sha1'] = $picModel->sha1;
                $resdata['originalname'] = $picModel->originalname;
                $resdata['is_exit'] = true;
                return $resdata;
            }
            
            
            $resdata = $model->upload();
        }
        return $resdata;
    }
}
