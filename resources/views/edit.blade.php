<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>
<style>
  .logout 
{
  display:inline-block;
  position:absolute;
  right:10px
}   
.finish
{
  display:flex;
  justify-content:flex-end;
  padding-right:15px;
}
</style>
<body>
<div class="container">
    <div class="row my-3">
      <div class="col-md-2"></div>
        <div class="col-md-8">
           <div class="card">
              <div class="card-header">メモの内容
                  <form  class='logout'   action="/logout" method="post">
                      @csrf
                      <input  class='logout'  type="submit" value="ログアウト">
                  </form> 
              </div>
              <div>
                <table>
                  @error('date')
                      <tr>
                          <th><div class="alert alert-danger" role="alert">ERROR</div></th>
                          <td><div class="alert alert-danger" role="alert">{{$message}}</div></td>
                      </tr>
                      @enderror
                      @error('title')
                      <tr>
                          <th><div class="alert alert-danger" role="alert">ERROR</div></th>
                          <td><div class="alert alert-danger" role="alert">{{$message}}</diV></td>
                       </tr>
                      @enderror
                      <tr>
                      @error('contents')
                      <tr>
                          <th><div class="alert alert-danger" role="alert">ERROR</div></th>
                          <td><div class="alert alert-danger" role="alert">{{$message}}</div></td>
                      </tr>  
                      @enderror
                </table>
                    @isset($item['id'])
                     <form action="/update" method="post">
                    @else
                     <form action="/add" method="post">
                        @endisset
                        @csrf
                        <input type="hidden" name="id" value="@isset($item['id']){{$item['id']}}@endisset">
                        <input type="text" placeholder="タイトル" name="title" value="@isset($item['title']){{$item['title']}}@endisset">
                        <input type="date" name="date" value="@isset($item['date']){{$item['date']}}@endisset" >
                        <p><textarea cols="55" rows="5" name="contents">@isset($item['contents']) {{$item['contents']}} @endisset</textarea></p>
                        <p class='finish'><button type="submit"  class="btn btn-primary">完了</button></p> 
                     </form>
              </div>
          </div>
      </div>
    </div>
  </div>
</body>
</html>