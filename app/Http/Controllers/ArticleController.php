<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Article;

class ArticleController extends Controller
{
    //
    public function index()
    {
        try{
            $article = Article::all();
            if (count($article) > 0){
            
                return response() -> json(
                    [
                        "status" => "200",
                        "message" => "Show data is success.",
                        "data" => $article
                    ], 200
                );
            }else{
                return response() -> json(
                    [
                        "status" => "404",
                        "message" => "Database is null."
                    ], 404
                );
            }
        }
        catch (\Exception $exception){
            return response() -> json(
                [
                    'message' => $exception -> getMessage(),
                    'status' => "Cannot corect to Database"
                ], Response::HTTP_NOT_FOUND
            );
        }
    }
    

    public function show($id)
    {
        try{
            $article = Article::find($id);
            if ($article != null) {
                return response() -> json(
                    [
                        "status" => "200",
                        "message" => "Show data is success.",
                        "data" => $article
                    ], 200
                );
            }else{
                return response() -> json(
                    [
                        "status" => "404",
                        "message" => "Article not exist."
                    ], 404
                );
            }
        }
        catch (\Exception $exception){
            return response() -> json(
                [
                    'message' => $exception -> getMessage(),
                    'status' => "Cannot corect to Database"
                ], Response::HTTP_NOT_FOUND
            );
        }
    }

    public function store(Request $request)
    {
        try{
        	if ($request->input("title") != null && $request->input("body") != null) {
        		$article = Article::create($request->all());
        		return response() -> json(
            		[
            			"status" => "200",
            			"message" => "Create article success.",
            			"data" => $article
            		], 200
            	);
        	}else{
        		return response() -> json(
            		[
            			"status" => "400",
            			"message" => "Create article fail."
            		], 400
            	);
            }
        }
        catch (\Exception $exception){
            return response() -> json(
                [
                    'message' => $exception -> getMessage(),
                    'status' => "Cannot corect to Database"
                ], Response::HTTP_NOT_FOUND
            );
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $article = Article::find($id);
            if ($article != null) {
            	$article -> update($request -> all());
            	return response() -> json(
            		[
            			"status" => "200",
            			"message" => "Update article success.",
            			"data" => $article
            		], 200
            	);
            }else{
            	return response() -> json(
            		[
            			"status" => "404",
            			"message" => "Article not exist."
            		], 404
            	);
            }
        }
        catch (\Exception $exception){
            return response() -> json(
                [
                    'message' => $exception -> getMessage(),
                    'status' => "Cannot corect to Database"
                ], Response::HTTP_NOT_FOUND
            );
        }
    }

    public function delete(Request $request, $id)
    {
        try{
            $article = Article::find($id);
            if ($article != null) {
            	$article->delete();
            	return response() -> json(
            		[
            			"status" => "200",
            			"message" => "Delete article success.",
            			"data" => $article
            		], 200
            	);
            }else{
            	return response() -> json(
            		[
            			"status" => "404",
            			"message" => "Article not exist."
            		], 404
            	);
            }
        }
        catch (\Exception $exception){
            return response() -> json(
                [
                    'message' => $exception -> getMessage(),
                    'status' => "Cannot corect to Database"
                ], Response::HTTP_NOT_FOUND
            );
        }
    }
}