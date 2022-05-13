<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class picturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            # code...
        $data = DB::table('pictures')->join('album','album.id','=','album_id')->select('pictures.*','album.name as albumName')->get();
        return view('pictures.index',["data" => $data , "title"=>"Display Pictures"]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = DB::table('album')->get();
        return view('pictures.create',["data"=>$data , "title"=>"Add Pictures"]);
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
        $data=$this->validate($request,[
            "name"        => "required|min:3",
            "album_id"    => "required|int",
            "img_dir"     => "required|image|mimes:png,jpg",

        ]);

        $finalName = uniqid() . "." . $request->img_dir->extension();

        if($request->img_dir->move(public_path('/album_pictures'),$finalName)){
            $data['img_dir'] = $finalName;
        }


        $op_create = DB::table('pictures')->insert($data);
        if($op_create){
            $message = "Raw Inserted";
        }else{
            $message = "Error in Insert";
        }
        session()->flash("Message",$message);
        return redirect(url("/pictures"));

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
        $data = DB::table('pictures')->find($id);
        $data_album = DB::table('album')->get();
        return view('pictures.edit',["data"=>$data,"data_album"=>$data_album , "title"=>"Edit Picture"]);
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
        $data=$this->validate($request,[
            "name"        => "required|min:5",
            "album_id"    => "required|int",
            "img_dir"       => "nullable|image|mimes:png,jpg",
        ]);

        $rawData = DB::table('pictures')->find($id);

        if($request->has('img_dir')){
               $finalName = uniqid() . "." . $request->img_dir->extension();

               if($request->img_dir->move(public_path('/album_pictures'),$finalName)){

               $data['img_dir'] = $finalName;
               unlink(public_path('album_pictures/'.$rawData->img_dir));
            }

        }else{
            $data['img_dir'] = $rawData->img_dir;
        }

        $op_update = DB::table('pictures')->where('id',$id)->update($data);
        if($op_update){
            $message = "Raw Updated";
        }else{
            $message = "Error in Update";
        }
        session()->flash("Message",$message);
        return redirect(url("/pictures"));
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
        $rawData = DB::table('pictures')->find($id);
        $op_delete = DB::table('pictures')->where('id',$id)->delete();
        if($op_delete){
            unlink(public_path('album_pictures/'.$rawData->img_dir));
            $message = "Raw Deleted";
        }else{
            $message = "Error In Delete";
        }
        session()->flash('Message',$message);
        return redirect(url('/pictures'));
    }
}
