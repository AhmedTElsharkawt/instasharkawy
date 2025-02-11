<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::where('user_id', '=', Auth::user()->id)->get();

        return view('home', compact('posts'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->except('image');

        if ($request->hasFile('image'))
        {
            $imageFile = $request->image;
            $imageExtension = $imageFile->getClientOriginalExtension();
            $newImageName = date('Y-m-d-') . uniqid() . '.' . $imageExtension;
            $imageFile->move('images/', $newImageName);
            $path = "images/$newImageName";
            $input['image'] = $path;
        }

        $user = User::find($id);
        $user->update($input);

        return redirect(route('home'));
    }

    public function updatePassword(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed'
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('status', value: 'Password updated successfully.');
    }
}
