<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%member}}".
 *
 * @property integer $member_id
 * @property string $member_name
 * @property string $member_truename
 * @property string $member_avatar
 * @property integer $member_sex
 * @property string $member_birthday
 * @property string $member_passwd
 * @property string $member_paypasswd
 * @property string $member_email
 * @property string $member_qq
 * @property string $member_ww
 * @property integer $member_login_num
 * @property string $member_time
 * @property string $member_login_time
 * @property string $member_old_login_time
 * @property string $member_login_ip
 * @property string $member_old_login_ip
 * @property string $member_qqopenid
 * @property string $member_qqinfo
 * @property string $member_sinaopenid
 * @property string $member_sinainfo
 * @property integer $member_points
 * @property string $available_predeposit
 * @property string $freeze_predeposit
 * @property integer $inform_allow
 * @property integer $is_buy
 * @property integer $is_allowtalk
 * @property integer $member_state
 * @property integer $member_credit
 * @property integer $member_snsvisitnum
 * @property integer $member_areaid
 * @property integer $member_cityid
 * @property integer $member_provinceid
 * @property string $member_areainfo
 * @property string $member_privacy
 * @property string $member_promoter
 * @property string $member_promoterId
 * @property string $member_phone
 * @property string $member_add_id_card
 * @property string $member_add_species
 * @property string $member_add_agricutural_brand
 * @property integer $member_add_land_condition
 * @property string $member_add_farmers_property
 * @property string $member_add_detail_addr
 * @property string $member_add_purchase_plan
 * @property integer $rebate_state
 * @property integer $rebate_add_time
 * @property string $rebate_goods_amount
 * @property string $rebate_get_amount
 * @property string $rebate_refuse_text
 * @property integer $can_eidt_num
 * @property integer $member_login_days
 * @property string $rebate_goods_type
 * @property integer $rebate_is_sent
 * @property integer $rebate_order_num
 * @property integer $app_prize_num
 * @property integer $app_prize_time
 * @property integer $register_method
 * @property integer $prize_num
 * @property integer $prize_time
 * @property string $operator_rebate
 * @property integer $rebate_recommender_id
 * @property integer $is_service
 * @property string $service_name
 * @property integer $service_add_time
 * @property string $service_refuse_text
 * @property string $service_get_amount
 * @property string $operator_service
 * @property string $service_goods_amount
 * @property integer $service_areaid
 * @property string $service_detail_addr
 * @property integer $jr_type
 * @property integer $member_attr
 * @property integer $is_service_center
 * @property string $center_refuse_text
 * @property string $operator_service_center
 * @property string $wechat_bind
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_name', 'member_passwd', 'member_email', 'member_time', 'member_login_time', 'member_old_login_time', 'rebate_goods_amount', 'rebate_get_amount', 'prize_num', 'prize_time', 'operator_rebate', 'is_service', 'service_name', 'service_add_time', 'service_refuse_text', 'service_get_amount', 'operator_service', 'service_goods_amount', 'service_areaid', 'service_detail_addr', 'member_attr', 'center_refuse_text', 'operator_service_center'], 'required'],
            [['member_sex', 'member_login_num', 'member_points', 'inform_allow', 'is_buy', 'is_allowtalk', 'member_state', 'member_credit', 'member_snsvisitnum', 'member_areaid', 'member_cityid', 'member_provinceid', 'member_add_land_condition', 'rebate_state', 'rebate_add_time', 'can_eidt_num', 'member_login_days', 'rebate_is_sent', 'rebate_order_num', 'app_prize_num', 'app_prize_time', 'register_method', 'prize_num', 'prize_time', 'rebate_recommender_id', 'is_service', 'service_add_time', 'service_areaid', 'jr_type', 'member_attr', 'is_service_center'], 'integer'],
            [['member_birthday'], 'safe'],
            [['member_qqinfo', 'member_sinainfo', 'member_privacy', 'wechat_bind'], 'string'],
            [['available_predeposit', 'freeze_predeposit', 'rebate_goods_amount', 'rebate_get_amount', 'service_get_amount', 'service_goods_amount'], 'number'],
            [['member_name', 'member_avatar', 'member_promoter', 'member_promoterId', 'member_phone'], 'string', 'max' => 50],
            [['member_truename', 'member_login_ip', 'member_old_login_ip'], 'string', 'max' => 20],
            [['member_passwd', 'member_paypasswd'], 'string', 'max' => 32],
            [['member_email', 'member_qq', 'member_ww', 'member_qqopenid', 'member_sinaopenid', 'member_add_farmers_property', 'rebate_refuse_text', 'operator_service_center'], 'string', 'max' => 100],
            [['member_time', 'member_login_time', 'member_old_login_time'], 'string', 'max' => 10],
            [['member_areainfo'], 'string', 'max' => 255],
            [['member_add_id_card'], 'string', 'max' => 30],
            [['member_add_species', 'member_add_agricutural_brand', 'member_add_detail_addr', 'service_detail_addr'], 'string', 'max' => 500],
            [['member_add_purchase_plan', 'rebate_goods_type', 'service_refuse_text', 'center_refuse_text'], 'string', 'max' => 200],
            [['operator_rebate', 'operator_service'], 'string', 'max' => 40],
            [['service_name'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'member_id' => 'Member ID',
            'member_name' => 'Member Name',
            'member_truename' => 'Member Truename',
            'member_avatar' => 'Member Avatar',
            'member_sex' => 'Member Sex',
            'member_birthday' => 'Member Birthday',
            'member_passwd' => 'Member Passwd',
            'member_paypasswd' => 'Member Paypasswd',
            'member_email' => 'Member Email',
            'member_qq' => 'Member Qq',
            'member_ww' => 'Member Ww',
            'member_login_num' => 'Member Login Num',
            'member_time' => 'Member Time',
            'member_login_time' => 'Member Login Time',
            'member_old_login_time' => 'Member Old Login Time',
            'member_login_ip' => 'Member Login Ip',
            'member_old_login_ip' => 'Member Old Login Ip',
            'member_qqopenid' => 'Member Qqopenid',
            'member_qqinfo' => 'Member Qqinfo',
            'member_sinaopenid' => 'Member Sinaopenid',
            'member_sinainfo' => 'Member Sinainfo',
            'member_points' => 'Member Points',
            'available_predeposit' => 'Available Predeposit',
            'freeze_predeposit' => 'Freeze Predeposit',
            'inform_allow' => 'Inform Allow',
            'is_buy' => 'Is Buy',
            'is_allowtalk' => 'Is Allowtalk',
            'member_state' => 'Member State',
            'member_credit' => 'Member Credit',
            'member_snsvisitnum' => 'Member Snsvisitnum',
            'member_areaid' => 'Member Areaid',
            'member_cityid' => 'Member Cityid',
            'member_provinceid' => 'Member Provinceid',
            'member_areainfo' => 'Member Areainfo',
            'member_privacy' => 'Member Privacy',
            'member_promoter' => 'Member Promoter',
            'member_promoterId' => 'Member Promoter ID',
            'member_phone' => 'Member Phone',
            'member_add_id_card' => 'Member Add Id Card',
            'member_add_species' => 'Member Add Species',
            'member_add_agricutural_brand' => 'Member Add Agricutural Brand',
            'member_add_land_condition' => 'Member Add Land Condition',
            'member_add_farmers_property' => 'Member Add Farmers Property',
            'member_add_detail_addr' => 'Member Add Detail Addr',
            'member_add_purchase_plan' => 'Member Add Purchase Plan',
            'rebate_state' => 'Rebate State',
            'rebate_add_time' => 'Rebate Add Time',
            'rebate_goods_amount' => 'Rebate Goods Amount',
            'rebate_get_amount' => 'Rebate Get Amount',
            'rebate_refuse_text' => 'Rebate Refuse Text',
            'can_eidt_num' => 'Can Eidt Num',
            'member_login_days' => 'Member Login Days',
            'rebate_goods_type' => 'Rebate Goods Type',
            'rebate_is_sent' => 'Rebate Is Sent',
            'rebate_order_num' => 'Rebate Order Num',
            'app_prize_num' => 'App Prize Num',
            'app_prize_time' => 'App Prize Time',
            'register_method' => 'Register Method',
            'prize_num' => 'Prize Num',
            'prize_time' => 'Prize Time',
            'operator_rebate' => 'Operator Rebate',
            'rebate_recommender_id' => 'Rebate Recommender ID',
            'is_service' => 'Is Service',
            'service_name' => 'Service Name',
            'service_add_time' => 'Service Add Time',
            'service_refuse_text' => 'Service Refuse Text',
            'service_get_amount' => 'Service Get Amount',
            'operator_service' => 'Operator Service',
            'service_goods_amount' => 'Service Goods Amount',
            'service_areaid' => 'Service Areaid',
            'service_detail_addr' => 'Service Detail Addr',
            'jr_type' => 'Jr Type',
            'member_attr' => 'Member Attr',
            'is_service_center' => 'Is Service Center',
            'center_refuse_text' => 'Center Refuse Text',
            'operator_service_center' => 'Operator Service Center',
            'wechat_bind' => 'Wechat Bind',
        ];
    }

    /**
     * @inheritdoc
     * @return MemberQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemberQuery(get_called_class());
    }
}
