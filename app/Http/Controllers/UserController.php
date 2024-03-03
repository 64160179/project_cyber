<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public function adminUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }
    public function updateName(Request $request)
    {
        // รับข้อมูลจากแบบฟอร์ม
        $newName = $request->input('new_name');

        // หาผู้ใช้ที่เข้าสู่ระบบ
        $user = Auth::user();

        // อัปเดตชื่อผู้ใช้
        $user->name = $newName;
        $user->save();

        // กลับไปยังหน้า profile หลังจากอัปเดตเสร็จสิ้น
        return redirect()->route('editprofile');
    }

    public function updatePassword(Request $request)
    {
        // ตรวจสอบรหัสผ่านใหม่และการยืนยันรหัสผ่าน
        $request->validate([
            'new_password' => 'required|min:8|confirmed',
        ]);

        // หาผู้ใช้ที่เข้าสู่ระบบ
        $user = Auth::user();

        // อัปเดตรหัสผ่าน
        $user->password = bcrypt($request->input('new_password'));
        $user->save();

        // กลับไปยังหน้า profile หลังจากอัปเดตเสร็จสิ้น
        return redirect()->route('home');
    }
}
