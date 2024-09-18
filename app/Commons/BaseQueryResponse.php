<?php
namespace App\Commons;
class BaseQueryResponse{
    public $pageIndex;
    public $pageSize;
    public $keyword;
    public $item;
    public $total;
    public function __construct($PageIndex = 1, $PageSize = 10, $Keyword = '', $Item = [], $total = 0) {
        $this->pageIndex = $PageIndex;
        $this->pageSize = $PageSize;
        $this->keyword = $Keyword;
        $this->item = $Item;
        $this->total = $total;
    }
}
