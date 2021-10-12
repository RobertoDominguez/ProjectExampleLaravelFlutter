<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request){
        $validator = \Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ]);
    
        $responseArr=array();
        if ($validator->fails()) {
            $responseArr['status']=false;
            $responseArr['data']=[];
            $responseArr['message'] = $validator->messages()->first();
            $responseArr['is_valid']=0;
            $responseArr['token'] = '';
            return response()->json($responseArr,Response::HTTP_BAD_REQUEST);
        }

        $user=User::where('email',$request->email)->get()->first();

        if (Hash::check($request->password, $user->password)){
            $responseArr['status']=true;
            $responseArr['data']=$user;
            $responseArr['message'] = '¡El usuario se ha logeado correctamente!';
            $responseArr['is_valid']=1;
            $responseArr['token'] = $user->createToken('myapptoken')->plainTextToken;
            return response()->json($responseArr,Response::HTTP_OK);
        }

        $responseArr['status']=false;
        $responseArr['data']=[];
        $responseArr['message'] = '¡La contraseña es incorrecta!';
        $responseArr['is_valid']=0;
        $responseArr['token'] = '';
        return response()->json($responseArr,Response::HTTP_UNAUTHORIZED);
    }

    public function signup(Request $request){
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|string|unique:users,email',
            'password' => 'required|min:8|same:password_confirm',
            'password_confirm'=>'required'
           
        ]);
    
        $responseArr=array();
        if ($validator->fails()) {
            $responseArr['status']=false;
            $responseArr['data']=[];
            $responseArr['message'] = $validator->messages()->first();
            $responseArr['is_valid']=0;
            $responseArr['token'] = '';
            return response()->json($responseArr,Response::HTTP_BAD_REQUEST);
        }

        $data=[
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ];

        $user=User::create($data);

        $responseArr['status']=true;
        $responseArr['data']=$user;
        $responseArr['message'] = '¡El usuario se ha registrado correctamente!';
        $responseArr['is_valid']=1;
        $responseArr['token'] = $user->createToken('myapptoken')->plainTextToken;
        return response()->json($responseArr,Response::HTTP_OK);
    }

    public function logout(Request $request){
        auth()->user()->currentAccessToken()->delete();

        $responseArr=array();
        $responseArr['status']=true;
        $responseArr['data']=[];
        $responseArr['message'] = '¡El usuario ha cerrado sesion correctamente!';
        $responseArr['is_valid']=1;
        $responseArr['token'] = '';
        return response()->json($responseArr,Response::HTTP_OK);
    }


    public function logoutAll(Request $request){
        auth()->user()->tokens()->delete();

        $responseArr=array();
        $responseArr['status']=true;
        $responseArr['data']=[];
        $responseArr['message'] = '¡El usuario ha cerrado sesion correctamente en todas sus cuentas!';
        $responseArr['is_valid']=1;
        $responseArr['token'] = '';
        return response()->json($responseArr,Response::HTTP_OK);
    }

}
