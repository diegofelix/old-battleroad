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
            'client_id'     => '839794533312.apps.googleusercontent.com',
            'client_secret' => 'rWb7vUkKrloWS96s3OEoRrOb',
            'scope'         => array('userinfo_email', 'userinfo_profile'),
        ),

	)

);