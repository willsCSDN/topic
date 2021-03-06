<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "book_label".
 *
 * @property string $id
 * @property string $book_id
 * @property string $label_id
 * @property string $name
 * @property string $created
 * @property string $updated
 */
class BookLabel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_label';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_id', 'label_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'book_id' => Yii::t('app', '书籍ID'),
            'label_id' => Yii::t('app', '标签ID'),
            'name' => Yii::t('app', '标签名称'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->created = date('Y-m-d H:i:s',time());
        }
        $this->updated = date('Y-m-d H:i:s',time());
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}
