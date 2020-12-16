<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Eloquentを使うので必ず入れてください
use App\Models\Post;

// Validatorを使うのに必要
use Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Post::all();
        return view('post.index', ['items' => $items]); // ビューの描画
        // return $items->toArray(); // JSONデータで描画
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $form = $request->all();

        // 最低限なバリデーション処理です。ここでは特に説明はしません。
        $rules = [
            'user_id' => 'integer|required', // 2項目以上条件がある場合は「 | 」を挟む
            'title' => 'required',
            'message' => 'required',
        ];
        $message = [
            'user_id.integer' => 'System Error',
            'user_id.required' => 'System Error',
            'title.required'=> 'タイトルが入力されていません',
            'message.required'=> 'メッセージが入力されていません'
        ];
        $validator = Validator::make($form, $rules, $message);

        if($validator->fails()){
            return redirect('/post')
                ->withErrors($validator)
                ->withInput();
        }else{
            unset($form['_token']);
            $post->user_id = $request->user_id;
            $post->title = $request->title;
            $post->message = $request->message;
            $post->save();
            return redirect('/post');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
