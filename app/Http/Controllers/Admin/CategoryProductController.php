<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LoaiSanPham;
class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    function ListCategroies(){
        $listLsp=DB::table("loaisanpham")->paginate(5);
        return view("management_admin.showcategories",compact("listLsp"));
    }


    function AddCategories(Request $request){
        $request->validate([
            'category_name'=>'required|max:200',
        ]);
        $data=$request->all();
        $check=$this->create($data);
        return redirect()->route('listcategories');
    }


    function AddScreenCategroies(){
        return view("management_admin.add_categories");
    }


    function EditScreenCategroies($id){
        $lsp=LoaiSanPham::find($id);
        return view("management_admin.edit_categories",compact('lsp'));
    }


    function EditCategories($id,Request $request){
        $request->validate([
            'category_name'=>'required|max:200',
        ]);
        $data=$request->all();
        $lsp=LoaiSanPham::find($id);
        $lsp->tenLoaiSanPham=$data['category_name'];
        $lsp->save();
        return redirect()->route('listcategories');
    }


    function removecategories($id){
        DB::table("loaisanpham")->where("id",$id)->delete();
        return redirect()->route('listcategories');
    }


    function SeekCategory(Request $request){
        $data=$request->get('seek');
        $listLsp=DB::table('loaisanpham')->where('tenloaisanpham','LIKE','%'.$data.'%')
        ->paginate(5); 
        return view("management_admin.showcategories",compact("listLsp"));
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(array $data)
    {
        //
        return LoaiSanPham::create([
            'tenloaisanpham'=>$data['category_name']    
        ]);
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
    }
}
