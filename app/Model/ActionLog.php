<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ActionLog extends Model
{
    const SHOPOWNERREGISTER = 1;
    const SHOPOWNERAPPROVE = 2;
    const SHOPOWNERLOGIN = 3;
    const SHOPADDPRODUCT = 4;
    const SHOPUPDATEPRODUCT = 5;
    const SHOPDELETEPRODUCT = 6;
    const SHOPUPDATEORDER = 7;
    const SHOPADDCOUPON = 8;
    const SHOPUPDATECOUPON = 9;
    const SHOPDELETECOUPON = 10;

    public function getText() {
        switch($this->type) {
            case ActionLog::SHOPOWNERREGISTER : 
                return "Account register";
            break;
            case ActionLog::SHOPOWNERAPPROVE : 
                return "Account Approve";
            break;
            case ActionLog::SHOPOWNERLOGIN : 
                return "Account Login";
            break;
            case ActionLog::SHOPADDPRODUCT : 
                return "Product Added";
            break;
            case ActionLog::SHOPUPDATEPRODUCT : 
                return "Product Updated";
            break;
            case ActionLog::SHOPDELETEPRODUCT : 
                return "Product Deleted";
            break;
            case ActionLog::SHOPUPDATEORDER : 
                return "Order Updated";
            break;
            case ActionLog::SHOPADDCOUPON : 
                return "Coupon Added";
            break;
            case ActionLog::SHOPUPDATECOUPON : 
                return "Coupon Updated";
            break;
            case ActionLog::SHOPDELETECOUPON : 
                return "Coupon Deleted";
            break;
        }
    }

    static function shopRegister($shop_id, $shopOwnerId) {
        $actionLog = new ActionLog();
        $actionLog->shop_id = $shop_id;
        $data = [];
        $data['shop_owner'] = $shopOwnerId;
        $actionLog->log_event = json_encode($data);
        $actionLog->type = ActionLog::SHOPOWNERREGISTER;
        $actionLog->save();
    }
    
    static function shopApprove($shop_id, $adminId) {
        $actionLog = new ActionLog();
        $actionLog->shop_id = $shop_id;
        $data = [];
        $data['admin_id'] = $adminId;
        $actionLog->log_event = json_encode($data);
        $actionLog->type = ActionLog::SHOPOWNERAPPROVE;
        $actionLog->save();
    }

    static function shopLogin($shop_id, $shopOwnerId) {
        $actionLog = new ActionLog();
        $actionLog->shop_id = $shop_id;
        $data = [];
        $data['shop_owner'] = $shopOwnerId;
        $actionLog->log_event = json_encode($data);
        $actionLog->type = ActionLog::SHOPOWNERLOGIN;
        $actionLog->save();
    }
    
    static function shopAddProduct($shop_id, $shopOwnerId, $productId) {
        $actionLog = new ActionLog();
        $actionLog->shop_id = $shop_id;
        $data = [];
        $data['shop_owner'] = $shopOwnerId;
        $data['product_id'] = $productId;
        $actionLog->log_event = json_encode($data);
        $actionLog->type = ActionLog::SHOPADDPRODUCT;
        $actionLog->save();
    }
    
    static function shopUpdateProduct($shop_id, $shopOwnerId, $productId) {
        $actionLog = new ActionLog();
        $actionLog->shop_id = $shop_id;
        $data = [];
        $data['shop_owner'] = $shopOwnerId;
        $data['product_id'] = $productId;
        $actionLog->log_event = json_encode($data);
        $actionLog->type = ActionLog::SHOPUPDATEPRODUCT;
        $actionLog->save();
    }
    
    static function shopDeleteProduct($shop_id, $shopOwnerId, $productId) {
        $actionLog = new ActionLog();
        $actionLog->shop_id = $shop_id;
        $data = [];
        $data['shop_owner'] = $shopOwnerId;
        $data['product_id'] = $productId;
        $actionLog->log_event = json_encode($data);
        $actionLog->type = ActionLog::SHOPDELETEPRODUCT;
        $actionLog->save();
    }
    
    static function shopAddCoupon($shop_id, $shopOwnerId, $couponId) {
        $actionLog = new ActionLog();
        $actionLog->shop_id = $shop_id;
        $data = [];
        $data['shop_owner'] = $shopOwnerId;
        $data['coupon_id'] = $couponId;
        $actionLog->log_event = json_encode($data);
        $actionLog->type = ActionLog::SHOPADDCOUPON;
        $actionLog->save();
    }
    
    static function shopUpdateCoupon($shop_id, $shopOwnerId, $couponId) {
        $actionLog = new ActionLog();
        $actionLog->shop_id = $shop_id;
        $data = [];
        $data['shop_owner'] = $shopOwnerId;
        $data['coupon_id'] = $couponId;
        $actionLog->log_event = json_encode($data);
        $actionLog->type = ActionLog::SHOPUPDATECOUPON;
        $actionLog->save();
    }
    
    static function shopDeleteCoupon($shop_id, $shopOwnerId, $couponId) {
        $actionLog = new ActionLog();
        $actionLog->shop_id = $shop_id;
        $data = [];
        $data['shop_owner'] = $shopOwnerId;
        $data['coupon_id'] = $couponId;
        $actionLog->log_event = json_encode($data);
        $actionLog->type = ActionLog::SHOPDELETECOUPON;
        $actionLog->save();
    }
}
