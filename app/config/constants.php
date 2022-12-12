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

    define('SITE_NAME' , 'invborrower.cloud');

    define('COMPANY_NAME' , 'GYM');

    define('KEY_WORDS' , 'INVENTORY BORROWER');


    define('DESCRIPTION' , '#############');

    define('AUTHOR' , SITE_NAME);


    define('APP_KEY' , 'INVENTORY BORROWER-5175140471');
    
?>