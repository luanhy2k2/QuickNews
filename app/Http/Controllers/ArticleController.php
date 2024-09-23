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
    public function mostPopular(Request $request) {
        $pageIndex = $request->query('pageIndex', 1);
        $pageSize = $request->query('pageSize', 10);
        $result = $this->articleService->mostPopular($pageIndex, $pageSize);
        if ($result) {
            return response()->json($result);
        } else {
            return response()->json(['message' => 'No articles found'], 404);
        }
    }

    public function trending(Request $request){
        $pageIndex = $request->query('pageIndex', 1);
        $pageSize = $request->query('pageSize', 10);
        $result = $this->articleService->trending($pageIndex, $pageSize);
        return response()->json($result);
    }
    public function mostInteraction(Request $request){
        $pageIndex = $request->query('pageIndex', 1);
        $pageSize = $request->query('pageSize', 10);
        $result = $this->articleService->mostInteraction($pageIndex, $pageSize);
        return response()->json($result);
    }
    public function find($id){
        $result = $this->articleService->find($id);
        return response()->json($result);
    }
    public function getByCategoryId(Request $request){
        $pageIndex = $request->query('pageIndex', 1);
        $pageSize = $request->query('pageSize', 10);
        $keyword = $request->query('keyword', '');
        $result = $this->articleService->getByCategoryId($keyword, $pageIndex, $pageSize);
        return response()->json($result) ;
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
    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|integer',
            'approval' => 'required|string|in:pending,accepted,rejected',
            'avatar' => 'nullable|string',
            'articleTags' => 'required',
        ]);
        $result = $this->articleService->update($id, $validatedData);
        return response()->json($result);
    }
    public function updateStatus(Request $request)
    {
        $validatedData = $request->validate([
            'approval' => 'required|string|in:pending,accepted,rejected',
        ]);
        $articleId = $request->route('id');
        $result = $this->articleService->updateStatus($articleId, $validatedData['approval']);
        return response()->json($result);
    }
    public function delete($id){
        $result = $this->articleService->delete($id);
        return response()->json($result);
    }
}
