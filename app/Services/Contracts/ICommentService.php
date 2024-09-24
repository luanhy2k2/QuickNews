<?php
namespace App\Services\Contracts;

interface ICommentService extends IGenericService{
    function updateStatus($id, $approval);
}
