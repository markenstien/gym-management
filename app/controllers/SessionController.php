<?php

use Services\UserService;

    class SessionController extends Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->paymentModel = model('PaymentModel');
            $this->userModel = model('UserModel');
        }

        public function create() {

            if(isSubmitted()) {

                $post = request()->posts();

                $paymentData = [
                    'amount' => $post['amount'],
                    'payment_method' => $post['payment_method'],
                    'remarks' => $post['description'],
                    'payment_key' => 'SESSION_PAYMENT'
                ];
                //check if type of customer
                if (isEqual($post['customer_type'], 'member')) {
                    $isUserExist =$this->userModel->single([
                        'user_type' => UserService::MEMBER,
                        'username' => trim($post['user_key_word'])
                    ]);

                    if(!$isUserExist) {
                        Flash::set("Member ID Does not exists");
                        return request()->return();
                    }
                    $paymentData['payer_name'] = $isUserExist->firstname . ' ' .$isUserExist->lastname;
                    $paymentData['order_id']   = $isUserExist->id;
                    //check if member id exists                    
                } else {
                    $paymentData['payer_name'] = $post['user_key_word'];
                }
                
                $isOkay = $this->paymentModel->createOrUpdate($paymentData);

                if($isOkay) {
                    Flash::set("Payment approved");
                    return redirect(_route('session:create'));
                }else{
                    Flash::set("Something went wrong");
                    return request()->return();
                }
            }
            return $this->view('session/create');
        }
    }