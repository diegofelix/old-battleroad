<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session',

	/**
	 * Consumers
	 */
	'consumers' => array(

		/**
		 * Google
		 */
        'Google' => array(
            'client_id'     => '839794533312-c46nn3icqe7iov792jmuqtde8qtqj84t.apps.googleusercontent.com',
            'client_secret' => 'Oj8FzAAa6t_PUETPko9EYOBp',
            'scope'         => array('userinfo_email', 'userinfo_profile'),
        ),

        /**
         * Facebook
         */
        'Facebook' => array(
		    'client_id'     => '66c5e7b8d19f02f56c4d87e0166f179c',
		    'client_secret' => 'ef2d16428f91f970d3492eb341196059',
		    'scope'         => array('email'),
		),  

	)

);