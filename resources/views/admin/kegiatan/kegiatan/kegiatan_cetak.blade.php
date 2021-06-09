<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Kegiatan</title>
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
            <table class="table table-borderless" style="margin-bottom: 5px;">
                <tr>
                    <td style="font-size: 10pt; text-align:right;">Denpasar, {{$kegiatan->created_at}}</td>
                </tr>
            </table>
            <table class="table table-borderless" style="margin-bottom: 5px;">
                <tr>
                    <td style="font-size: 10pt; text-align:left;">Yth.</td>
                </tr>
                <tr>
                    <td style="font-size: 10pt; text-align:left;">Seluruh Anggota Sekaa Teruna Dharma Gargitha</td>
                </tr>
                <tr>
                    <td style="font-size: 10pt; text-align:left;">di tempat</td>
                </tr>
            </table>
            <br>
            <table class="table table-borderless" style="margin-bottom: 5px;">
                <tr>
                    <td style="font-size: 10pt; text-align:justify; text-indent: 45px;">Sehubungan dengan adanya kegiatan/pelaksanaan "<strong><em>{{$kegiatan->nama_kegiatan}}</em></strong>", Kami ingin menyampaikan bahwa untuk seluruh Anggota Sekaa Teruna Dharma Gargitha diharapkan kehadirannya pada:</td>
                </tr>
            </table>
            <table class="table table-borderless" style="margin-bottom: 5px;">
                <tr style="font-size: 10pt; text-align:left;">
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>{{date('d M, Y', strtotime($kegiatan->tgl_kegiatan))}}</td>
                </tr>
                <tr style="font-size: 10pt; text-align:left;">
                    <td>Lokasi</td>
                    <td>:</td>
                    <td>{{$kegiatan->lokasi}}</td>
                </tr>
                <tr style="font-size: 10pt; text-align:left;">
                    <td>Jam</td>
                    <td>:</td>
                    <td>{{$kegiatan->jam_kegiatan}}</td>
                </tr>
                <tr style="font-size: 10pt; text-align:left;">
                    <td>Pakaian</td>
                    <td>:</td>
                    <td>{{$kegiatan->pakaian}}</td>
                </tr>
            </table>
            <table class="table table-borderless" style="margin-bottom: 5px;">
                <tr>
                    <td style="font-size: 10pt; text-align:justify; text-indent: 45px;">Demikian surat yang kami sampaikan. Kami meminta maaf apabila terdapat kesalahan dalam penulisan kata. Atas perhatiannya terima kasih.</td>
                </tr>
            </table>
            <br>
            <table class="table table-borderless" style="margin-bottom: 5px;">
                <tr>
                    <td style="font-size: 10pt; text-align:left;"><b>Ketua STT</b></td>
                    <td style="font-size: 10pt; text-align:right;"><b>Sekretaris</b></td>
                </tr>
                <tr>
                    <td style="font-size: 10pt; text-align:left;"></td>
                </tr>
                <tr>
                    <td style="font-size: 10pt; text-align:left;"></td>
                </tr>
                <tr>
                    <td style="font-size: 10pt; text-align:left;">{{$KetuaSTT->name}}</td>
                    <td style="font-size: 10pt; text-align:right;">{{$Sekretaris->name}}</td>
                </tr>
            </table>
        </div>
    </div>
    <script>
        window.print();
    </script>
    <script src="{{ url('assets/js/oneui.core.min.js') }}"></script>
    <script src="{{ url('assets/js/oneui.app.min.js') }}"></script>
</body>
</html>
