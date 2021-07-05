<?php 
return [ 
    'client_id' => 'AaMT19Kx3kjDaPqUKSP1U9qH7l6hxMUHfxbvZrtkawZdIPxlxKoH4fSEo-lfJNWJ0wJL9Xg8oy7udV-u',
	'secret' => 'EHb7DfhwLXIw3pDRxsDvGD_yLAqSKCKw44x6tz3hSE4Gyb6vQnxQ2G1ocplrbSlorfAZHAWDyG0FBmxm',
    'settings' => array(
        'mode' => 'sandbox',
        'http.ConnectionTimeOut' => 1000,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'FINE'
    ),
];