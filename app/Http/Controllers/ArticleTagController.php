<?php

namespace App\Http\Controllers;

use App\Services\Contracts\IArticleTagService;
use Illuminate\Http\Request;

class ArticleTagController extends Controller
{
    protected $service;
    public function __construct(IArticleTagService $service) {
        $this->service = $service;
    }
    public function get(Request $request){
        $pageIndex = $request->query('pageIndex', 1);
        $pageSize = $request->query('pageSize', 10);
        $keyword = $request->query('keyword', '');
        $result = $this->service->get($pageIndex, $pageSize, $keyword);
        return response()->json($result) ;
    }
    public function find($id){
        $result = $this->service->find($id);
        return response()->json($result);
    }
    public function create(Request $request){
        $validatedData = $request->validate([
            'article_id' => 'required|string',
            'tag_id' => 'required|string',
        ]);
        $result = $this->service->create($validatedData);
        return response()->json($result);
    }
    public function update(Request $request){
        $validatedData = $request->validate([
            'id' => 'required|string',
            'article_id' => 'required|string',
            'tag_id' => 'required|string',
        ]);
        $result = $this->service->update($validatedData['id'], $validatedData);
        return response()->json($result);
    }
    public function delete($id){
        $result = $this->service->delete($id);
        return response()->json($result);
    }
}
