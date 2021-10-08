<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class Category extends Model
{
    use HasFactory;

    public function directChildren()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->directChildren()->with('children:id,title AS text,parent_id');
        // return $this->directChildren()->with('children');

    }

    public static function get_category()
    {
      $category = Category::select('id','title as text')->where('parent_id','=',null)->get();
        $i =0;
       foreach($category as $cat)
       {
        $category[$i]->children = Category::sub_category($cat->id);
        $i++;
       }
       return $category->toArray();
    }

    public static function sub_category($id)
    {
       $category = Category::select('id','title as text')->where('parent_id','=',$id)->get();
        $i =0;
       foreach($category as $cat)
       {
        $category[$i]->children = Category::sub_category($cat->id);
        $i++;
       }
       return $category->toArray();
    }





}
