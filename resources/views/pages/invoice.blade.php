<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font-family: DejaVu SanS;

    }

    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .page {
        width: 21cm;
        min-height: 29.7cm;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .subpage {
        padding: 1cm;
        border: 5px red solid;
        height: 256mm;
        outline: 2cm #FFEAEA solid;
    }

    @page {
        size: A4;
        margin: 0;
    }

    @media print {
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }

    button {
        width: 100px;
        height: 24px;
    }

    .header {
        padding: 50px 0;
    }

    .logo {
        background-color: #FFFFFF;
        text-align: left;
    }

    .company {
        padding-top: 24px;
        text-transform: uppercase;
        background-color: #FFFFFF;
        text-align: right;
        font-size: 16px;
        padding-right: 70px;
    }

    .title {
        text-align: center;
        position: relative;
        color: #0000FF;
        font-size: 20px;
    }

    .footer-left {
        text-align: center;
        text-transform: uppercase;
        padding-top: 24px;
        position: relative;
        height: 150px;
        width: 50%;
        color: #000;
        float: left;
        font-size: 12px;
        bottom: 1px;
    }

    .footer-right {
        text-align: center;
        text-transform: uppercase;
        padding-top: 24px;
        position: relative;
        height: 150px;
        width: 50%;
        color: #000;
        font-size: 12px;
        float: right;
        bottom: 1px;
    }

    .infomation {

        padding: 0 70px;
    }

    .infomation tr th {
        text-align: left;

        font-weight: normal;
    }

    .TableData {
        padding: 0 70px;
        text-align: center;
        background: #ffffff;
        font: 11px;
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
        border: thin solid #d3d3d3;
    }

    .TableData TH {
        background: rgba(0, 0, 255, 0.1);
        text-align: center;
        font-weight: bold;
        color: #000;
        border: solid 1px #ccc;
        height: 24px;
    }

    .TableData TR {
        height: 24px;
        border: thin solid #d3d3d3;
    }

    .TableData TR TD {
        padding-right: 2px;
        padding-left: 2px;
        border: thin solid #d3d3d3;
    }

    .TableData TR:hover {
        background: rgba(0, 0, 0, 0.05);
    }

    .TableData .cotSTT {
        text-align: center;
        width: 5%;
    }

    .TableData .cotTenSanPham {
        text-align: left;
        width: 20%;
    }

    .TableData .cotGia {
        text-align: right;
        width: 10%;
    }

    .TableData .cotSoLuong {
        text-align: center;
        width: 10%;
    }

    .TableData .cotSo {
        text-align: right;
        width: 10%;
    }

    .TableData .tong {
        text-align: right;
        font-weight: bold;
        text-transform: uppercase;
        padding-right: 10%;
    }

    .TableData .cotSoLuong input {
        text-align: center;
    }
</style>

<body onload="window.print();">
    <?php
    //   var_dump($invoice['items']);
    //   die();

    ?>
    <div id="page" class="page">
        <div class="header">
            <!-- <div class="logo"><img src="/public/uploads/a2-9005-1678197385.jpg"/></div> -->
            <!-- <div class="company">C.Ty TNHH 4 thành viên</div> -->
        </div>
        <div class="title"><b>HÓA ĐƠN THANH TOÁN<br />-------oOo-------</b>
        </div>
        <br />
        <br />


        <table class="infomation">
            <tr>
                <th>Mã số hóa đơn</th>
                <th>: {{ $invoice['invoice_no'] }}</th>
            </tr>
            <tr>
                <th>Họ và tên</th>
                <th>: {{ $invoice['name'] }}</th>
            </tr>
            <tr>
                <th>Email</th>
                <th>: {{ $invoice['email'] }}</th>
            </tr>
            <tr>
                <th>Số điện thoại</th>
                <th>: {{ $invoice['sdt'] }}</th>
            </tr>
            <tr>
                <th>Địa chỉ</th>
                <th>: {{ $invoice['customer_address'] }}</th>
            </tr>
        </table>
        <br><br>





        <table class="TableData">
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
            @foreach ($invoice['items'] as $value => $item)
            <tr>
                <td class="cotSTT">{{ $loop->iteration }}</td>
                <td class="cotTenSanPham">{{ $item->tensp }}</td>
                <td class="cotSo">{{ $item->gia }}</td>
                <td class="cotSoLuong" align="center">{{ $item->soluong }}</td>
                <td class="cotGia">
                    <div id="giasp" name="giasp">{{ number_format($item->giaCT, 0, ",", ".") }}</div>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" class="tong">Tổng cộng</td>
                <td class="cotso"><?php echo number_format(($invoice['tongtien']), 0, ",", ".") ?></td>
            </tr>
        </table>
        <br>
        <div class="footer-right"> ,ngày&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;tháng&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;năm <br />
            Nhân viên </div>
    </div>
</body>