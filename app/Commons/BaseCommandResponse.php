<?php
namespace App\Commons;
class BaseCommandResponse{
    public $Success;
    public $Message;
    public $Object;
    public function __construct($Message = '', $Object = null,$Success = true) {
        $this->Success = $Success;
        $this->Message = $Message;
        $this->Object = $Object;
    }
}
