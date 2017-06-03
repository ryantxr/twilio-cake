<?php
namespace App\Lib\Handler;
use Cake\Core\Configure;
use Cake\Log\Log;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\IpMessagingGrant;

class TwilioHandler extends BaseHandler {

    function __construct($obj) {
        parent::__construct($obj);
    }




    
    // This is currently an accessToken for programmable chat
    function accessToken() {
        $twilioAccountSid = Configure::read('Twilio.accountSid');
        $authToken = Configure::read('Twilio.authToken');
        $twilioApiKey = Configure::read('Twilio.apiKey');
        $twilioApiSecret = Configure::read('Twilio.secret');
        $ipmServiceSid = Configure::read('Twilio.chatSid');

        // An identifier for your app - can be anything you'd like
        $appName = 'TwilioChatDemo';
        // choose a random username for the connecting user
        $identity = "john_doe";
        // A device ID should be passed as a query string parameter to this script
        $deviceId = 'somedevice';
        $endpointId = $appName . ':' . $identity . ':' . $deviceId;

        // Create access token, which we will serialize and send to the client
        $token = new AccessToken(
            $twilioAccountSid,
            $twilioApiKey,
            $twilioApiSecret,
            3600,
            $identity
        );

        // Create IP Messaging grant
        $ipmGrant = new IpMessagingGrant();
        $ipmGrant->setServiceSid($ipmServiceSid);
        $ipmGrant->setEndpointId($endpointId);

        // Add grant to token
        $token->addGrant($ipmGrant);

        // return serialized token and the user's randomly generated ID

        return [
            'identity' => $identity,
            'token' => $token->toJWT(),
        ];
    }

}