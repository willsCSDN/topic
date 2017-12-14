<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "chapter".
 *
 * @property string $id
 * @property string $book_id
 * @property string $name
 * @property string $num
 * @property string $desc
 * @property string $price
 * @property string $path
 * @property integer $is_free
 * @property string $words_num
 * @property string $created
 * @property string $updated
 */
class Chapter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chapter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_id', 'num', 'is_free', 'words_num'], 'integer'],
            [['price'], 'number'],
            [['created', 'updated'], 'safe'],
            [['name'], 'string', 'max' => 20],
            [['desc'], 'string', 'max' => 255],
            [['path'], 'string', 'max' => 512],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '书籍-章节ID'),
            'book_id' => Yii::t('app', '书籍ID'),
            'name' => Yii::t('app', '章节名称'),
            'num' => Yii::t('app', '章节计数'),
            'desc' => Yii::t('app', '章节说明'),
            'price' => Yii::t('app', '价格'),
            'path' => Yii::t('app', '章节文件位置'),
            'is_free' => Yii::t('app', '1：收费2：免费'),
            'words_num' => Yii::t('app', '章节字数'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }
}
