<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Crypt;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Hiển thị danh sách đơn hang
        $all_order = DB::table('donhang')
            ->join('users', 'donhang.id_user', '=', 'users.id')
            ->select('donhang.*', 'users.hoten')
            ->orderby('donhang.id', 'desc')->paginate(10);
        $manager_order = view('admin.manage_order')->with('all_order', $all_order);
        return view('admin_layout')->with('admin.manager_order', $manager_order);
    }
    public function view_order($orderId)
    {
        $all_order = DB::table('donhang')
            ->join('users', 'donhang.id_user', '=', 'users.id')
            ->select('donhang.*', 'users.hoten')
            ->orderby('donhang.id', 'desc')->paginate(10);
        $manager_order = view('admin.manage_order')->with('all_order', $all_order);


        $order_by_id = DB::table('donhang')
            ->join('diachi', 'diachi.id_user', '=', 'donhang.id_user')
            ->join('users', 'donhang.id_user', '=', 'users.id')
            ->join('donhangChiTiet', 'donhang.id', '=', 'donhangChiTiet.id_donhang')
            ->join('SanPham', 'donhangChiTiet.id_sanpham', '=', 'SanPham.id')
            ->select('donhang.*', 'diachi.*', 'users.*', 'donhangChiTiet.*', 'SanPham.*')
            ->where('donhang.id', '=', $orderId)
            ->first();



        $order_by_id_product = DB::table('donhang')
            ->join('diachi', 'diachi.id_user', '=', 'donhang.id_user')
            ->join('users', 'donhang.id_user', '=', 'users.id')
            ->join('donhangchitiet', 'donhang.id', '=', 'donhangchitiet.id_donhang')
            ->join('sanpham', 'donhangchitiet.id_sanpham', '=', 'sanpham.id')
            ->select('donhang.*', 'diachi.*', 'users.*', 'donhangchitiet.*', 'sanpham.*')
            ->where('donhang.id', '=', $orderId)
            ->get();
        // var_dump($order_by_id_product);
        // die();
        if ($order_by_id !== null) {
            $manager_order_by_id = view('admin.view_order')->with('order_by_id', $order_by_id)->with('all_order', $all_order)->with('order_by_id_product', $order_by_id_product);

            return view('admin_layout')->with('admin.view_order', $manager_order_by_id);
        }
        return redirect()->back();
    }
    public function updateStatus(Request $request, $id)
    {
        $status = $request->input('status');
        DB::table('donhang')->where('id', $id)->update(['trangthai' => $status]);
        // Redirect back to order view page
        return redirect()->back();
    }
    public function cancel_order($order_id)
    {
        DB::table('donhang')->where('id', $order_id)->update(['trangthai' => 4]);
        return redirect()->back();
    }
    public function print_order($order_id)
    {
        $order = DB::table('donhang')
            ->join('donhangchitiet', 'donhangchitiet.id_donhang', '=', 'donhang.id')
            ->join('users', 'donhang.id_user', '=', 'users.id')
            ->join('diachi', 'users.id', '=', 'diachi.id_user')
            ->select('donhang.*', 'users.*', 'donhangchitiet.*', 'diachi.*')
            ->where('donhang.id', '=', $order_id)
            ->first();

        $orderDetails = DB::table('donhang')
        ->join('diachi', 'diachi.id_user', '=', 'donhang.id_user')
        ->join('users', 'donhang.id_user', '=', 'users.id')
        ->join('donhangchitiet', 'donhang.id', '=', 'donhangchitiet.id_donhang')
        ->join('sanpham', 'donhangchitiet.id_sanpham', '=', 'sanpham.id')
        ->select('donhang.*', 'diachi.*', 'users.*', 'donhangchitiet.*', 'sanpham.*','donhangchitiet.gia as giaCT')
        ->where('donhang.id', '=', $order_id)
        ->get();

        $invoice = [
            'invoice_no' => $order->id_donhang, // Thay 'order_id' bằng 'invoice_no'
            'name' => $order->name,
            'email' => $order->email,
            'sdt' => $order->sdt,
            'customer_address' => $order->cuThe,
            'tongtien'=>$order->tongtien,
            'items' => $orderDetails
        ];
        // var_dump($orderDetails);
        // die();
        
        $pdf = PDF::loadView('pages.invoice', compact('invoice'));

        return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
