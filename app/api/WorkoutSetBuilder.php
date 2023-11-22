<?php 

    class WorkoutSetBuilder extends Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->setItemModel = model('WorkoutSetItemModel');
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

            $this->setItemModel->update([
                'is_completed' => true,
                'last_set_item_taken' => nowMilitary()
            ], $req['id']);

            
        }
    }