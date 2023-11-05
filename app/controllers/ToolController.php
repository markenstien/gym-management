<?php 
    require_once LIBS.DS.'tdeecalc/vendor/autoload.php';
    // Calculations based on weight, height and age

use isfonzar\TDEECalculator\Models\Formulas\TDEEFormula;
use isfonzar\TDEECalculator\Models\Options\TDEEOptions;
use isfonzar\TDEECalculator\Models\Primitives\Activity;
use isfonzar\TDEECalculator\Models\Unit;
use isfonzar\TDEECalculator\TDEECalculator;

    class ToolController extends Controller
    {
        public function tdeeCalculator() {
            $req = request()->inputs();
            $tdeeCalculator = new TDEECalculator([
                'formula' => TDEEFormula::MifflinStJeor,
                'unit'    => Unit::METRIC
            ]);

            $lifeStyleArray = [
                Activity::NO_ACTIVITY => 'No Activity',
                Activity::SEDENTARY => 'Much sitting and little physical exercise',
                Activity::LIGHT_ACTIVE => 'Little Active',
                Activity::VERY_ACTIVE => 'Very Active',
            ];

            $data = [
                'lifeStyleArray' => $lifeStyleArray
            ];

            if(isSubmitted()) {
                $this->sessionRemarkModel = model('SessionRemarkModel');
                $post = request()->posts();

                if(!empty($post['btn_save_tdee'])) {
                    $dataValues = unseal($post['data_values']);
                    $queryStringFromSession = unseal($req['q']);

                    $tdeeCalculatorCalariePerDay = $tdeeCalculator->calculate(
                        $dataValues['gender'],
                        $dataValues['weight'],
                        $dataValues['height'],
                        $dataValues['age'],
                        $dataValues['life_style']
                    );
    
                    $tdeeCalculatorCalariePerWeek = $tdeeCalculatorCalariePerDay * 7;
                    $tdeeCalculatorCalariePerWeek = number_format($tdeeCalculatorCalariePerWeek, 2);
                    $tdeeCalculatorCalariePerDay = number_format($tdeeCalculatorCalariePerDay, 2);


                    $bmi = bmiCalculator('centimeter', $dataValues['height'],'kilogram', $dataValues['weight']);
                    $ibw = ibwCalculator($dataValues['gender'], $dataValues['height']);

                    $lifeStyle = $lifeStyleArray[$dataValues['life_style']];
                    $remarksData = <<<EOF
                        <ul> 
                            <li> Life Style : {$lifeStyle}</li>
                            <li> Age : {$dataValues['age']}</li>
                            <li> Weight : {$dataValues['weight']}kg</li>
                            <li> Height : {$dataValues['height']}cm</li>
                            <li class='mb-2'> Result </li>
                            <li>Your Maintenance Calories : ({$tdeeCalculatorCalariePerDay}) calaroies Per day ,
                            ({$tdeeCalculatorCalariePerWeek}) calaroies Per Week</li>
                            <li> BMI and IBW : {$bmi['bmiIndex']} - {$bmi['result']}</li>
                            <li> Your Weight : {$dataValues['weight']}kg - {$ibw}kg</li>
                        </ul>
                    EOF;

                    $queryStringFromSession['remarks'] = $remarksData;
                    $this->sessionRemarkModel->store($queryStringFromSession);
                    Flash::set("Calculator data added to session");
                    return redirect(_route('session:add-transaction', [
                        'sessionId' => seal($queryStringFromSession['session_id'])
                    ]));
                } else {
                    $tdeeCalculatorCalariePerDay = $tdeeCalculator->calculate(
                        $post['gender'],
                        $post['weight'],
                        $post['height'],
                        $post['age'],
                        $post['life_style']
                    );
    
                    $tdeeCalculatorCalariePerWeek = $tdeeCalculatorCalariePerDay * 7;
    
                    $data = [
                        'calculationReady' => [
                            'caloriesPerDay'  => $tdeeCalculatorCalariePerDay,
                            'caloriesPerWeek' => $tdeeCalculatorCalariePerWeek,
                            'bmi' => bmiCalculator('centimeter', $post['height'],'kilogram', $post['weight']),
                            'ibw' => ibwCalculator($post['gender'], $post['height'])
                        ],
                        'post' => $post,
                        'req' => $req,
                        'lifeStyleArray' => $lifeStyleArray
                    ];
                }
            }

            return $this->view('tool/tdee', $data);
        }
    }