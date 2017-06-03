# twilio-cake
CakePHP 3 + Twilio 

This is a minimal CakePHP 3 with Twilio already installed. 

## Usage
Add a twilio config file which contains your Twilio keys.
Place this file in config/local-twilio.php.  In that file put the following:

    <?php
    return [
        'Twilio' => [
            'accountSid'    => 'AC000000000000000000000000000000000', //
            'authToken'     => '00000000000000000000000000000000',   // 
            'apiKey'        => '00000000000000000000000000000000',   //
            													  |
            'secret'        => 'SK00000000000000000000000000000000', //
            'appSid'        => '', // TwiML App
            'chatSid'       => 'IS00000000000000000000000000000000', //
            ],
    ];