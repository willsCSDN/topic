<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "banner".
 *
 * @property integer $id
 * @property string $name
 * @property string $img_url
 * @property string $param
 * @property string $remark
 * @property integer $status
 * @property integer $type
 * @property string $create_time
 * @property integer $seat_id
 * @property string $update_time
 * @property integer $sort
 * @property string $content
 * @property integer $show_type
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status', 'type', 'seat_id', 'sort', 'show_type'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 64],
            [['img_url', 'param', 'remark'], 'string', 'max' => 512],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', '广告名称'),
            'img_url' => Yii::t('app', '展示图片'),
            'param' => Yii::t('app', '链接/参数'),
            'remark' => Yii::t('app', '备注'),
            'status' => Yii::t('app', '状态 1：正常 -1 删除'),
            'type' => Yii::t('app', '显示状态  1：显示 2：隐藏'),
            'create_time' => Yii::t('app', '发布时间'),
            'seat_id' => Yii::t('app', '位置主键 1：患者端banner 2：医生端banner 3：官网banner 4：广告 5：商城banner 6：集团展示图片'),
            'update_time' => Yii::t('app', '更新时间'),
            'sort' => Yii::t('app', '排序'),
            'content' => Yii::t('app', '富文本'),
            'show_type' => Yii::t('app', '展现方式 1：无点击效果 2：web链接  3： 富文本 4： app 跳转 '),
        ];
    }
}
