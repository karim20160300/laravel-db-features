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
}
