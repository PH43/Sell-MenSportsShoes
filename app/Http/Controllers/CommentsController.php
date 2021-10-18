<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Session;
use DB;
use Carbon\Carbon;
use App\Comment;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class CommentsController extends Controller
{
     public function validation($request){
        return $this->validate($request,[
            'desc' => 'required|max:255|min:3', 
            'name' => 'required|max:100|min:3', 
        ],
        [
            'name.required' => 'Bạn cần nhập tên để comment',
            'desc.required' => 'Bạn cần nhập nội dung comment',
            'desc.max' => 'Nội dung comment không dc quá dài',
        ]);
    }
    public function reply_comment(Request $request){

        $data = $request->all();
        $comment = new Comment();
        $comment->desc = $data['desc'];
        $comment->product_id = $data['product_id'];
        $comment->rep_comment = $data['id'];
        $comment->status = 0;
        $comment->name = 'Admin-CTShop';
        $comment->save();

    }
    public function duyet_comment(Request $request){
        $id = $request->id;
        $status=$request->status;
        if ($id) {
            $comment = Comment::find($request->id);
            $comment->status = $status;
            $comment->save();
        }
       
    }
    public function show_list_comment(){
        $comment = Comment::with('product')->where('rep_comment',0)->orderBy('id','DESC')->get();
        $comment_rep = Comment::with('product')->where('rep_comment','>',0)->get();
        return view('admin.comments.list_comments')->with(compact('comment','comment_rep'));
    }
    public function delete_comment($id){
        $comments=Comment::findorfail($id);
        $comment_rep=Comment::where('rep_comment',$id);
        if ($comments) {
            $comments->delete();
        }
        if ( $comment_rep) {
             $comment_rep->delete();
        }
        return redirect()->back();
    }

    public function send_comment(Request $request){
        $this->validation($request);
        $time=Carbon::now();
        $id=$request->product_id;
        if (Product::findOrfail($id)) {
            $comment = new Comment();
            $comment->desc = $request->desc;
            $comment->created_at =  $time;
            $comment->name = $request->name;
            $comment->product_id = $id;
            $comment->status = 1;
            $comment->rep_comment = 0;
            $comment->save();
        }

    }

    public function load_comment(Request $request){
        $id = $request->product_id;
        $comment = Comment::where('product_id',$id)->where('status',0)->where('rep_comment','=',0)->get();
        $comment_rep = Comment::with('product')->where('rep_comment','>',0)->get();
        $output = '';
        foreach($comment as $key => $comm){
            $output.= ' 
            <div class="row style_comment">

                                        <div class="col-md-2">
                                            <img width="100%" src="'.url('/frontend/images/customer.png').'" class="img img-responsive img-thumbnail">
                                        </div>
                                        <div class="col-md-10">
                                            <p style="color:green;">@'.$comm->name.'</p>
                                            <p style="color:#000;">'.$comm->created_at.'</p>
                                            <p>'.$comm->desc.'</p>
                                        </div>
                                    </div><p></p>';

                                    foreach($comment_rep as $key => $rep_comment)  {
                                        if($rep_comment->rep_comment==$comm->id)  {
                                     $output.= ' <div class="row style_comment" style="margin:5px 40px;background: aquamarine;">

                                        <div class="col-md-2">
                                            <img width="80%" src="'.url('/frontend/images/manager.png').'" class="img img-responsive img-thumbnail">
                                        </div>
                                        <div class="col-md-10">
                                            <p style="color:blue;">@Admin-CTShop</p>
                                            <p style="color:#000;">'.$rep_comment->desc.'</p>
                                            <p></p>
                                        </div>
                                    </div><p></p>';
                                        }
                                    }
        }
        echo $output;

    }
}
