<?php
namespace App\Commons;
class BaseQueryResponse{
    public $PageIndex;
    public $PageSize;
    public $Keyword;
    public $Item;
    public $TotalPage;
    public function __construct($PageIndex = 1, $PageSize = 10, $Keyword = '', $Item = [], $TotalPage = 0) {
        $this->PageIndex = $PageIndex;
        $this->PageSize = $PageSize;
        $this->Keyword = $Keyword;
        $this->Item = $Item;
        $this->TotalPage = $TotalPage;
    }
}
