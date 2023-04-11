<?php 
    class PaymentController extends Controller{

        public function __construct()
        {
            parent::__construct();
            $this->payment = model('PaymentModel');
        }

        public function index() {
            $req = request()->inputs();

            if(isset($req['btn_filter'])) {
                $filter = [
                    'date(payment.created_at)' => [
                        'value' => [$req['start_date'], $req['end_date']],
                        'condition' => 'between'
                    ]
                ];
                $this->data['payments'] = $this->payment->all($filter, 'id desc');
            } else {
                $this->data['payments'] = $this->payment->all(null, 'id desc');
            }
            return $this->view('payment/index', $this->data);
        }

        
    }