<?php
/**
 * 卖家确认发货接口请求类
 * @author Administrator
 *
 */
class AlipaySendConfirmRequest
{
	// 接口类型
    private $service = "send_goods_confirm_by_platform";
    // 支付宝交易号 不可为空
    public $trade_no = "";
    // 物流公司名称 不可为空
    public $logistics_name = "";
    // 物流发货单号
    public $invoice_no = "";
    // 发货时的运输类型  $transport_type 与 $create_transport_type 不能同时为空
    // 类型如下：POST EXPRESS EMS DIRECT
    public $transport_type = "";
    // 创建交易时时的运输类型
    public $create_transport_type = "";
    // 卖家IP
    public $seller_ip = "";

    public function getParams() {
        return array(
            'service'=>$this->service,
            'trade_no'=>$this->trade_no,
            'logistics_name'=>$this->logistics_name,
            'invoice_no'=>$this->invoice_no,
            'transport_type'=>$this->transport_type,
            'create_transport_type'=>$this->create_transport_type,
            'seller_ip'=>$this->seller_ip,
        );
    }
}