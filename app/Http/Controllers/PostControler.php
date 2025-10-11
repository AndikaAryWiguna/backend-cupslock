<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostControler extends Controller
{
    public function index()
    {
        $title = '';
        if(request('kategori')){
            $kategori = Kategori::firstWhere('slug', request('kategori'));
            $title = 'Artikel in: '. $kategori->name;
        }
        if(request('author')){
            $author = User::firstWhere('username', request('author'));
            $title = 'by : '. $author->name;
        }
        return view('enduser.blog.posts', [
            'title' => "Blog " . $title,
            // jika langsng get data akan mengalami lazy loading
            // 'posts' => Post::all()

            // Bisa menggunakan with kalau dia tidak menggunakan route model binding
            // 'posts' => Post::all()->with(['author','kategori'])
            // Kalo menggunakan route modele binding gunakan load supaya dia lazy Eager
            'posts' => Post::with(['author', 'kategori'])
                ->latest()
                ->filter(request(['search', 'kategori', 'author']))
                ->paginate(9)
                ->withQueryString()
        ]);
    }
    
    public function show(Post $post)
    {
        return view('enduser.blog.post', [
            'title' => 'Single Post',
            'post' => $post->load(['author', 'kategori']) // Eager loading untuk author dan kategori
        ]);
    }

    // public function author(User $user){
    //     return view('posts', [
    //         'title' =>count($user->posts) . ' Artikel by : '. $user->name, 
    //         'posts' => $user->posts->load(['author','kategori'])
    //     ]);
    // }

    // public function kategori(Kategori $kategori){
    //     return view('posts', [
    //         'title' =>'Artikel in: '. $kategori->name, 
    //         'posts' => $kategori->posts->load(['author','kategori'])
    //     ]);
    // }
}
