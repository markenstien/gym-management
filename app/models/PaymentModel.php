<?php

class PaymentModel extends Model
{
    public $table = 'payments';

    const SESSION_WITH_INSTRUCTOR = 'SESSION_PAYMENT_INSTRUCTOR';
    public $_fillables = [
        'order_id',
        'reference',
        'payment_key',
        'payer_name',
        'amount',
        'net_amount',
        'internal_remarks',
        'payment_method',
        'mobile_number',
        'address',
        'remarks',
        'organization',
        'account_number',
        'external_reference',
        'created_by'
    ];

    public function createOrUpdate($paymentData, $id = null) {
        $_fillables = parent::getFillablesOnly($paymentData);
        
        if (!is_null($id)) {
            return parent::update($_fillables, $id);
        } else {
            $_fillables['reference'] = $this->generateRefence();
            $_fillables['is_approved'] = true;
            $_fillables['created_by'] =  whoIs('id');
            return parent::store($_fillables);
        }
    }

    public function addMultipleOrder($paymentData) {
        
        if(!isset($paymentData['orders'])) {
            $this->addError("Orders not set!");
            return false;
        }

        $this->orderModel = model('OrderModel');
        $retVal = [];
        $orders = $paymentData['orders'];

        $payment = $paymentData['payment'];
        $ordersInfo = $this->orderModel->all([
            'id' => [
                'condition' => 'in',
                'value' => $orders
            ]
        ]);

        if(!$ordersInfo) {
            $this->addError("No such reports");
            return false;
        }
        $total = 0;
        foreach($ordersInfo as $key => $row) {
            $total += $row->net_amount;
        }

        if($total < $payment['amount']) {
            $this->addError("Insuficient Payment");
            return false;
        }

        foreach($ordersInfo as $key => $row) {
            $paymentData = array_merge($payment, [
                'amount' => $row->net_amount,
                'order_id' => $row->id,
            ]);

            $paymentId = $this->createOrUpdate($paymentData);
            
            if($paymentId) {
                $retVal['paymentData'][] = $paymentData;
                $retVal['paymentId'][] = $paymentId;

                $this->orderModel->update([
                    'is_paid' => true
                ], $row->id);
            }
            
        }

        $retVal['orders'] = $orders;
        $retVal['payment'] = $payment;
        $retVal['payment'] = $payment;
        $retVal['totaal'] = $total;

        return $retVal;
    }

    public function getOrderPayment($id) {
        return parent::single(['order_id'=>$id]);
    }

    public function generateRefence() {
        return number_series(random_number(7));
    }

    public function delete($id) {
        $payment = parent::get($id);
        if(!$payment) {
            $this->addError("Payment not found.");
            return false;
        }

        $orderModel = model('OrderModel');
        $order = $orderModel->get([
            'order_id' => $payment->order_id
        ]);

        $isOkay = parent::delete($id);

        if ($isOkay) {
            $this->addMessage("Payment Removed");
            if ($order) {
                $orderModel->update([
                    'is_paid' => false
                ], $order->id);
            }
            return true;
        } else {
            $this->addError("unable to delete payments");
            return false;
        }
    }

    public function all($where = '' , $order_by = '' , $limit = '') {
        if(!empty($where)) {
            $where = " WHERE ".parent::conditionConvert($where);
        } else {
            $where = '';
        }

        if(!empty($order_by)) {
            $order_by  = " ORDER BY {$order_by}";
        }

        $this->db->query(
            "SELECT payment.*,
                CONCAT(staff.firstname , ' ',staff.lastname) as staff_name,
                CONCAT(member.firstname , ' ',member.lastname) as member_name
                FROM {$this->table} as payment

                LEFT JOIN users as staff
                ON staff.id = payment.created_by
                
                LEFT JOIN users as member
                    ON member.id = payment.order_id
                    
                {$where}{$order_by}"
        );

        return $this->db->resultSet();
    }

    public function approve($id) {
        $payment = parent::get($id);
        $result = parent::update([
            'is_approved' => true
        ], $id);

        if(!$result) {
            $this->addError("Payment approved failed.");
            return false;
        }else{
            $this->orderModel = model('OrderModel');
            $this->orderModel->update([
                'is_paid' => true,
            ], $payment->order_id);
            $this->addMessage("Payment approved");
            return true;
        }
    }
}