<?php 

    class WorkoutSetBuilder extends Controller
    {
        private $setItemModel, $setBuilderModel, $workoutSession;

        public function __construct()
        {
            parent::__construct();
            $this->setItemModel = model('WorkoutSetItemModel');
            $this->setBuilderModel = model('WorkoutSetBuilderModel');
            $this->workoutSession = model('WorkoutSetSessionModel');
        }

        public function getWorkoutList(){
            $req = request()->inputs();

            echo json_encode($this->setItemModel->getAll([
                'where' => [
                    'wsi.workout_set_id' => $req['id']
                ]
            ]));
        }

        public function getWorkout() {
            $req = request()->inputs();
            $workoutSet = $this->setItemModel->get($req['id']);
            $workoutSet->images = [];

            $images = $this->_attachmentModel->all([
                'global_key' => 'WORK_OUT_IMAGE',
                'global_id'  => $req['id']
            ]);

            if(!empty($images)) {
                $imageURLs = [];
                foreach($images as $key => $image) {
                    $imageURLs[] = $image->full_url;
                }
                $workoutSet->images = $imageURLs;
            }

            echo json_encode($workoutSet);
        }

        public function completeWorkout() {
            $req = request()->inputs();
            $item = $this->setItemModel->get($req['id']);

            $this->setItemModel->update([
                'is_completed' => true,
                'last_set_item_taken' => nowMilitary()
            ], $req['id']);

            //check if all items are complete

            if($this->setItemModel->isAllComplete($item->workout_set_id)) {
                $this->setBuilderModel->complete($item->workout_set_id);
                $set = $this->setBuilderModel->get($item->workout_set_id);

                $this->workoutSession->addSession([
                    'schedule' => $set->schedule,
                    'user_id'  => $set->user_id,
                    'session_date' => today()
                ]);
            }
         }

         public function getSession() {
            $req = request()->inputs();
            $startDate = date('Y-m-d', strtotime('-1 month'));
            $dateNow = today();

            $workouts = $this->workoutSession->all([
                'user_id' => $req['user_id'],
                'session_date' => [
                    'condition' => 'between',
                    'value' => [
                        $startDate, $dateNow
                    ]
                ]
            ]);

            $retVal = [];
            if(!empty($workouts)) {
                foreach($workouts as $key => $row) {
                    $retVal[] = [
                        'date' => $row->session_date,
                        'title' => 'Completed'
                    ];
                }
            }
            echo json_encode($retVal);
         }
    }