<?php

namespace App\Http\Controllers;

use App\Enums\Approval;
use App\Services\Contracts\ICommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentService;
    public function __construct(ICommentService $commentService) {
        $this->commentService = $commentService;
    }
    public function get(Request $request){
        $articleId = $request->route('id');
        $pageIndex = $request->query('pageIndex', 1);
        $pageSize = $request->query('pageSize', 10);
        $result = $this->commentService->get($pageIndex, $pageSize, $articleId);
        return response()->json($result) ;
    }
    public function create(Request $request){
        $userId = $request->attributes->get('user_id');
        $validatedData = $request->validate([
            'article_id' => 'required|integer',
            'content' => 'required|string'
        ]);
        $validatedData['approval'] = Approval::Pending->value;
        $validatedData['created_by'] = $userId;
        $result = $this->commentService->create($validatedData);
        return response()->json($result);
    }
    public function updateStatus(Request $request)
    {
        $validatedData = $request->validate([
            'approval' => 'required|string|in:pending,accepted,rejected',
        ]);
        $articleId = $request->route('id');
        $result = $this->commentService->updateStatus($articleId, $validatedData['approval']);
        return response()->json($result);
    }
    public function delete($id){
        $result = $this->commentService->delete($id);
        return response()->json($result);
    }
}
