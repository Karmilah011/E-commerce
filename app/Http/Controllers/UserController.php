<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;
use Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        
        $user = new \App\Models\User;
        $user->role = $request->role;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(60);
        $user->save();
        
        // Setelah autentikasi, Anda dapat melakukan redirect ke halaman yang sesuai
        return redirect()->route('user.index');
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
        try {
            $user = User::findOrFail($id);
            return view('user.edit', compact('user'));
        } catch (\Exception $e) {
            return view('error')->with('error', 'Error editing user: ' . $e->getMessage());
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
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'phone' => 'required',
                'address' => 'required',
            ]);

            $user = User::find($id);
            if (!$user) {
                return view('error')->with('error', 'User not found.');
            }

            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->role = $request->role;
            $user->address = $request->address;
            $user->save();

            return redirect('/user');
        } catch (\Exception $e) {
            return view('error')->with('error', 'Error updating user: ' . $e->getMessage());
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
        try {
            $user = User::find($id);
            if (!$user) {
                return view('error')->with('error', 'user Not Found.');
            }
            $user->delete();

            return redirect()->route('user.index')->with(['success' => 'user deleted successfully']);
        } catch (\Exception $e) {
            return view('error')->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }
}
