$(document).ready(function(){
    let isPlaying = false;
    let curReps   = 0;
    let isOnrest = false;
    let isWorkoutComplete = false;
    
    let workTime = {
        work_time_min : 0,
        work_time_sec : 0,
    };

    let restTime = {
        rest_time_min : 0,
        rest_time_sec : 0,
    };

    const imageContainer = $('#workoutImageContainer');
    $('.workout_start').click(function(){
        let dataId = $(this).data('id');

        if(isPlaying) {
            return;
        }

        isPlaying = true;

        if(isPlaying) {
            $('#workSection').show();
        }
        $.ajax({
            url: getURL('api/WorkoutSetBuilder/getWorkout'),
            method: 'GET',
            data: {
                id : dataId
            },
            success : function(response) {
                let responseData = JSON.parse(response);
                let workTimeData = [
                    parseInt(responseData.work_time_min),
                    parseInt(responseData.work_time_sec),
                ];

                let restTimeData = [
                    parseInt(responseData.rest_time_min),
                    parseInt(responseData.rest_time_sec),
                ];

                workTime.work_time_min = workTimeData[0];
                workTime.work_time_sec = workTimeData[1];

                restTime.rest_time_min = restTimeData[0];
                restTime.rest_time_sec = restTimeData[1];

                curReps = responseData.rep_count;

                $("#workoutName").html(responseData.workout_name);

                console.log(responseData);
                
                if(responseData.images) {
                    buildImageToHTML(responseData.images);
                }
                var workoutInterval = setInterval(function(){
                    /**
                     * init values
                     */
                    displayToHTML('#workMin', workTime.work_time_min);
                    displayToHTML('#workSec', workTime.work_time_sec);

                    displayToHTML('#restSec', restTime.rest_time_sec);
                    displayToHTML('#restMin', restTime.rest_time_min);
                    displayToHTML('#reps', curReps);

                    if(curReps != 0) {
                        if(isOnrest == false) {
                            if(workTime.work_time_sec !=0) {
                                workTime.work_time_sec--;
                            } else {
                                if(workTime.work_time_min !=0) {
                                    workTime.work_time_min - 1;
                                    workTime.work_time_sec = 60;
                                } else {
                                    curReps--;
                                    //reset work time
                                    workTime.work_time_min = workTimeData[0];
                                    workTime.work_time_sec = workTimeData[1];

                                    isOnrest = true;
                                }
                            }
                            removeActiveHTML('#restTimeContainer');
                            activeHTML('#workTimeContainer', 'green');
                        }

                        if(isOnrest == true) {
                            //add rest time here.
                            if(restTime.rest_time_sec != 0) {
                                restTime.rest_time_sec--;
                            } else {
                                if(restTime.rest_time_min != 0) {
                                    restTime.rest_time_min - 1;
                                    restTime.rest_time_sec = 60;
                                } else {
                                    isOnrest = false;
                                    //reset rest
                                    restTime.rest_time_min = restTimeData[0];
                                    restTime.rest_time_sec = restTimeData[1];
                                }
                            }
                            displayToHTML('#restSec', restTime.rest_time_sec);
                            displayToHTML('#restMin', restTime.rest_time_min);
                            removeActiveHTML('#workTimeContainer');
                            activeHTML('#restTimeContainer', 'red');
                        }
                    } else {
                        isWorkoutComplete = true;
                        clearInterval(workoutInterval);
                        updateWorkOutToComplete(dataId);

                        $('#workSection').html('<h1>Workout Done!.. refreshing page in 3 seconds</h1>');

                        setTimeout(function(){
                            location.reload();
                        }, 3000);
                    }
                    
                }, 1000);
            }
        })
    });

    function updateWorkOutToComplete(workoutId) {
        $.ajax({
            type: 'POST',
            url : getURL('api/WorkoutSetBuilder/completeWorkout'),
            data: {
                id : workoutId
            },

            success : function(response) {
                console.log(response);
            }
        })
    }

    function activeHTML(id, color) {
        $(id).css({
            'background-color' : color,
            'padding' : '10px',
            'color' : '#fff'
        });
    }

    function removeActiveHTML(id) {
        $(id).css({
            'background-color' : 'white',
            'padding' : '10px',
            'color' : 'black'
        });
    }
    function displayToHTML(htmlElement, txtContent){
        $(htmlElement).html(txtContent);
    }


    function buildImageToHTML(images) {
        let imageHTML = '';
        for(let i in images) {
            imageHTML += `
                <div class='col-md-4'> 
                    <img src='${images[i]}' style='width:300px;height:300px'/>
                </div>
            `;
        }

        imageContainer.html(imageHTML);
    }
});


