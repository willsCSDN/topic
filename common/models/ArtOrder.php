<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "art_order".
 *
 * @property string $order_id
 * @property integer $uid
 * @property integer $auid
 * @property integer $shop_id
 * @property string $item_id
 * @property string $title
 * @property integer $chan_type
 * @property string $img_url
 * @property string $prop_id
 * @property string $order_no
 * @property string $price
 * @property integer $type
 * @property string $mail_no
 * @property string $postage
 * @property string $insurance
 * @property string $name
 * @property string $tel
 * @property string $address
 * @property string $delivery_time
 * @property string $price_total
 * @property string $paid
 * @property string $rate
 * @property string $comm_price
 * @property string $premium_rate
 * @property string $invest_order_id
 * @property string $invest_order_no
 * @property string $create_time
 * @property string $update_time
 * @property integer $status
 * @property integer $reason
 * @property integer $cancel
 * @property string $voucher
 * @property integer $mid
 * @property string $maestro_name
 * @property integer $from_id
 */
class ArtOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'art_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'auid', 'shop_id', 'item_id', 'title', 'img_url', 'order_no', 'premium_rate'], 'required'],
            [['uid', 'auid', 'shop_id', 'item_id', 'chan_type', 'prop_id', 'type', 'invest_order_id', 'status', 'reason', 'cancel', 'mid', 'from_id'], 'integer'],
            [['price', 'postage', 'insurance', 'price_total', 'paid', 'rate', 'comm_price', 'premium_rate'], 'number'],
            [['create_time', 'update_time'], 'safe'],
            [['title', 'order_no', 'mail_no', 'name', 'invest_order_no'], 'string', 'max' => 64],
            [['img_url', 'address', 'voucher'], 'string', 'max' => 512],
            [['tel', 'delivery_time'], 'string', 'max' => 24],
            [['maestro_name'], 'string', 'max' => 48],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => Yii::t('app', '订单主键'),
            'uid' => Yii::t('app', '用户id'),
            'auid' => Yii::t('app', '卖家用户编号'),
            'shop_id' => Yii::t('app', '机构id'),
            'item_id' => Yii::t('app', '商品id'),
            'title' => Yii::t('app', '商品名称'),
            'chan_type' => Yii::t('app', '成交渠道0站内1站外'),
            'img_url' => Yii::t('app', '商品图片'),
            'prop_id' => Yii::t('app', '规格编号'),
            'order_no' => Yii::t('app', '订单号'),
            'price' => Yii::t('app', '订单价格'),
            'type' => Yii::t('app', '1:直售,2:投资,3:转售,4:自留,5:回购'),
            'mail_no' => Yii::t('app', '快递单号'),
            'postage' => Yii::t('app', '邮费'),
            'insurance' => Yii::t('app', '保险费'),
            'name' => Yii::t('app', '收货人'),
            'tel' => Yii::t('app', '收货电话'),
            'address' => Yii::t('app', '收货地址'),
            'delivery_time' => Yii::t('app', '送货时间'),
            'price_total' => Yii::t('app', '总价（商品价格+邮费+保险费）'),
            'paid' => Yii::t('app', '已付金额'),
            'rate' => Yii::t('app', '佣金费率'),
            'comm_price' => Yii::t('app', '佣金'),
            'premium_rate' => Yii::t('app', '回购溢价率'),
            'invest_order_id' => Yii::t('app', '回溯订单编号'),
            'invest_order_no' => Yii::t('app', '回溯订单号'),
            'create_time' => Yii::t('app', '创建时间'),
            'update_time' => Yii::t('app', '修改时间'),
            'status' => Yii::t('app', '状态(0:取消订单,1:待付款,2:付款中,3:待发货,4:待收货 ,6:交易完成 7:投资-回购完成 8:回购-回购完成 10自留)'),
            'reason' => Yii::t('app', '取消订单的理由:0正常1无货2近期内无法交互3艺术品信息有误4其他原因'),
            'cancel' => Yii::t('app', '取消订单:1取消订单2取消订单并将艺术品下架3取消订单并将艺术品标记为售出'),
            'voucher' => Yii::t('app', '交易凭证'),
            'mid' => Yii::t('app', '艺术家id'),
            'maestro_name' => Yii::t('app', 'Maestro Name'),
            'from_id' => Yii::t('app', '支付发起方，1:PC 2:移动'),
        ];
    }
}
