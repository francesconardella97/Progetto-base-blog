<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10); //OGNI PAGINA AVRA 3 CATEGORIE CREATE! SIMILE A ALL()

        //$categories = Category::orderBy('name', 'desc' o 'asc')->get() //SERVE PER AVERE LISTA IN ORDINE CRESCENTE O DECRESCENTE, VA TOLTO IN INDEX (CATEGORIES LINKS)

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Category::create($request->all());

        return redirect()->back()->with(['success' => 'categoria creata correttamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {

    //     if($article->user_id !== auth()->user()->id) {
    //         abort(403);
    // }


       $category->fill($request->all())->save();

       return redirect()->back()->with(['success' => 'Categoria modificata correttamente']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
         //     if($article->user_id !== auth()->user()->id) {
    //         abort(403);
    // }

        // $category->articles()->detach();

        $category->delete();

        return redirect()->back()->with(['success' => 'Categoria eliminita correttamente']);
    }
}
