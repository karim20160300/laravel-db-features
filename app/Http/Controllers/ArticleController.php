<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Scopes\ArticleUserScope;
use DB;
class ArticleController extends Controller
{
    //
    public function index(){
        // newarticles Is localScope Defined At Article.php
        // without Global Scope 
        $articles = Article::newarticles(60)->withoutGlobalScope(ArticleUserScope::class)->paginate(10);
        return $articles;
    }

    public function DBRawExamples(){
        // return 'hello world';

        $articlesWithDBRaw = Article::withoutGlobalScope(ArticleUserScope::class)->select(DB::raw('id, title, body, user_id, created_at, DATEDIFF(updated_at , created_at ) as daysBetweenCreateAndLastUpdate'))
        ->paginate();
        
        
        $articlesWithDBRaw = Article::withoutGlobalScope(ArticleUserScope::class)->selectRaw('id, title, body, user_id, created_at, DATEDIFF(updated_at , created_at ) as daysBetweenCreateAndLastUpdate')
        ->paginate();
        
        
        $articlesWithDBRaw = Article::withoutGlobalScope(ArticleUserScope::class)->selectRaw('id, title, body, user_id, created_at, DATEDIFF(updated_at , created_at ) as daysBetweenCreateAndLastUpdate')
        ->whereRaw('DATEDIFF(updated_at , created_at ) = 0')
        ->paginate();
        
        $articlesWithDBRaw = Article::withoutGlobalScope(ArticleUserScope::class)->selectRaw('id, title, body, user_id, created_at, DATEDIFF(updated_at , created_at ) as daysBetweenCreateAndLastUpdate')
        ->orderByRaw('DATEDIFF(updated_at , created_at ) asc')
        ->paginate();

        
        return $articlesWithDBRaw;
    }

    public function collections(){
        // return 'hello collections';
        /**
         * Too Slow 8.9s
         */
        // $articles = Article::withoutGlobalScope(ArticleUserScope::class)->inRandomOrder()->take(100)->get();

        /**
         * fast
         */
        $articles = Article::withoutGlobalScope(ArticleUserScope::class)->take(100)->get();
        /**
         * prepend will allow me to add fake option like the bellow one
         */
        // ->prepend(new Article(['title' => 'Please select your article']));

        /**
         * too slow also
         */
        // $articles = Article::withoutGlobalScope(ArticleUserScope::class)->orderByRaw('RAND()')->take(100)->get();

        // return $articles;
        $collection = $articles->filter(function($article){
            return strlen($article->title) < 40 ;
        })->shuffle()->map(function($article){
            return $article->title;
        });

        // return gettype($collection);
        return $collection;
        /**
         * map
         * apply someting on each elemnt on collection and recreate it
         */

         /**
          * filter
          * apply specific filter on the given collection and return the collected data
          */

          /**
           * shuffle
           * produce data in random order
           */
    }

    public function collectionsChunk(){
        $articles = Article::get()->shuffle()->chunk(3); // if we want to chunk our data
        dd($articles);
    }
    
    public function collectionsRandomArticle(){
        // $articles = Article::withoutGlobalScope(ArticleUserScope::class)->take(100)->get()->random(); // if we want to chunk our data
        $articles = Article::withoutGlobalScope(ArticleUserScope::class)->inRandomOrder()->first(); // if we want to chunk our data
        dd($articles->title);
    }

    public function getTheMostBlogedUser(){
        $articles = Article::get();
        return $articles->mode('user_id');

        
    }
}
