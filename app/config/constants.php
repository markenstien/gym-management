<?php

    #################################################
	##             THIRD-PARTY APPS                ##
    #################################################

    define('DEFAULT_REPLY_TO' , '');

    const MAILER_AUTH = [
        'username' => '#',
        'password' => '#',
        'host'     => '#',
        'name'     => '#',
        'replyTo'  => '#',
        'replyToName' => '#'
    ];



    const ITEXMO = [
        'key' => '',
        'pwd' => ''
    ];

	#################################################
	##             SYSTEM CONFIG                ##
    #################################################


    define('GLOBALS' , APPROOT.DS.'classes/globals');

    define('SITE_NAME' , 'gymmgmt.online');

    define('COMPANY_NAME' , 'GNG FITNESS');

    define('KEY_WORDS' , 'GNG FITNESS GYM');


    define('DESCRIPTION' , '#############');

    define('AUTHOR' , SITE_NAME);


    define('APP_KEY' , 'GNG_FITNESS_GYM-5175140471');
    
?>