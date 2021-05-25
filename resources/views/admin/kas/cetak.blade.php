<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Kas</title>
    <link rel="stylesheet" id="css-main" href="{{ url('assets/css/oneui.min.css') }}">
<style>
    .page {
        width: 210mm;
        margin-left: auto;
        margin-right: auto;
        background: white;
        height: 297mm;
    }
    .logo {
        width: 80px;
        display: block;
        margin-left: 210px;
    }
    .garis {
    width: 150mm;
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
            <tr>
                <td style="font-size: 14pt; text-align:center;"><b>Laporan Kas</b></td>
            </tr>
            <tr>
                <td style="font-size: 11pt; text-align:center;">Periode {{date('d M, Y',strtotime($tglawal))}} s/d {{date('d M, Y',strtotime($tglakhir))}}</td>
            </tr>
        </table>
        <br>
        <table class="center" style="margin-bottom: 5px;">
            <tr>
                <td style="font-size: 12pt; text-align:left;"><b>Pemasukan</b></td>
            </tr>
        </table>
        <table class="center table-bordered">
            <tr style="text-align: center;">
                <th style="padding: 10px;">No.</th>
                <th style="padding: 10px 80px;">Uraian</th>
                <th style="padding: 10px 60px;">Tanggal</th>
                <th style="padding: 10px 60px;">Nominal</th>
            </tr>
            @foreach ($pemasukan as $pemasukan)
            <tr style="text-align: center;">
                <td>{{$loop->iteration}}.</td>
                <td>{{$pemasukan->deskripsi}}</td>
                <td>{{date('d M, Y',strtotime($pemasukan->tgl_transaksi))}}</td>
                <td>Rp. {{number_format($pemasukan->nominal)}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" style="text-align: center"><b>Total Pemasukan</b></td>
                <td style="text-align: center;">Rp. {{number_format($pemasukanTotal)}}</td>
            </tr>
        </table>
        <table class="center" style="margin-bottom: 5px; margin-top: 20px;">
            <tr>
                <td style="font-size: 12pt; text-align:left;"><b>Pengeluaran</b></td>
            </tr>
        </table>
        <table class="center table-bordered">
            <tr style="text-align: center;">
                <th style="padding: 10px;">No.</th>
                <th style="padding: 10px 80px;">Uraian</th>
                <th style="padding: 10px 60px;">Tanggal</th>
                <th style="padding: 10px 60px;">Nominal</th>
            </tr>
            @foreach ($pengeluaran as $pengeluaran)
            <tr style="text-align: center;">
                <td>{{$loop->iteration}}.</td>
                <td>{{$pengeluaran->deskripsi}}</td>
                <td>{{date('d M, Y',strtotime($pengeluaran->tgl_transaksi))}}</td>
                <td>Rp. {{number_format($pengeluaran->nominal)}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" style="text-align: center"><b>Total Pengeluaran</b></td>
                <td style="text-align: center;">Rp. {{number_format($pengeluaranTotal)}}</td>
            </tr>
        </table>
        <br>
        <table style="margin-left: 80px;">
            <tr>
                <td>Saldo Kas pada periode ini</td>
                <td>:</td>
                <td><b>Rp. {{number_format($saldoKas)}}</b></td>
            </tr>
            <tr>
                <td>Saldo Kas seluruhnya</td>
                <td>:</td>
                <td><b>Rp. {{number_format($saldoKasTotal)}}</b></td>
            </tr>
        </table>
    </div>

    <script>
        window.print();
    </script>
    <script src="{{ url('assets/js/oneui.core.min.js') }}"></script>
    <script src="{{ url('assets/js/oneui.app.min.js') }}"></script>
</body>
</html>
