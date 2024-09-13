<?php

namespace App\Http\Controllers;

use App\Services\Contracts\ICategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;
    public function __construct(ICategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }
    public function get(Request $request){
        $pageIndex = $request->query('pageIndex', 1);
        $pageSize = $request->query('pageSize', 10);
        $keyword = $request->query('keyword', '');
        $result = $this->categoryService->get($pageIndex, $pageSize, $keyword);
        return response()->json($result) ;
    }
    public function find($id){
        $result = $this->categoryService->find($id);
        return response()->json($result);
    }
    public function create(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $result = $this->categoryService->create($validatedData);
        return response()->json($result);
    }
    public function update(Request $request){
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
        ]);
        $result = $this->categoryService->update($validatedData['id'], $validatedData);
        return response()->json($result);
    }
    public function delete($id){
        $result = $this->categoryService->delete($id);
        return response()->json($result);
    }
}
