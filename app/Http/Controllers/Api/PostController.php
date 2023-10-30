<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use ApiResponseTrait;
    
    public function index(){
        $p= PostResource::collection(Post::get());
        return $this->apiResponse($p,'Ok',201);
    }

    public function indexlang(){

        $p=Post::select('id','title'.app()->getLocale())->get();

         return $this->apiResponse($p,'OKK',220);
    }
    public function show($id){
        $p=Post::find($id);
        if($p){
            return $this->apiResponse(new PostResource($p),'Ok',201);
        }
        return $this->apiResponse($p,'ERROR!!!!!!!!',500);
    }


    public function store(Request $request){
        
       $val=Validator::make($request->all(),[
            'title'=>'required',
            'body'=>'required',
       ]);
       if($val->fails()){
        return $this->apiResponse(null,$val->errors(),400);
       }

        $post=Post::create([
            'title'=>$request->title,
            'body'=>$request->body
        ]);
        
        if($post){
            return $this->apiResponse(new PostResource($post),'Saving Post',200);
        }
        
    }

    public function update(Request $req,  $id){

        $val=Validator::make($req->all(),[
            'title'=>'required',
            'body'=>'required',
       ]);

       if($val->fails()){
        return $this->apiResponse(null,$val->errors(),400);
       }
       
       $post=Post::find($id);
       $post->update($req->all());

       if($post){
            return $this->apiResponse(new PostResource($post),"The post updated",600);
       }
       return $this->apiResponse(null,"The post did not update",404);
    }


    public function deletepost($id){

        $pp=Post::find($id);
        if(!$pp){
            return $this->apiResponse(null,"The post is not found",404); 
        }
              $pp->delete($id);
             if($pp){
             return $this->apiResponse(null,"The post deleted",200);
             }
       
    }
    
}
