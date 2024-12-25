<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    // Hiển thị danh sách tất cả các task
    public function index()
    {
        $tasks = Task::orderby('created_at', 'asc')->get();
        return view('tasks', ['tasks' => $tasks]);
    }

    // Hiển thị chi tiết task
    public function show(Task $task)
    {
        return view('details', ['details' => $task]);
    }

    // Thêm task mới
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        Task::create([
            'name' => $request->name
        ]);

        return redirect('/')->with('success', "Task '$request->name' đã được thêm thành công!");
    }

    // Xóa task
    public function destroy(Task $task)
    {
        $nametask = $task->name;

        // Xóa task
        $task->delete();

        // Trả về thông báo thành công
        return redirect('/')->with('success', "Task '$nametask' đã được xóa thành công!");
    }

    public function __construct() {
        $this->middleware('auth');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate thông tin đăng nhập
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['email' => 'Thông tin đăng nhập không đúng']);
    }

        public function logout()
    {
        Auth::logout();
        return redirect('/');
    }


}
