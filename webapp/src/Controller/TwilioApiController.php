<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Log\Log;
use Cake\Event\Event;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
//Log::debug($message);


use App\Lib\Handler\TwilioHandler;

class TwilioApiController extends ApiBaseController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
    }

    function token() {
        Log::debug(__METHOD__);

        $handler = new TwilioHandler($this);
        $result = $handler->accessToken();
        Log::debug(print_r($result, true));
        $content = json_encode(array_merge(['method' => __METHOD__, 'class' => get_called_class()], $result));
        

        $this->response->getBody()->write($content);
        $this->response = $this->response->withType('json');
        // ...

        return $this->response;
        
    }

}