<?php

namespace App\Http\Controllers;

use App\Services\Contracts\ITagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    private $tagService;
    public function __construct(ITagService $tagService) {
        $this->tagService = $tagService;
    }
    public function get(Request $request){
        $pageIndex = $request->query('pageIndex', 1);
        $pageSize = $request->query('pageSize', 10);
        $keyword = $request->query('keyword', '');
        $result = $this->tagService->get($pageIndex, $pageSize, $keyword);
        return response()->json($result) ;
    }
    public function getAll(){
        $result = $this->tagService->getAll();
        return response()->json($result) ;
    }
    public function find($id){
        $result = $this->tagService->find($id);
        return response()->json($result);
    }
    public function create(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'describe' =>'required|string'
        ]);
        $result = $this->tagService->create($validatedData);
        return response()->json($result);
    }
    public function update(Request $request){
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'describe' =>'required|string'
        ]);
        $result = $this->tagService->update($validatedData['id'], $validatedData);
        return response()->json($result);
    }
    public function delete($id){
        $validatedData = $id->validate([
            'id' => 'required|integer'
        ]);
        $result = $this->tagService->delete($validatedData['id']);
        return response()->json($result);
    }
}
