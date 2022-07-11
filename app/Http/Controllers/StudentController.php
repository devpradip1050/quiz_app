<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class StudentController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.students_list')->with(['users'=>$users]);
    }
    public function create()
    {
        return view('admin.student_add');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'cpassword' => 'required'
        ]);
        $check_email = User::where('email',$request->email)->first();
        if($check_email)
        {
            return redirect()->back()->with(['message'=>'Email ID ALready Exist']);
        }
        else
        {
            if($request->password == $request->cpassword)
            {
                $student = new User();
                $student->name = $request->name;
                $student->email = $request->email;
                $student->password = Hash::make($request->password);
                $student->save();
                if($student)
                {
                    return redirect()->back()->with(['message'=>'Student Successfully Added']);
                }
                else
                {
                    return redirect()->route('admin.add.student')->with(['message'=>'Something Went Wrong']);
                }
            }
            else
            {
                return redirect()->back()->with(['failed'=>'Password and Confirm Password Not Matcehd']);
            }
            
        }
    }
    public function edit($id)
    {
        $users = User::find($id);
        return view('admin.student_edit', compact('users'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'cpassword' => 'required'
        ]);
        if($request->password == $request->cpassword)
            {
                $student = User::find($id);
                $student->name = $request->name;
                $student->email = $request->email;
                $student->password = Hash::make($request->password);
                $student->save();
                if($student)
                {
                    return redirect()->back()->with(['message'=>'Student Successfully Updated']);
                }
                else
                {
                    return redirect()->route('admin.add.student')->with(['message'=>'Something Went Wrong']);
                }
            }
            else
            {
                return redirect()->back()->with(['failed'=>'Password and Confirm Password Not Matcehd']);
            }
    }
    public function destroy($id)
    {
        $student = User::find($id)->delete();
        return redirect()->route('admin.index');
    }
}
