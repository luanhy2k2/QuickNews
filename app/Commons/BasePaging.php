<?php
namespace App\Commons;
class BasePaging{
    public $PageIndex;
    public $PageSize;
    public $Keyword;
    public function __construct($pageIndex = 1, $pageSize = 10, $keyword = '') {
        $this->PageIndex = $pageIndex;
        $this->PageSize = $pageSize;
        $this->Keyword = $keyword;
    }
}
