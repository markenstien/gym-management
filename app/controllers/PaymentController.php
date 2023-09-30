<?php 
    class PaymentController extends Controller{

        public function __construct()
        {
            parent::__construct();
            $this->payment = model('PaymentModel');
            $this->whoIs = whoIs();
        }

        public function index() {
            $req = request()->inputs();
            $defaultFilter = [];

            if(isEqual(whoIs('user_type'),'member')){
                $defaultFilter['order_id'] = whoIs('id');
            }

            if(isset($req['btn_filter'])) {
                $defaultFilter['date(payment.created_at)'] = [
                    'value' => [$req['start_date'], $req['end_date']],
                    'condition' => 'between'
                ];                
                $this->data['payments'] = $this->payment->all($defaultFilter, 'id desc');
            } else {
                $this->data['payments'] = $this->payment->all($defaultFilter, 'id desc');
            }
            return $this->view('payment/index', $this->data);
        }

        public function show() {
            
        }
        
    }