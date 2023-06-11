<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;
// use App\Http\Requests\StoreArticleRequest;
use \Illuminate\Support\Str;
use App\Models\Category;



class ArticleController extends Controller
{

    public function index()
    {
        // $articles = Article::all();
        // $articles = Article::where('user_id', auth()->user()->id)->get(); //TUTTI GLI ARTICOLI CON USER ID CHE DECIDIO IO
       
        $articles = auth()->user()->articles;  //User::class

        return view('articles.index', ['articles' => $articles]);
    }

    
    public function create()
    {

        $categories = Category::all();

        $action = route('articles.store');
        $method = 'POST';

        $article = new Article();

        return view('articles.form', compact('categories', 'action', 'method', 'article'));
    }


    public function store(Request $request)
    {
    //     $validator=Validator::make($request->all(), [
    //         'title' => 'required|max:150',
    //         'category' => 'required',
    //         'body' => 'required',
    // ],[
    //         'title.required' => 'Il campo Titolo non può essere vuoto X',
    //         'title.max' => 'Il campo non può esssere più lungo di :max caratteri',
    //         'category.required' => ' X',
    //         'body.required' => 'z'
    // ]);
        
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }


        $article = new Article();

        $article->title = $request->title;
        $article->user_id = auth()->user()->id;
        // $article->category_id = $request->category_id;
        $article->body = $request->body;

        $article->save();

        $article->categories()->attach($request->categories);

        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $fileName = $request->file('image')->getClientOriginalName();

            $randomFileName = uniqid('image_') . '.' . $request->file('image')->extension();

            $seoFriedlyFileName = $article->id . '.' . Str::slug($request->title) . '.' . $request->file('image')->extension();

            $imagePath = $request->file('image')->storeAs('public/images', $seoFriedlyFileName);

            $article->image = $imagePath;

            $article->save();
        
        }

        return redirect()->route('articles.index')->with(['success' => 'Articolo creato correttamente']);
    }

   
    public function edit(Article $article)
    {
        // if($article->user_id !== auth()->user()->id) && (auth()->user()->role !== 'admin')  //     <=ESEMPIO
        // {
        //     abort(403);
        // }

        if($article->user_id !== auth()->user()->id) 
        {
            abort(403);
        }

        // if($article->user_id !== auth()->user()->id) {
        //     abort(403);
        // }

        $categories = Category::all();

        $action = route('articles.update', $article);
        $method = 'PUT';

        return view('articles.form', compact('article', 'categories', 'action', 'method'));
    }


    public function update(Request $request, Article $article) 
    {
        if($article->user_id !== auth()->user()->id) 
        {
            abort(403);
        }

        $article->fill($request->all())->save();

        // $article->categories()->detach();  //STACCA 1 SOLA CATEGORIA A SCELTA
        // $article->categories()->detach();  //STACCA PIU CATEGORIE A SCELTA
        $article->categories()->detach();
        $article->categories()->attach($request->categories);

        return redirect()->back()->with(['success' => 'Articolo modifictao con successo']);
    }


    public function destroy(Article $article)
    {
        if($article->user_id !== auth()->user()->id) 
        {
            abort(403);
        }

        //1ELIMINO LE CATEGORIE COLLEGATE
        $article->categories()->detach();

        //2CANCELLO L'ARTICOLO
        $article->delete();

        return redirect()->back()->with(['success' => 'Articolo cancellato']);
    }


    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }
}
