<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Scopes\ArticleUserScope;
class ArticleController extends Controller
{
    //
    public function index(){
        // newarticles Is localScope Defined At Article.php
        // without Global Scope 
        $articles = Article::newarticles(60)->withoutGlobalScope(ArticleUserScope::class)->paginate(10);
        return $articles;
    }
}
