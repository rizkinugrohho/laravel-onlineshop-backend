<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //index
    public function index()
    {
        $categories = \App\Models\Category::paginate(5);
        return view('pages.category.index', compact('categories'));
    }

    //create
    public function create()
    {
        return view('pages.category.create');
    }

    //store
    public function store(Request $request)
    {
        $data = $request->all();
        Category::create($data);
        return redirect()->route('category.index');
    }

    //update
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $category = Category::findOrFail($id);
        $category->update($data);
        return redirect()->route('category.index');
    }

    //edit
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('pages.category.edit', compact('category'));
    }

    //show
    public function show($id)
    {
        return view('pages.dashboard');
    }

    //destroy
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.index');
    }
}
