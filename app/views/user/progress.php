<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Progress</h4>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Session</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <th>Remarks</th>
                            </thead>

                            <tbody>
                                <?php foreach($sessionRemarks as $key => $row) :?>
                                    <tr>
                                        <td><?php echo $row->remarks?></td>
                                    </tr>
                                <?php endforeach?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-6">
                    <h4>Workout Set Progress</h4>
                    <div style="display: flex; flex-direction:row">
                        <?php echo wProgressDayHTML('Sun', $progress, 'S');?>
                        <?php echo wProgressDayHTML('Mon', $progress, 'M');?>
                        <?php echo wProgressDayHTML('Tue', $progress, 'T');?>
                        <?php echo wProgressDayHTML('Wed', $progress, 'W');?>
                        <?php echo wProgressDayHTML('Thu', $progress, 'T');?>
                        <?php echo wProgressDayHTML('Fri', $progress, 'F');?>
                        <?php echo wProgressDayHTML('Sat', $progress, 'S');?>
                    </div>

                    <section class="mt-5"><div id='calendar'></div></section>
                </div>
            </div>
        </div>
    </div>

    <div>
        <input type="hidden" value="<?php echo $user->id?>" id="userid">
    </div>

    <?php
        function wProgressDayHTML($day, $progress, $abbr = '') {
            $inSevenDayRange = Date('Y-m-d', strtotime('-7 days'));
            $dayProgress = $progress[$day];

            // if(isEqual($day, 'Mon')) {
            //     dump($dayProgress);
            // }

            if(!$dayProgress || is_null($dayProgress->last_set_taken)) {
                return wProgressSpanHTML('Grey', $abbr);
            }

            $lastTaken = Date('Y-m-d', strtotime($dayProgress->last_set_taken));

            if((strtotime($lastTaken) >= strtotime($inSevenDayRange)) && $dayProgress->is_set_complete) {
                $badgeColor = 'green';
            } else if((strtotime($lastTaken) > strtotime($inSevenDayRange))) {
                $badgeColor = 'red';
            } else {
                $badgeColor = 'yellow';
            }
            
            return wProgressSpanHTML($badgeColor, $abbr);
        }

        function wProgressSpanHTML($bgColor, $dayName) {
            return "<div class='daily-box' style='background-color: {$bgColor};'>{$dayName}</div>";
        }
    ?>
<?php endbuild()?>

<?php build('styles') ?>
    <style>
        .daily-box{
            width: 70px;
            height: 70px;
            border-radius: 50%;
            text-align: center;
            line-height: 250%;
            color: #fff;
            font-weight: bold;
            font-size: 20pt;
            margin-right: 15px;
        }
    </style>
<?php endbuild()?>

<?php build('scripts')?>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>

<script>
    $(document).ready(function(){
        $.ajax({
            url : getURL('api/WorkoutSetBuilder/getSession'),
            method : 'GET',
            data: {
                user_id : $("#userid").val()
            },
            success: function(response) {
                let responseData = JSON.parse(response);
                
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    displayEventTime : false,
                    events : responseData
                });
                calendar.render();
            }
        })
    });
</script>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>