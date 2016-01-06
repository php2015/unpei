<?php

/* 修理厂采购订单状态 */
define('ORDER_SUBMITTED', 0);                   // 针对货到付款而言，他的下一个状态是卖家已发货
define('ORDER_PENDING', 1);                     // 等待买家付款
define('ORDER_ACCEPTED', 2);                    // 买家已付款，等待卖家发货
define('ORDER_SHIPPED', 3);                     // 卖家已发货
define('ORDER_FINISHED', 9);                    // 交易成功
define('ORDER_CANCELED', 10);                   // 交易已取消

/* 经销商采购订单状态 */
define('DORDER_READY', 0);                      // 等待买家付款 (初始订单)
define('DORDER_PENDING', 10);                   // 买家已付款，等待卖家发货
define('DORDER_ACCEPTED', 20);                  // 卖家已发货，等待买家收货  // status  20  
define('DORDER_SELLED', 10);                    // 卖家已发货，等待买家收货 // send_status 10  上面这两个状态同时改  
define('DORDER_SHIPPED', 30);                   // 验货通过                // status  30 
define('DORDER_TAKED', 30);                     // 验货通过                // take_status 30 
define('DORDER_ABNORMAL', 30);                  // 验货通过                // abn_status  30  这三个状态等于30 才验货通过
define('DORDER_ABANDON', 40);                 // 废弃订单
define('DORDER_FINISHED', 100);                 // 交易成功
define('DORDER_CANCLED', 40);                  // 交易已取消

/* 经销商采购退货状态 */
define('RORDER_READY', 1);                      // 退货待审核
define('RORDER_PENDING', 2);               // 卖家已退款，等待买家发货
define('RORDER_ACCEPTED',3);                // 退货待收货  （等待卖家收货）
define('RORDER_ABNORMAL', 4);              // 退货完成              
define('RORDER_ABANDON', 5);                 // 审核不通过
define('RORDER_FINISHED', 100);                 // 交易成功
define('RORDER_CANCLED', 6);                  // 交易已取消


