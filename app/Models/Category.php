<?php
// app/Models/Category.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'admin_id'];


    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

}
