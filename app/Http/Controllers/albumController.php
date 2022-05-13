<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class albumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('album')->get();
        return view('album.index',['data'=>$data , 'title'=>"Show Album"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('album.create',["title"=>"Create Album"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $this->validate($request,[
            'name'=>'required|string|min:3',
        ]);
        $op_create = DB::table('album')->insert($data);
        if ($op_create) {
            # code...
            $message = "Raw Inserted";
        }else{
            $message = "Error To Inserted";
        }
        session()->flash('Message',$message);
        return redirect(url('/album'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = DB::table('album')->find($id);
        return view('album.edit',['data'=>$data , 'title'=>'Edit Album']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $this->validate($request,[
            'name'=>'required|string|min:3',
        ]);
        $op_update = DB::table('album')->where('id',$id) ->update($data);
        if ($op_update) {
            # code...
            $message = "Raw Updated";
        }else{
            $message = "Error To Update";
        }
        session()->flash('Message',$message);
        return redirect(url('/album'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $op_delete = DB::table('album')->where('id',$id)->delete();
        if ($op_delete) {
            # code...
            $message = "Raw Deleted";
        }else{
            $message = "Error to Deleted";
        }
        session()->flash('Message',$message);
        return redirect(url('album'));
    }

    public function movePictures($id)
    {
        //
        $data = DB::table('album')->get();
        return view('album.movePictures',['id'=>$id , 'data'=>$data ,'title'=>"Move Picture To"]);
    }

    public function movePicturesTo(Request $request , $id)
    {
        //
        $data = $this->validate($request,[

            'album_id'=>'required|int',
        ]);
        $op = DB::table('pictures')->where('album_id',$id)->get();
        foreach ($op as $key => $value) {
            # code...
            $value->album_id = $data['album_id'];
        }

        $op_update = DB::table('pictures')->where('album_id',$id)->update($data);


        if ($op_update) {
            # code...
            $message = "Album Moved";
        }else{
            $message = "Error To Move Album";
        }
        session()->flash('Message',$message);
        return redirect(url('/album'));


        // $data = DB::table('album')->get();
        // return view('album.movePictures',['id'=>$id , 'data'=>$data ,'title'=>"Move Picture To"]);
    }
}
