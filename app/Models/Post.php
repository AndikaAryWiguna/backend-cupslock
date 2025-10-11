<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory, Sluggable;
    // Jika nama tabel berbeda dengan nama model maka harus isikan code yang dibawah
    // protected $table = 'tabel_baru';

    // Jika Primary Key pada tabel tidak ID Maka gunakan Code yang dibawah
    // protected $primaryKey = 'nama_primary_key';

    // code untuk protect create yang diinputkan ada 2 :
    // fillable 'untuk yang bisa diisi'
    // guarted 'untuk yang didalamnya tidak boleh diisi'
    protected $fillable = ['title','author','slug','body'];
    protected $with = ['kategori','author'];

    // Relationships
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    // Local Scope Untuk filter data
    public function scopeFilter($query, array $filters) {
        $query->when($filters['search'] ?? false, function($query,  $search){
            return $query->where('title', 'like', '%' . $search . '%')
                         ->orWhere('body', 'like', '%' . $search . '%');
        });

        $query->when($filters['kategori'] ?? false, function ($query, $kategori){
            return $query->whereHas('kategori', function ($query) use ($kategori){
                $query->where('slug', $kategori);
            });
        });

        // When untuk author
        $query->when($filters['author'] ?? false, function ($query, $author){
            return $query->whereHas('author', function ($query) use ($author){
                $query->where('username', $author);
            });
        });

       
        // when author menggunakan arrow function
        // $query->when($filters['author'] ?? false, fn($query, $author) =>
        //     $query->whereHas('author', fn($query) =>
        //         $query->whereHas('username', $author)
        //     )
        // );
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
