<?php

namespace App\Http\Controllers\AuthCustomer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\WholesaleBusiness;
use Validator;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('authCustomer.login');
    }

    public function login(Request $request){
      $validator = Validator::make($request->all(), $this->rules_AuthCustomer(), $this->messages_AuthCustomer());
      if($validator->passes()) {
        $credential = [
          'username' => $request->username,
          'password' =>$request->password
        ];

        $customer_name = $request->username;
        $customer_status = WholesaleBusiness::where('username',$customer_name)->value('status');
        $customer_role = WholesaleBusiness::where('username',$customer_name)->value('role');

        // if(Auth::guard('customer')->attempt($credential, $request->member)){
        //   if($customer_role == "ดูได้เฉพาะคลังสุราษฎร์ธานี") {
        //     dd('1');
        //     return redirect()->intended(route('customer.suratthani'));
        //   } else {
        //     dd('2');
        //     return redirect()->intended(route('customer.home'));
        //   }
        // }
       
        if($customer_status == "ใช้งานได้") {
          if(Auth::guard('customer')->attempt($credential, $request->member)){
            if($customer_role == "ดูได้เฉพาะคลังสุราษฎร์ธานี") {
              return redirect()->intended(route('customer.suratthani'));
            } else {
              return redirect()->intended(route('customer.home'));
            }
          }else{
            $request->session()->flash('alert-danger', 'เข้าสู่ระบบไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง !!');
            return back()->withErrors($validator)->withInput();
          }
        } else {
          $request->session()->flash('alert-danger', 'เข้าสู่ระบบไม่สำเร็จ ผู้ใช้ถูกปิดการใช้งาน !!');
          return back()->withErrors($validator)->withInput();
        }
      } else{
          $request->session()->flash('alert-danger', 'เข้าสู่ระบบไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง !!');
          return back()->withErrors($validator)->withInput();
      }
  }

    protected function validateLogin(Request $request){
      $this->validate($request, [
          $this->username() => 'required|string',
          'password' => 'required|string',
      ]);
    }

    public function logout(Request $request){
        Auth::guard('customer')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route( 'customer.login' ));
    }

    public function rules_AuthCustomer() {
      return [
        'username' => 'required',
        'password' => 'required|min:6',
      ];
    }

    public function messages_AuthCustomer() {
        return [
          'username.required' => "กรุณากรอกชื่อผู้ใช้",
          'password.required' => "กรุณากรอกรหัสผ่าน",
          'password.min' => "กรุณากรอกรหัสผ่านอย่างน้อย 6 ตัวอักษร",
        ];
    }
}
