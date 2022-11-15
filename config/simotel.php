<?php

return [
    /**
     * You can consider a corresponding class for each  
     * smart application requests that comes from Simotel
     * to your script. In your class define a method that
     * named same as Simotel smart app name.
     * 
     * visit Simotel documents for more details:
     * https://doc.mysup.ir/docs/api/callcenter_api/APIComponents/smart_api 
     * 
     */
    'smartApi' => [
        'apps' => [
            '*' => \YourApp\SmartApiAppClass::class,
        ],
    ],
    
    /**
     * You can consider a corresponding class for each  
     * ivr application requests that comes from Simotel
     * to your script. In your class define a method that
     * named same as Simotel ivr app name.
     * 
     * visit Simotel documents for more details:
     * https://doc.mysup.ir/docs/api/callcenter_api/APIComponents/ivr_api 
     * 
     */
    'ivrApi' => [
        'apps' => [
            '*' => \YourApp\IvrApiAppClass::class,
        ],
    ],
    
    /**
     * You can consider a corresponding class for each  
     * trunk api application requests that comes from Simotel
     * to your script. In your class define a method that
     * named same as Simotel trunk app name.
     * 
     * visit Simotel documents for more details:
     * https://doc.mysup.ir/docs/api/callcenter_api/APIComponents/trunk_api 
     * 
     */
    'trunkApi' => [
        'apps' => [
            '*' => \YourApp\TrunkApiApp::class,
        ],
    ],

    
    /**
     * You can consider a corresponding class for each  
     * extensionApi application requests that comes from Simotel
     * to your script. In your class define a method that
     * named same as Simotel extension app name.
     * 
     * visit Simotel documents for more details:
     * https://doc.mysup.ir/docs/api/callcenter_api/APIComponents/exten_api 
     * 
     */
    'extensionApi' => [
        'apps' => [
            '*' => \YourApp\ExtensionApiAppClass::class,
        ],
    ],

    /**
     * Simotel Api(SA)
     * SA is a set of APIs that start by sending a request
     * from the web service side to Simotel, this service
     * is created in the RestAPI standard format.
     * 
     * visit Simotel documents for more details:
     * https://doc.mysup.ir/docs/api/v4/callcenter_api/SimoTelAPI/settings
     * 
     */
    'simotelApi' => [
        'server_address' => 'http://yourSimotelServer/api/v4',
        'api_auth' => 'basic',  // simotel api authentication: basic,token,both
        'api_user' => 'apiUser',
        'api_pass' => 'apiPass',
        'api_key' => 'apiToken',
    ],
];