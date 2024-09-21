<?php

namespace App\Http\Controllers;

use App\Services\Contracts\IArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articleService;
    public function __construct(IArticleService $articleService) {
        $this->articleService = $articleService;
    }
    public function get(Request $request){
        $pageIndex = $request->query('pageIndex', 1);
        $pageSize = $request->query('pageSize', 10);
        $keyword = $request->query('keyword', '');
        $result = $this->articleService->get($pageIndex, $pageSize, $keyword);
        return response()->json($result) ;
    }
    public function find($id){
        $result = $this->articleService->find($id);
        return response()->json($result);
    }
    public function uploadFile(Request $request){
        $validatedData = $request->validate([
            'file' => 'required|file|max:10240',
        ]);
        $result = $this->articleService->uploadFile($validatedData);
        return response()->json($result);
    }
    public function deleteFile(Request $request){
        $validatedData = $request->validate([
            'url' => 'required|string',
        ]);
        $result = $this->articleService->deleteFile($validatedData);
        return response($result);
    }
    public function create(Request $request){
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|integer',
            'approval' =>'required|string|in:pending,accepted,rejected',
            'avatar' => 'required|string',
            'articleTags' =>'required'
        ]);
        $userId = $request->attributes->get('userId');
        $validatedData['created_by'] = $userId;
        $result = $this->articleService->create($validatedData);
        return response()->json($result);
    }
    public function update(Request $request){
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|integer',
            'approval' =>'required|string|in:pending,accepted,rejected',
            'avatar' => 'nullable|string',
            'articleTags' =>'required'
        ]);
        $result = $this->articleService->update($validatedData['id'], $validatedData);
        return response()->json($result);
    }
    public function delete($id){
        $result = $this->articleService->delete($id);
        return response()->json($result);
    }
}
