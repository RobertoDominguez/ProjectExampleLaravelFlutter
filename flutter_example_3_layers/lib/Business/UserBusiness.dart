import 'dart:convert';

import 'package:flutter_example_3_layers/Data/DataResponse.dart';
import 'package:flutter_example_3_layers/Data/User.dart';
import 'package:flutter_example_3_layers/Session/UserSession.dart';


class UserBuiness{
  User user=new User();

  Future<DataResponse> login(String email,String password) async{
    this.user.email=email;
    this.user.password=password;
    DataResponse response=await this.user.login();
    if (response.status){
      User usr=response.data;
      UserSession.setSession(usr);
    }
    return response;
  }

  Future<DataResponse> signup(String name,String email,String password,String passwordConfirm) async{
    DataResponse dataResponse=new DataResponse();

    this.user.name=name;
    this.user.email=email;
    this.user.password=password;
    if (password!=passwordConfirm){
      dataResponse.status=false;
      return dataResponse;
    }

    dataResponse=await this.user.signup();
    if (dataResponse.status){
      User usr=dataResponse.data;
      UserSession.setSession(usr);
    }

    return dataResponse;
  }

  Future<DataResponse> logout() async{
    DataResponse dataResponse=await this.user.logout(UserSession.user.token);
    if (dataResponse.status){
      User usr=new User();
      UserSession.setSession(usr);
    }
    return dataResponse;
  }

}