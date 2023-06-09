<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .container {
            max-width: 800px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                Data Pegawai
            </div>
            <div class="card-body">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name ="katakunci" value="<?php echo $katakunci ?>" placeholder="Masukan Kata Kunci" aria-label="Masukan Kata Kunci" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
                    </div>
                </form>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    + Tambah Data Pegawai
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Pegawai</h1>
                                <button type="button" class="btn-close tombol-tutup" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-danger error" role="alert" style="display: none"></div>
                                <div class="alert alert-primary sukses" role="alert" style="display: none"></div>
                                <div class="mb-3 row">
                                    <div class="col-sm-10">
                                        <input type="hidden" class="form-control" id="inputId">
                                    </div>
                                </div>                               
                                <div class="mb-3 row">
                                    <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputNama">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputBidang" class="col-sm-2 col-form-label">Bidang</label>
                                    <div class="col-sm-10">
                                        <select id="inputBidang" class="form-select">
                                            <option value="Finance">Finance</option>
                                            <option value="Marketing">Marketing</option>
                                            <option value="HR">HR</option>
                                            <option value="GIS Analyst">GIS Analyst</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputAlamat">
                                        </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary tombol-tutup" data-bs-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-primary" id="tombolSimpan">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Bidang</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $i = 1 + ($jumlahBaris * ($nomor - 1));
                            foreach($dataPegawai as $k => $v){
                        ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $v['nama'] ?></td>
                            <td><?= $v['email'] ?></td>
                            <td><?= $v['bidang'] ?></td>
                            <td><?= $v['alamat']; ?></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="edit(<?php echo $v['id']?>)">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="hapus(<?php echo $v['id']?>)">Delete</button>
                            </td>
                        </tr>
                        <?php }  ?>
                    </tbody>
                </table>
                <?php 
                    $linkPagination = $pager->links();
                    $linkPagination = str_replace('<li class="active>', '<li class="page-item active">', $linkPagination);
                    $linkPagination = str_replace('<li>', '<li class="page-item">', $linkPagination);
                    $linkPagination = str_replace("<a", "<a class='page-link'", $linkPagination);
                    echo $linkPagination;

                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script>
        function hapus ($id) {
            var result = confirm("Yakin mau melakukan proses delete");
            if (result) {
                window.location = "<?= site_url("pegawai/hapus")?>/" + $id
            }
        }
        function edit ($id) {
            $.ajax({
                url: "<?php echo site_url("pegawai/edit") ?>/" + $id,
                type: "get",
                success: function(hasil){
                    var $obj = $.parseJSON(hasil)
                    if ($obj.id != '') {
                        $('#inputId').val($obj.id);
                        $('#inputNama').val($obj.nama);
                        $('#inputEmail').val($obj.email);
                        $('#inputBidang').val($obj.bidang);
                        $('#inputAlamat').val($obj.alamat);
                    }
                }
            })
        }
        function bersihkan(){
            $('#inputId').val('');
            $('#inputNama').val('');
            $('#inputEmail').val('');
            $('#inputAlamat').val('');
        }

        $('.tombol-tutup').on('click', function(){
            if($('.sukses').is(":visible")){
                window.location.href = "<?php echo current_url() . "?" . $_SERVER['QUERY_STRING'] ?>";
            }
            $('.alert').hide();
            bersihkan();
        })
        $('#tombolSimpan').on('click',function(){
            var $id = $('#inputId').val();
            var $nama = $('#inputNama').val();
            var $email = $('#inputEmail').val();
            var $bidang = $('#inputBidang').val();
            var $alamat = $('#inputAlamat').val();
            $.ajax({
                url: "<?php echo site_url("pegawai/simpan")?>",
                type: "POST",
                data: {
                    id : $id,
                    nama: $nama,
                    email: $email,
                    bidang: $bidang,
                    alamat: $alamat
                },
                success: function(hasil){
                    var $obj = $.parseJSON(hasil);
                    if($obj.sukses == false){
                        $('.sukses').hide();
                        $('.error').show();
                        $('.error').html($obj.error);
                    } else{
                        $('.error').hide();
                        $('.sukses').show();
                        $('.sukses').html($obj.sukses);
                    }
                }
            });
            bersihkan();
        })
    </script>
</body>
</html>