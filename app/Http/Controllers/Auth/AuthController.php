<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
{
    // Xác thực thông tin người dùng
    $credentials = $request->only('email', 'password');

    // Kiểm tra đăng nhập
    if (Auth::attempt($credentials, $request->has('remember'))) {
        // Đăng nhập thành công, chuyển hướng về trang chính
        return redirect()->intended('/');
    }

    // Nếu đăng nhập thất bại, quay lại trang login với lỗi
    return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
}

    

    // Hiển thị form đăng ký
    public function showRegistrationForm()
    {
        return view('register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        // Hash mật khẩu trước khi lưu vào cơ sở dữ liệu
        $data['password'] = bcrypt($data['password']);
    
        // Tạo người dùng mới
        User::create($data);
    
        // Đăng nhập tự động ngay sau khi đăng ký
        Auth::login(User::where('email', $request->email)->first());
    
        return redirect()->route('dashboard');
    }
    

    // Xử lý đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
