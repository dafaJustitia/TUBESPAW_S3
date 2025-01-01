<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'image', 'url', 'is_published', 'clicks', 'city_id',];
    protected $table = 'products';

    protected $fields = [
        'name',
        'description',
        'price',
        'image',
        'url',
        'is_published',
        'created_at',
        'updated_at',
    ];

    static $sortables = [
        'name' => 'Nama',
        'description' => 'Deskripsi',
        'price' => 'Harga',
        'url' => 'URL',
        'is_published' => 'Dipublikasikan',
        'created_at' => 'Waktu dibuat',
        'updated_at' => 'Waktu diperbarui',
    ];

    static $allowedParams = [
        'limit',
        'q',
        'sortby',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function scopeOptions($query, $options)
    {
        if (isset($options['q'])) {
            $query->where(function ($query) use ($options) {
                $query->where('name', 'like', '%' . $options['q'] . '%')
                    ->orWhere('description', 'like', '%' . $options['q'] . '%')
                    ->orWhere('price', 'like', '%' . $options['q'] . '%')
                    ->orWhere('url', 'like', '%' . $options['q'] . '%');
            });
        }

        if (isset($options['sortby']) && in_array($options['sortby'], $this->fields)) {
            if (!isset($options['order'])) {
                $options['order'] = 'asc';
            }
            $query->orderBy($options['sortby'], validateAndGetOrder($options['order']));
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return $query;
    }
}
