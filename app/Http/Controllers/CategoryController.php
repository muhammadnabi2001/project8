<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class CategoryController extends Controller
{
    
    public function index()
    {
        //dd(Auth::check());
        return view('index');
    }
    public function category()
    {
        $categories=Category::all();
        return view('category',['categories'=>$categories]);
    }

    public function loginpage()
    {
        return view('login');
    }

    public function registerpage()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:25',
            'email' => 'required|max:50|min:5|email|unique:users,email',
            'password1' => 'required',
            'password2' => 'required|same:password1'
        ]);

        $data['password'] = bcrypt($data['password1']);
        unset($data['password1'], $data['password2']);

        $user = User::create($data);
        Auth::login($user);

        return view('index')->with('success', 'Ro\'yxatdan o\'tish muvaffaqiyatli yakunlandi!');
    }
    public function login(Request $request)
    {
        //dd($request->all());
        $data=$request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect('/post');
        }
        else
        {
            return redirect('/login');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function create(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name'=>'required'
        ]);
        $data=new Category();
        $data->name=$request->name;
        $data->save();
        return redirect('/category');
    }
    
    
}
