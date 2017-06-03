<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Log\Log;
use Cake\Event\Event;

use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use App\Lib\Handler\AccessHandler;

class ApiBaseController extends AppController {
    
    // API controllers never render
    public $accessHandler = null;
	public function beforeFilter(Event $event) {
        $this->accessHandler = new AccessHandler($this);
        $this->autoRender = false;
        parent::beforeFilter($event);
    }
}