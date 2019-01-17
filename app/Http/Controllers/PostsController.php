<?php

namespace App\Http\Controllers;
date_default_timezone_set('Asia/Jakarta');


use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Validation\Rules\In;
use mysql_xdevapi\Exception;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //date_default_timezone_set('Asia/Jakarta');

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->guest()){
            $user = User::find(auth()->id());
            $user_bud = $user->bud;
            try{
                $filter_bud = Input::get('bud');
                $filter_status = Input::get('status');
                $keyword = Input::get('keyword');
                //$week = Input::get('week');
                if ($filter_bud != null || $filter_status != null){
                    if ($filter_bud == 'All'){
                        $filter_bud = '';
                    }
                    if ($filter_status == 'All'){
                        $filter_status = '';
                    }
                    $posts = Post::where('bud', 'LIKE','%'.$filter_bud.'%')->where('status', 'LIKE', '%'.$filter_status.'%')->orderBy('updated_at', 'desc')->paginate(20);
                }
                else if ($keyword != null) {
                    $posts = Post::where('nama_CC', 'LIKE', '%' . $keyword . '%')->orWhere('nama_proj', 'LIKE', '%' . $keyword . '%')->orderBy('updated_at', 'desc')->paginate(20);
                }
                else{
                    $posts = Post::orderBy('updated_at', 'desc')->paginate(20);
                }

            }
            catch (Exception $e){

            }

            return view('pages.show')->with('posts', $posts)->with('message', "")->with('user_bud', $user_bud);
        }
        else{
            return redirect('/');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->guest()){
            $user = User::find(auth()->id());
            $user_bud = $user->bud;
            return view('pages.input')->with('user_bud', $user_bud);
        }
        else{
            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::find(auth()->id());
        $user_bud = $user->bud;
        if (!auth()->guest()){
            $this->validate($request, [
                'bud' => 'required',
                'nama_CC' => 'required',
                'nama_proj' => 'required',
                'nilai_proj' => 'required',
                'revenue' => 'required',
                'status' => 'required',
            ]);

            $post = new Post;
            $post->bud = $request->input('bud');
            $post->nama_CC = $request->input('nama_CC');
            $post->nama_proj = $request->input('nama_proj');
            $post->nilai_proj = $request->input('nilai_proj');
            $post->revenue = $request->input('revenue');
            $post->status = $request->input('status');
            $post->progress = $request->input('progress');

            $post->save();

            $posts = Post::orderBy('updated_at', 'desc')->paginate(20);


            return view('pages.show')->with('posts', $posts)->with('message', "Report Submit Success")->with('user_bud', $user_bud);

        }
        else{
            return redirect('/');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->guest()){
            $post = Post::find($id);
            return view('pages.edit')->with('post', $post);
        }
        else{
            return redirect('/');
        }
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
        $user = User::find(auth()->id());
        $user_bud = $user->bud;
        if (!auth()->guest()){
            $this->validate($request, [
                'bud' => 'required',
                'nama_CC' => 'required',
                'nama_proj' => 'required',
                'nilai_proj' => 'required',
                'revenue' => 'required',
                'status' => 'required',
            ]);

            $post = Post::find($id);
            $post->bud = $request->input('bud');
            $post->nama_CC = $request->input('nama_CC');
            $post->nama_proj = $request->input('nama_proj');
            $post->nilai_proj = $request->input('nilai_proj');
            $post->revenue = $request->input('revenue');
            $post->status = $request->input('status');
            $post->progress = $request->input('progress');

            $post->save();

            $posts = Post::orderBy('updated_at', 'desc')->paginate(20);


//        return view('pages.dashboard')->with('posts', $posts);
            return view('pages.show')->with('posts', $posts)->with('message', "Edit Success")->with('user_bud', $user_bud);

        }
        else{
            return redirect('/');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->guest()){
            $user = User::find(auth()->id());
            $user_bud = $user->bud;
            $post = Post::find($id);
            if ($post->bud == $user_bud || $user_bud == 'All'){
                $post->delete();
            }
            else{
                return redirect('/');

            }
            return redirect('/allreports');
        }
        else{
            return redirect('/');
        }


    }

    public function delete(){
        if (!auth()->guest()){
            $user = User::find(auth()->id());
            $user_bud = $user->bud;
            $id = Input::get('id');
            $post = Post::find($id);
            if ($post->bud == $user_bud || $user_bud == 'All'){
                return view('pages.delete')->with('id', $id);

            }
            else if($post->bud != $user_bud || $id == null){
                return redirect('/');

            }
        }
        else{
            return redirect('/');
        }

    }
}
