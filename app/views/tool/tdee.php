<?php
 build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">TDEE Calculator With BMI</h4>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <?php
                        Form::open([
                            'method' => 'post'
                        ])
                    ?>
                        <div class="form-group">
                            <?php
                                Form::label('Gender');
                                Form::select('gender',['male' => 'Male', 'female' => 'Female'],'', [
                                    'class' => 'form-control',
                                    'required' => true
                                ])
                            ?>
                        </div>

                        <div class="form-group">
                            <?php
                                Form::label('Age (in years)');
                                Form::text('age', '', [
                                    'class' => 'form-control',
                                    'required' => true
                                ])
                            ?>
                        </div>

                        <div class="form-group">
                            <?php
                                Form::label('Weight (in kg)');
                                Form::text('weight', '', [
                                    'class' => 'form-control',
                                    'required' => true
                                ])
                            ?>
                        </div>

                        <div class="form-group">
                            <?php
                                Form::label('Height (in cm)');
                                Form::text('height', '', [
                                    'class' => 'form-control',
                                    'required' => true
                                ])
                            ?>
                        </div>

                        <div class="form-group">
                            <?php
                                Form::label('Life Stype)');
                                Form::select('life_style', $lifeStyleArray, '', [
                                    'class' => 'form-control'
                                ]);
                            ?>
                        </div>

                        <div class="form-group">
                            <?php
                                Form::submit('', 'Calculate in Metric Unit');
                            ?>
                        </div>
                    <?php Form::close()?>
                </div>

                <div class="col-md-5" style="margin-left: 30px;">
                    <?php if(!empty($calculationReady)) :?>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Gender</td>
                                    <td><?php echo $post['gender']?></td>
                                </tr>
                                <tr>
                                    <td>Age</td>
                                    <td><?php echo $post['age']?></td>
                                </tr>
                                <tr>
                                    <td>Weight</td>
                                    <td><?php echo $post['weight']?>kg</td>
                                </tr>
                                <tr>
                                    <td>Height</td>
                                    <td><?php echo $post['height']?>cm</td>
                                </tr>
                                <tr>
                                    <td>Life Style</td>
                                    <td><?php echo $lifeStyleArray[$post['life_style']]?></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-6" style="border: 1px solid #eee; padding:10px;border-radius:5px">
                                <h4>Your Maintenance Calories</h4>
                                <div class="mb-3">
                                    <h4><?php echo number_format($calculationReady['caloriesPerDay'], 2)?></h4>
                                    <span>Calories Per Day</span>
                                </div>
                                <div>
                                    <h4><?php echo number_format($calculationReady['caloriesPerWeek'], 2)?></h4>
                                    <span>Calories Per Week</span>
                                </div>
                            </div>

                            <div class="col-md-6" style="border: 1px solid #eee; padding:10px;border-radius:5px">
                                <h4>BMI AND IBW</h4>
                                <div class="mb-3">
                                    <h4><?php echo $calculationReady['bmi']['bmiIndex']?></h4>
                                    <span><?php echo $calculationReady['bmi']['result']?></span>
                                </div>
                                <div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4><?php echo $post['weight']?>kg</h4>
                                            <span>Your Weight</span>
                                        </div>

                                        <div class="col-md-6">
                                            <h4><?php echo $calculationReady['ibw']?>kg</h4>
                                            <span>Ideal Weight</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <?php
                                Form::open([
                                    'method' => 'post'
                                ]);

                                Form::hidden('data_values', seal([
                                    'gender' => $post['gender'],
                                    'age' => $post['age'],
                                    'weight' => $post['weight'],
                                    'height' => $post['height'],
                                    'life_style' => $post['life_style'],
                                ]));
                            ?>
                                <div class="form-group mt-3">
                                    <?php Form::submit('btn_save_tdee', 'Save To Member Remarks')?>
                                </div>
                            <?php Form::close()?>
                        </div>
                    <?php endif?>
                </div>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>