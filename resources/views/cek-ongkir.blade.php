<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.3.2/dist/select2-bootstrap4.min.css"
        rel="stylesheet" />
    <title>Test Web Dev Bage - Rajaongkir</title>
</head>

<body style="background: #f3f3f3">

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3>PILIH KOTA ASAL</h3>
                        <hr>
                        <div class="form-group">
                            <label class="font-weight-bold">PROVINSI ASAL</label>
                            <select class="form-control provinsi-asal" name="provinsi_asal" id="provinsi_asal">
                                <option value="0">-- pilih provinsi asal --</option>
                                @foreach ($provinsi as $row)
                                <option value="{{ $row['province_id']}}" namaprovinsi="{{$row['province']}}">
                                    {{$row['province']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">KOTA / KABUPATEN ASAL</label>
                            <select class="form-control kota-asal" name="kota_asal" id="kota_asal">
                                <option value="">-- pilih kota asal --</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3>PILIH KOTA TUJUAN</h3>
                        <hr>
                        <div class="form-group">
                            <label class="font-weight-bold">PROVINSI ASAL</label>
                            <select class="form-control provinsi-asal" name="provinsi_tujuan" id="provinsi_tujuan">
                                <option value="0">-- pilih provinsi asal --</option>
                                @foreach ($provinsi as $row)
                                <option value="{{ $row['province_id']}}" namaprovinsi="{{$row['province']}}">
                                    {{$row['province']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">KOTA / KABUPATEN ASAL</label>
                            <select class="form-control kota-asal" name="kota_tujuan" id="kota_tujuan">
                                <option value="">-- pilih kota asal --</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3>PILIH KURIR</h3>
                        <hr>
                        <div class="form-group">
                            <label>PROVINSI TUJUAN</label>
                            <select class="form-control kurir" name="kurir">
                                <option value="0">-- pilih kurir --</option>
                                <option value="jne">JNE</option>
                                <option value="pos">POS</option>
                                <option value="tiki">TIKI</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">BERAT (GRAM)</label>
                            <input type="number" class="form-control" name="berat" id="berat"
                                placeholder="Masukkan Berat (GRAM)">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3>LAYANAN</h3>
                        <hr>
                        <ul class="list-group" id="data-ongkir">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function(){

            $(".provinsi-asal , .kota-asal, .provinsi-tujuan, .kota-tujuan, .layanan").select2({
            theme:'bootstrap4',width:'style',
        });

            $('select[name="provinsi_asal"]').on('change', function(){
            let provinceid = $(this).val();
            if(provinceid){
                jQuery.ajax({
                url:"/kota/"+provinceid,
                type:'GET',
                dataType:'json',
            success:function(data){
                $('select[name="kota_asal"]').empty();
                $('select[name="kota_asal"]').append('<option value="">-- Pilih kota asal --</option>');
                $.each(data, function(key, value){
                $('select[name="kota_asal"]').append('<option value="'+ value.city_id +'" namakota="'+ value.type +' ' +value.city_name+ '">' + value.type + ' ' + value.city_name + '</option>');
                });
            }
            });
            }else {
                $('select[name="kota_asal"]').empty();
            }
            });

            $('select[name="provinsi_tujuan"]').on('change', function(){
            let provinceid = $(this).val();
            if(provinceid){
                jQuery.ajax({
                url:"/kota/"+provinceid,
                type:'GET',
                dataType:'json',
            success:function(data){
                $('select[name="kota_tujuan"]').empty();
                $('select[name="kota_tujuan"]').append('<option value="">-- Pilih kota tujuan --</option>');
                $.each(data, function(key, value){
                $('select[name="kota_tujuan"]').append('<option value="'+ value.city_id +'" namakota="'+ value.type +' ' +value.city_name+ '">' + value.type + ' ' + value.city_name + '</option>');
                });
            }
            });
            }else {
                $('select[name="kota_tujuan"]').empty();
            }
            });

            $('input[name=berat]').on('change', function(){
            let asal = $("select[name=kota_asal]").val();
            let tujuan = $("select[name=kota_tujuan]").val();
            let kurir = $("select[name=kurir]").val();
            let berat = $("input[name=berat]").val();
            if(kurir){
                jQuery.ajax({
                url:"/origin="+asal+"&destination="+tujuan+"&weight="+berat+"&courier="+kurir,
                type:'GET',
                dataType:'json',
                success:function(data){
                    $('select[name="layanan"]').empty();
                    $.each(data, function(key, value){
                    $.each(value.costs, function(key1, value1){
                    $.each(value1.cost, function(key2, value2){
                        $('#data-ongkir').append('<li class="list-group-item">' + value.code.toUpperCase() + ' : <strong>' + value1.service + '</strong> - ' + value1.description + ' - Rp. ' + value2.value + ' ('+value2.etd+' hari)</li>');
                        });
                    });
                    });
                }
                });
                } else {
                $('select[name="layanan"]').empty();
            }
            });
        });
    </script>
</body>

</html>