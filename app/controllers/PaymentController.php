<?php 
    class PaymentController extends Controller{

        public function __construct()
        {
            parent::__construct();
            $this->payment = model('PaymentModel');
        }

        public function index() {
            $this->data['payments'] = $this->payment->all();
            return $this->view('payment/index', $this->data);
        }

        
    }