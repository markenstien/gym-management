const _URL = 'http://dev.gym_management';
const DS  = '/';

const getURL = function(called_url = null){

	if(called_url != null) {

		return _URL+DS+called_url;
	}

	else{
		return _URL;
	}

};

function hide_delay(target , duration = 10000)
{
	$(target).delay(duration).hide();
}
