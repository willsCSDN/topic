<?php

namespace backend\controllers;

use mdm\admin\models\User;
use Yii;
use common\models\Department;
use backend\models\DepartmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DepartmentController implements the CRUD actions for Department model.
 */
class DepartmentController extends Controller
{

    /**
     * Lists all Department models.
     * @return mixed
     */
    public function actionIndex()
    {

        $model= new Department();
        $items = $model->getItem();
        $tree = $this->generateTree($items);
        return $this->render('indextest',[
            'tree'=> $tree,
        ]);
    }

    /**
     * Displays a single Department model.
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
     * Creates a new Department model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Department();

        if ($model->load(Yii::$app->request->post())) {
            if($model->id == $model->fid) {
                \Yii::$app->getSession()->setFlash('error', '创建失败,请重试！');
                return $this->redirect(['index']);
            }
            if($model->fid != 0) {
                $res = $this->findModel($model->fid);
                if($res->fid != 0) {
                    \Yii::$app->getSession()->setFlash('error', '创建失败,请重试！');
                    return $this->redirect(['index']);
                }
            }
            $model->created = date('Y-m-d H:i:s');
            if($model->save()) {
                \Yii::$app->getSession()->setFlash('success', '创建成功！');
            } else {
                \Yii::$app->getSession()->setFlash('error', '创建失败,请重试！');
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Department model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $fid  = $model->fid;
        if ($model->load(Yii::$app->request->post())) {
            if($model->id == $model->fid) {
                \Yii::$app->getSession()->setFlash('error', '修改失败,请重试！');
                return $this->redirect(['index']);
            }
            if($fid != $model->fid) {
                $res = Department::find()->where(['fid'=>$model->id])->all();
                if($res) {
                    \Yii::$app->getSession()->setFlash('error', '该部门下有其他子部门，请迁移后在再进行修改！');
                    return $this->redirect(['index']);
                }
            }

            $model->save();
            \Yii::$app->getSession()->setFlash('success', '修改成功！');
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Department model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $data = $this->findModel($id);
        $res = Department::find()->where(['fid'=>$data->id])->all();
        if($res) {
            \Yii::$app->getSession()->setFlash('error', '该部门下有其他子部门，请迁移后在再进行删除！');
            return $this->redirect(['index']);
        }
        $user_res = \backend\models\User::find()->where(['department_id'=>$data->id])->all();
        if($user_res) {
            \Yii::$app->getSession()->setFlash('error', '该部门下已有员工数据，请迁移后在再进行删除！');
            return $this->redirect(['index']);
        }
        $data->delete();
        \Yii::$app->getSession()->setFlash('success', '删除成功！');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Department model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Department the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Department::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function generateTree($items){
        $tree = array();
        foreach($items as $item){
            if(isset($items[$item['fid']])){
                $items[$item['fid']]['son'][] = &$items[$item['id']];
            }else{
                $tree[] = &$items[$item['id']];
            }
        }
        return $tree;
    }
}
