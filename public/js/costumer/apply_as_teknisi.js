$(document).ready(function () {
    console.log("Document ready, script jalan.");

    const provinsi = $('#province');
    console.log("Provinsi select found:", provinsi.length);
    $('#kabupaten-container').hide();
    $('#kecamatan-container').hide();
    $('#kelurahan-container').hide();

    $('#province').on('change', function () {

        var selectedProvince = $(this).find(':selected').data('code');

        console.log(selectedProvince);
        if (selectedProvince) {
            $('#kabupaten-container').show();
            $.ajax({
                url: '/api/wilayah/regencies/' + selectedProvince,
                type: 'GET',
                success: function (region) {
                    console.log(region);
                    const response = region.data;
                    console.log("Kabupaten Data:", response); // debug data
                    $('#kabupaten').empty();
                    $('#kabupaten').append('<option value="">Pilih Kabupaten</option>');
                    $.each(response, function (index, item) {
                        $('#kabupaten').append('<option data-code="' + item.code + '" value="' + item.name + '">' + item.name + '</option>');
                    });
                }
            });
        } else {
            $('#kabupaten-container').hide();
        }
    });

    $('#kabupaten').on('change', function () {
        var selectKecamatan = $(this).find(':selected').data('code');
        if (selectKecamatan) {
            $('#kecamatan-container').show();
            // Fetch kecamatan data based on selected kabupaten
            $.ajax({
                url: '/api/wilayah/districts/{kode}' + selectKecamatan,
                type: 'GET',
                success: function (subdistrict) {
                    console.log(subdistrict);
                    const response = subdistrict.data;
                    console.log("Kecamatan Data:", response); // debug data
                    $('#kecamatan').empty();
                    $('#kecamatan').append('<option value="">Pilih Kecamatan</option>');
                    $.each(response, function (index, item) {
                        $('#kecamatan').append('<option data-code="' + item.code + '" value="' + item.name + '">' + item.name + '</option>');
                    });
                }
            });
        } else {
            $('#kecamatan-container').hide();
        }
    });

    $('#kecamatan').on('change', function () {
        var selectKelurahan = $(this).find(':selected').data('code');
        if (selectKelurahan) {
            $('#kelurahan-container').show();
            // Fetch kelurahan data based on selected kabupaten
            $.ajax({
                url: '/api/wilayah/villages/' + selectKelurahan,
                type: 'GET',
                success: function (subdistrict) {
                    console.log(subdistrict);
                    const response = subdistrict.data;
                    console.log("Kelurahan Data:", response); // debug data
                    $('#kelurahan').empty();
                    $('#kelurahan').append('<option value="">Pilih Kelurahan</option>');
                    $.each(response, function (index, item) {
                        $('#kelurahan').append('<option data-code="' + item.code + '" value="' + item.name + '">' + item.name + '</option>');
                    }); 
                }
            });
        } else {
            $('#kelurahan-container').hide();
        }
    });
});