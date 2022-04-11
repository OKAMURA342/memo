<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>
<style>
/*色や主な共通部分は省略*/

.circle {
  width: 50px;
  height: 50px;
  line-height: 50px;
  background-color:#3399FF;
  border-radius: 50%;
  color: #fff;
  text-align: center;
  padding: 0;
  right:100px;
  position: absolute;
  right: 15px;
  bottom: 15px;
}
 .logout 
{
  display:inline-block;
  position:absolute;
  right:10px
}
.search
{   
    padding: 10px 0px;
    display: flex;
    align-items: center;      
    position: relative;
}
.fit-picture{
  width:50px;
  height:50px;
}
.btn {
  position: absolute;
    right: 13px;
    height: 34px;
}
  

</style>
<div class="container">
    <div class="row my-3">
      <div class="col-md-2"></div>
        <div class="col-md-8">
           <div class="card">
              <div class="card-header">メモ帳一覧
                <form  class='logout'  action="/logout" method="post">
               @csrf
               <input type="submit" value="ログアウト">
                </form> 
              </div>
                    <form  class='search' method="post" action="/search" >
                          @csrf
                          <input  style="width:350px;" type="text" name="search">
                          <input  class="bottom btn btn-primary" type="submit" name="submit" value="検索">
                    </form>
                        <table class="table"> 
                            @foreach($items as $item)
                            <tr>
                              <td><a href="/edit?id={{$item->id}}"><img class="fit-picture" src="{{ asset('/parts/memo.svg') }}">{{$item->title}}</a>
                                    <form method="post" action="/tag_update">
                                      @csrf
                                      <input type="hidden" name="id" value="{{$item->id}}">
                                      <p><textarea cols="40" rows="2" name="tags">@foreach($item->tags as $tag){{" ".$tag->tags}}@endforeach</textarea> <button type="submit" class="btn btn-primary">＃</button></p>
                                    </form>
                              </td>
                              <td>
                                <form method="post" action="/remove">
                                @csrf
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <div class="text-right">
                                        <button type="submit" class="btn btn-primary">✖</button>
                                </form>
                              </td>
                            </tr>
                            @endforeach
                        </table>
                        <br>
                        <br>
                        <br>
                            <a href="/new" class="circle">+</a>
               </div>
            </div>
        </div>
      </div>
   </div>
</div>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

</body>
</html>