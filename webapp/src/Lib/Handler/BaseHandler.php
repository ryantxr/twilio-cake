<?php
namespace App\Lib\Handler;
use Cake\Core\Configure;
use Cake\Log\Log;

class BaseHandler {
	
    function __construct($obj) {
        Log::debug(__METHOD__);
        if ( is_a($obj, "Controller") )  {
            Log::debug(__METHOD__ . ' Controller');
            $this->controller = $obj; 
            $this->request = $obj->request;

            if ( $this->request->is('post') ){
                Log::debug(__METHOD__. ' post ' . print_r($this->request->data, true));
                $this->input = $this->request->data;

                // Store non-request data we might need to process the transaction
                $this->env['clientIp'] = $this->request->clientIp();
                $this->env['userAgent'] = $this->request->header('User-Agent');
            }
            elseif ( $this->request->is('get')) {
                Log::debug(__METHOD__.' GET value: '.print_r($this->request->query, true));
                $this->input = $this->request->query;

                $this->env['clientIp'] = $this->request->clientIp();
                $this->env['userAgent'] = $this->request->header('User-Agent');
            } else {
                // else
                throw new Exception("Request Error.");
            }
        }
        elseif ( is_array($obj) ) {
            Log::debug(__METHOD__ . ' Array');

        }
        else {
            Log::debug(__METHOD__ . ' Something else');

        }
    }
}