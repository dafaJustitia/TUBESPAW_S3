<?php
namespace App\Http\Controllers\Dashboard;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index()
    {
        $title = 'Daftar Artikel';
        $allowedParams = ['q', 'sort', 'order'];
        $articles = Article::paginate(10);
        return view('dashboard.articles.index', compact('articles', 'title', 'allowedParams'));
    }

    public function create()
    {
        $title = 'Tambah Artikel';
        return view('dashboard.articles.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'link' => 'required|url',
            'is_published' => 'required|boolean',
            "description" => "required",
        ]);

        Article::create([
            'title' => $request->title,
            'link' => $request->link,
            'is_published' => $request->is_published,
            'description' => $request->description,

        ]);

        return redirect()->route('dashboard.articles.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Article $article)
    {
        $title = 'Edit Artikel';
        return view('dashboard.articles.edit', compact('article', 'title'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required',
            'link' => 'required|url',
            'is_published' => 'required|boolean',
            'description' => 'required',
        ]);

        $data = $request->only(['title', 'link', 'is_published', 'description']);

        $article->update($data);

        return redirect()->route('dashboard.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('dashboard.articles.index')->with('success', 'Artikel berhasil dihapus.');
    }

    public function show(Article $article)
    {
        // $article->increment('clicks');
        $title = 'Detail Artikel';
        return view('dashboard.articles.show', compact('article', 'title'));

    }
    
     public function handleClick(Article $article)
    {
        $article->increment('clicks');
        return redirect($article->link);
    }
}