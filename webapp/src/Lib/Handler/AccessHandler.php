<?php
namespace App\Lib\Handler;
use Cake\Core\Configure;
use Cake\Log\Log;


class AccessHandler extends BaseHandler {

    function validate() {
        return ['responseCode' => 100, 'message' => 'OK'];
    }

}