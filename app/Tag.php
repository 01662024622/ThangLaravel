<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable=['name','slug'];

    public static function createTags($data){
      $tags=explode(',',trim($data));
      foreach ($tags as $key => $value) {
            // dd($value);
            $dt = array();
            $dt['name'] = $value;
                $dt['slug']=str_slug($dt['name']);
            $boolean=Tag::where('slug',$dt['slug'])->first();
                if (!isset($boolean)) {
                 $tags[$key]=Tag::create($dt);
                }
            }
        return $tags;
        
    }
}
