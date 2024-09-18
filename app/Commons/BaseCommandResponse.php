<?php
namespace App\Commons;
class BaseCommandResponse{
    public $success;
    public $message;
    public $object;
    public function __construct($Message = '', $Object = null,$Success = true) {
        $this->success = $Success;
        $this->message = $Message;
        $this->object = $Object;
    }
}
