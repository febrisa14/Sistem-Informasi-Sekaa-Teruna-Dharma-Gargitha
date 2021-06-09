<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Pemesanan</title>
    <link rel="stylesheet" id="css-main" href="{{ url('assets/css/oneui.min.css') }}">
<style>
    .page {
        width: 210mm;
        margin-left: auto;
        margin-right: auto;
        background: white;
        height: 297mm;
    }

    .content{
        margin-top: -20px;
        margin-right: 40px;
    }

    .logo {
        width: 80px;
        display: block;
        margin-left: 210px;
    }
    .garis {
    width: 190mm;
    margin-right: auto;
    margin-left: auto;
    height: 2px;
    background-color: black;
    margin-top: 2px;
    margin-top: 10px;
}

.center {
    margin-left: auto;
    margin-right: auto;
}
</style>
</head>

<body>
    <div class="page">
        <div class="content">
        <table class="kop-surat table-borderless">
            <tr>
                <td rowspan="4"><img class="logo" src="{{ url('/assets/media/logo/logo-login.png') }}"></td>
                <td></td>
                <td></td>
                <td colspan="3" style="font-size: 21px; text-align:center;"><b>ST. DHARMA GARGITHA</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td colspan="3" style="font-size: 14px; text-align:center;">BR. Suwung Batan Kendal</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td colspan="3" style="font-size: 12px; text-align:center;">Sekretariat, Jl. Raya Suwung Batan Kendal</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td colspan="3" style="font-size: 11px; text-align:center;">Email: stdharmagargitha@gmail.com</td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <hr class="garis">
        <table class="center">
            @if($status == "Selesai")
            <tr>
                <td style="font-size: 14pt; text-align:center;"><b>Laporan Pemesanan</b></td>
            </tr>
            @endIf
            @if($status == "Menunggu")
            <tr>
                <td style="font-size: 14pt; text-align:center;"><b>Data Pemesanan</b></td>
            </tr>
            @endIf
            <tr>
                <td style="font-size: 11pt; text-align:center;">{{$baju->nama_baju}}</td>
            </tr>
        </table>
        <br>
        <table class="center table-bordered">
            <tr style="text-align: center;">
                <th style="padding: 10px;">No.</th>
                @if($status == "Selesai")
                <th style="padding: 10px 30px;">Tgl. Bayar</th>
                @endIf
                @if($status == "Menunggu")
                <th style="padding: 10px 30px;">Tgl. Pemesanan</th>
                @endIf
                <th style="padding: 10px 80px;">Nama</th>
                <th style="padding: 10px 40px;">Gender</th>
                <th style="padding: 10px 40px;">Size</th>
            </tr>
            @foreach ($pemesanan as $pemesanan)
            <tr style="text-align: center;">
                <td>{{$loop->iteration}}.</td>
                @if($status == "Selesai")
                <td>{{date('d M, Y', strtotime($pemesanan->tgl_bayar))}}</td>
                @endIf
                @if($status == "Menunggu")
                <td>{{date('d M, Y', strtotime($pemesanan->tgl_pesanan))}}</td>
                @endIf
                <td>{{$pemesanan->name}}</td>
                <td>{{$pemesanan->jenis_kelamin}}</td>
                <td>{{$pemesanan->size}}</td>
            </tr>
            @endforeach
        </table>
        <br>
        @if($status == "Selesai")
        <table style="margin-left: 80px;">
            <tr>
                <td>Total Pendapatan Penjualan Baju</td>
                <td>:</td>
                <td><b>Rp. {{number_format($total)}}</b></td>
            </tr>
        </table>
        <table class="table table-borderless" style="margin-bottom: 5px;">
            <tr>
                <td style="font-size: 11pt; text-align:right;">Denpasar, {{now()->format('d M Y')}}</td>
            </tr>
        </table>
        <br>
        <table class="table table-borderless" style="margin-bottom: 5px;">
            <tr>
                <td style="font-size: 11pt; text-align:left;"><b>Ketua STT</b></td>
                <td style="font-size: 11pt; text-align:right;"><b>Bendahara</b></td>
            </tr>
            <tr>
                <td style="font-size: 11pt; text-align:left;"></td>
            </tr>
            <tr>
                <td style="font-size: 11pt; text-align:left;"></td>
            </tr>
            <tr>
                <td style="font-size: 11pt; text-align:left;">{{$KetuaSTT->name}}</td>
                <td style="font-size: 11pt; text-align:right;">{{$Bendahara->name}}</td>
            </tr>
        </table>
        @endIf
        </div>
    </div>

    <script>
        window.print();
    </script>
    <script src="{{ url('assets/js/oneui.core.min.js') }}"></script>
    <script src="{{ url('assets/js/oneui.app.min.js') }}"></script>
</body>
</html>
