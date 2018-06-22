<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Micropost;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        
        return view('users.index', [
            'users' => $users,
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);

        $data = [
            'user' => $user,
            'microposts' => $microposts,
        ];

        $data += $this->counts($user);

        return view('users.show', $data);
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
        // ユーザーを検索
        $user = User::find($id);
        if (!$user) {
            // 手動でアクセスした場合はユーザーが見つからない可能性があるので、チェックをしておく
            return Redirect::back()->withInput()->withErrors(['user_not_found' => trans('お探しのユーザーは存在しません')]);
        }
        else{
            if(\Auth::user()->id === $user->id){
                // ログインした本人だけが削除実行
                $user->delete();
                // 削除完了メッセージを添えて元のページに戻る
                return view('welcome');
            }
            else{
                return view('welcome');
            }
        }

    }
    
    public function followings($id)
    {
        $user = User::find($id);
        $followings = $user->followings()->withPivot('created_at')->orderBy('user_follow.created_at', 'desc')->paginate(10);
        //->withPivot('created_at')->orderBy('user_follow.created_at', 'desc') pivotで中間にアクセス　テーブルの指定は.でOK
        $data = [
            'user' => $user,
            'users' => $followings,
        ];

        $data += $this->counts($user);

        return view('users.followings', $data);
    }

    public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers()->withPivot('created_at')->orderBy('user_follow.created_at', 'desc')->paginate(10);

        $data = [
            'user' => $user,
            'users' => $followers,
        ];

        $data += $this->counts($user);

        return view('users.followers', $data);
    }

 public function favorites($id)
    {
        $user = User::find($id);
        $favorites = $user->favorites()->withPivot('created_at')->orderBy('micropost_user.created_at', 'desc')->paginate(10);

        $data = [
            'user' => $user,
            'microposts' => $favorites,
        ];

        $data += $this->counts($user);

        return view('users.favorites', $data);
    }


}
