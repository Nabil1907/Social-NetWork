<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserFriend;

class UserFriendController extends Controller
{
    public function __construct(){
      $this->middleware('verified');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // will return list of friends
        // will return list of requested friends.
        $user = auth()->user();
        $friends = $user->receivedFriends()->where('is_accepted', 0)->get();
        return view('friend.index', compact('friends'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // will return list of requested friends.
        $user = auth()->user();
        $candidateUsers = $user->NotMe()->NotFriends()->paginate(10);
        return view('friend.create', compact('candidateUsers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // will set requested friend as pending and notify other user.
        $this->validate($request, [
          'user_id' => 'integer|required'
        ]);
        $user = auth()->user();
        $code = 404;
        $response = [];
        $friendReceiver = User::find($request->input('user_id'));
        if(!$friendReceiver){
          $response = [
            'message' => 'Wrong friend!'
          ];
        }else{
          if(UserFriend::create([
            'sender_id' => $user->id,
            'receiver_id' => $friendReceiver->id,
            'is_accepted' => 0
          ])){
            $code = 200;
            $response = [
              'message' => 'Friend request sent successfully!'
            ];
          }else{
            $code = 500;
            $response = [
              'message' => 'Failed to send a friend request.'
            ];
          }
        }
        return response()->json($response, $code);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // show specific friendship ? do we need it?
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // no need.
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
        // accept friend request
        $this->validate($request,
        [
          'user_id' => 'required|integer'
        ]);
        $id = $request->input('user_id');
        $friendRequest = UserFriend::find($id);
        $code = 404;
        $response = [];
        if(!$friendRequest){
          $response = [
            'message' => 'Wrong friend!'
          ];
        }else{
          $friendRequest->is_accepted = 1;
          if($friendRequest->save()){
            $code = 200;
            $response = [
              'message' => 'A new friend has been made!'
            ];
          }else{
            $code = 500;
            $response = [
              'message' => 'Failed to accept the friend request.Perhaps you weren\'t meant to be?'
            ];
          }
        }
        return response()->json($response, $code);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // remove friend request or remove friend from friends list (both has same logic)
        $this->validate($request,
        [
          'user_id' => 'required|integer'
        ]);
        $id = $request->input('user_id');
        $friendRequest = UserFriend::find($id);
        $code = 404;
        $response = [];
        if(!$friendRequest){
          $response = [
            'message' => 'Wrong friend!'
          ];
        }else{
          if($friendRequest->delete()){
            $code = 200;
            $response = [
              'message' => 'Friend request denied. Perhaps you weren\'t meant to be?'
            ];
          }else{
            $code = 500;
            $response = [
              'message' => 'Failed to deny the friend request. This is fate giving you a last chance!'
            ];
          }
        }
        return response()->json($response, $code);


    }
}
