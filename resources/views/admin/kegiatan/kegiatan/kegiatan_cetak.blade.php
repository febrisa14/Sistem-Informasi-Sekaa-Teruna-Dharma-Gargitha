<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak PDF</title>
<style>
.page {

}

#head {
    margin-left: auto;
    margin-right: auto;
    width: 17cm;
}

.logo {
    margin-left: 150px;
    width: 80px;
    margin-top: 5px;
    display: block;
}

.kop-surat {
    float: right;
    margin-right: 210px;
    margin-top: -90px;
}

.kop-surat > li {
    list-style-type: none;
    text-align: center;
}

.nama-stt {
    font-size: 21px;
    font-weight: bold;
}

.nama-kedua {
    font-size: 13px;
    font-weight: bold;
}

.nama-ketiga {
    font-size: 11px;
}

.garis {
    width: 14cm;
    margin-right: auto;
    margin-left: auto;
    height: 2px;
    background-color: black;
    margin-top: 2px;
}

#content {
    margin-top: 60px;
    width: 100%;
    /* background: brown; */
    margin-left: 90px;
    margin-right: 90px;
    text-align: justify;
}

p.text-kanan {
    margin-top: 10px;
    float: right;
    font-size: 12px;
}

p.text-kiri {
    font-size: 12px;
}

p.deskripsi {
    font-size: 12px;
    margin-top: 20px;
    width: 100%;
}

.table {
    margin-top: 20px;
}

.table td {
    font-size: 12px;
}
</style>
</head>

<body>
    <div class="page">
        <header id="head">
            <img class="logo" src="{{ public_path("/assets/media/logo/logo-login.png") }}">
            <ul class="kop-surat">
                <li class="nama-stt">ST. DHARMA GARGITHA</li>
                <li class="nama-kedua">BR. Suwung Batan Kendal</li>
                <li class="nama-ketiga">Jl. Raya Suwung Batan Kendal No. x</li>
                <li class="nama-ketiga">Email: admin.stdharmagargitha@gmail.com</li>
                <li class="nama-ketiga">No. Telp: (0361) 721 999</li>
            </ul>
            <div class="garis"></div>
        </header>
        <div id="content">
            @foreach ($data as $pengumuman)
            <p class="text-kanan">Denpasar, {{$pengumuman->created_at}}</p>
            <p class="text-kiri">Yth.</p>
            <p class="text-kiri">Seluruh Anggota Sekaa Teruna Dharma Gargitha</p>
            <p class="text-kiri">di tempat</p>
            <p class="deskripsi">Sehubungan dengan adanya kegiatan/pelaksanaan "<strong><em>{{$pengumuman->nama_kegiatan}}</em></strong>", Kami ingin menyampaikan bahwa untuk seluruh Anggota Sekaa Teruna Dharma Gargitha diharapkan kehadirannya pada:</p>
                <table class="table table-bordered">
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td>{{$pengumuman->tgl_kegiatan}}</td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td>:</td>
                        <td>{{$pengumuman->lokasi}}</td>
                    </tr>
                    <tr>
                        <td>Jam</td>
                        <td>:</td>
                        <td>{{$pengumuman->jam_kegiatan}}</td>
                    </tr>
                    <tr>
                        <td>Pakaian</td>
                        <td>:</td>
                        <td>{{$kegiatan->pakaian}}</td>
                    </tr>
                </table>
            @endforeach
            <p class="deskripsi">Demikian surat yang kami sampaikan. Kami meminta maaf apabila terdapat kesalahan dalam penulisan kata. Atas perhatiannya terima kasih.</p>
        </div>
    </div>
</body>
</html>
