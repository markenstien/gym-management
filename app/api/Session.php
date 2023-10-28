<?php 

    class Session extends Controller
    {
        public $model;
        public function __construct()
        {
            $this->model = model('SessionModel');
        }

        public function autoUpdate() {
            $this->model->updateDailySession();
        }
    }