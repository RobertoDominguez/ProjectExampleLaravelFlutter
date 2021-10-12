import 'package:flutter_example_3_layers/Data/DataResponse.dart';
import 'package:flutter_example_3_layers/Data/Memo.dart';
import 'package:flutter_example_3_layers/Session/UserSession.dart';

class MemoBusiness{
  Memo memo=new Memo();

  Future<DataResponse> index() async{
    List<Memo> items=List.generate(0, (index) => new Memo());
    DataResponse dataResponse=await memo.index(UserSession.user.token);
    items=dataResponse.data;
    return dataResponse;
  }

  Future<DataResponse> store(String title,String content) async{
    this.memo.title=title;
    this.memo.content=content;
    DataResponse dataResponse=await memo.store(UserSession.user.token);
    return dataResponse;
  }

  Future<DataResponse> update(String id,String title,String content) async{
    this.memo.id=id;
    this.memo.title=title;
    this.memo.content=content;
    DataResponse dataResponse=await memo.update(UserSession.user.token);
    return dataResponse;
  }

  Future<DataResponse> delete(String id) async{
    this.memo.id=id;
    return await memo.delete(UserSession.user.token);
  }


}