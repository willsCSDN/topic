<?php

namespace backend\controllers;

use common\models\BookAgent;
use Yii;
use common\models\Book;
use backend\models\BookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller
{

    /**
     * Lists all Book models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionIndexAgent()
    {
        $searchModel = new BookSearch();
        $searchModel->is_agent = 1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index-agent', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    //    批量加入分销库
    public function actionBatchAdd(){
        $req = Yii::$app->request->post();
        if(empty($req['ids'])){
            echo "您什么都没有选中";die;
        }
        $ids = $req['ids'];
        Book::updateAll(['is_agent' => 1], ['in', 'id', $ids]);
        foreach($ids as $value){
            $judge = BookAgent::findOne(['']);
            if(!$judge){
                $model = new BookAgent();
                $model->book_id = $value;
                $model->save();
            }
        }
        echo "添加成功";die;
    }

    //    批量删除
    public function actionBatchCancel(){
        $req = Yii::$app->request->post();
        if(empty($req['ids'])){
            echo "您什么都没有选中";die;
        }
        $ids = $req['ids'];
        Book::updateAll(['is_shelve' => 3], ['in', 'id', $ids]);
        echo "删除成功";die;
    }

    //    批量上架
    public function actionShelveUp(){
        $req = Yii::$app->request->post();
        if(empty($req['ids'])){
            echo "您什么都没有选中";die;
        }
        $ids = $req['ids'];
//        Book::updateAll(['is_shelve' => 3], ['in', 'id', $ids]);
        echo "删除成功";die;
    }

    //    批量下架
    public function actionShelveDown(){
        $req = Yii::$app->request->post();
        if(empty($req['ids'])){
            echo "您什么都没有选中";die;
        }
        $ids = $req['ids'];
//        Book::updateAll(['is_shelve' => 3], ['in', 'id', $ids]);
        echo "删除成功";die;
    }

    //    分销书籍批量删除
    public function actionShelveDelete(){
        $req = Yii::$app->request->post();
        if(empty($req['ids'])){
            echo "您什么都没有选中";die;
        }
        $ids = $req['ids'];
//        Book::updateAll(['is_shelve' => 3], ['in', 'id', $ids]);
        echo "删除成功";die;
    }




    /**
     * Displays a single Book model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Book();
//        $req = Yii::$app->request->post();
//        print_r($req);die;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    //章节编辑
    public function actionUpdateChapter($id)
    {
        $this->redirect(['chapter/index', 'id' => $id]);
    }

    /**
     * Deletes an existing Book model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
