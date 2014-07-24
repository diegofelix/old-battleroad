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
		    'client_id'     => '504273893036690',
		    'client_secret' => '0730a59ff7583042bcd3d7635e40bfc8',
		    'scope'         => array('email'),
		),

	)

);