<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\account;
use App\memo;
use App\Tag;
use App\memo_tag;
use Illuminate\Http\Request;
use App\Http\Requests\memoRequest;
use Illuminate\Support\Facades\Auth;

class memocontroller extends Controller
{
  public function index()
  {
        $items=Memo::with('tags')->get();
        return view('memo',['items'=>$items]);
        }
   public function new(Request $request)
      {
              $id = 1;
            return view('edit',compact('id'));
      }
   public function create(memoRequest $request)
          {

              $memo= new memo;
              $form=$request->all();
              unset($form['_token']);
              $form['account']=1;
              $memo->fill($form)->save();
              return redirect('/');
          }
  public function edit(Request $request)
   {
    $item=memo::find($request->id);
    return view('edit',compact('item'));
   }

  public function remove(Request $request)
    {
      memo::find($request->id)->delete();
      return redirect('/');
    }

    public function update(Request $request)
  {
    $memo= memo::find($request->id);
    $form=$request->all();
    unset($form['__token']);
    $memo->fill($form)->save();
    return redirect('/');
  }
  public function search(Request $request) 
  {
     $keyword_title= $request->search;
     $keyword_contents=$request->search;
     $query = memo::query();
     if(strpos($keyword_contents,'#') !== false){
      $items = memo::whereHas('tags', function ($query) use ($keyword_contents) {
        $query->where('tags', "{$keyword_contents}");
      })->get();
       return view('memo',['items'=>$items]);
     }else{
      $items = $query->where('title','like', '%' .$keyword_title. '%')
                    ->orWhere('contents', 'like','%' .$keyword_contents. '%' )->get();
      
      return view('memo',['items'=>$items]);
     }
  }
  public function tag_update(Request $request) 
  {
    $memo= memo::find($request->id);
    $tags = $request->tags;
    $tags = trim($tags);
    $tags = explode(" ", $tags);//ここから配列、くぎる
    $memo->tags()->detach();
    foreach ($tags as $tag) {
    // 
      if ( count(tag::where('tags', '=', $tag)->get()) == 0 ) {//tagテーブルにすでに登録されているか
        $it= new Tag;
        $it->tags = $tag;
        $it->save();
        $id = $it->tagu_id;
      }else {
        $it = tag::where('tags', '=', $tag)->first("tagu_id");
        $id = $it->tagu_id;
      }
      $memo->tags()->attach($id);
      //$it->memos()->syncWithoutDetaching($request->id);
    }
  //  dd('ooo');
    return redirect('/');
  }
}
