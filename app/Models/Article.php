<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Scopes\ArticleUserScope;
class Article extends Model
{
    use HasFactory;

    /**
     * Local Scope
     */
    public function scopeNewArticles($query, $days = 2){
        return $query->where('created_at', '>', now()->subDays($days));
    }


    /**
     * Global Scope
     * Booting method of the model
     */
    protected static function boot(){
        parent::boot();

        /**
         * First Way
         */
        // static::addGlobalScope('specific_user', function(Builder $builder){
        //     $builder->where('user_id', 1);
        // });

        /**
         * Second Way
         * 76490 is just for trying to send a parameter to global scope using constructor it is may be a (auth user id )
         */
        static::addGlobalScope(new ArticleUserScope(76490));

    }

  


}
