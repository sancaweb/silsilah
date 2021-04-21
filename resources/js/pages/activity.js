const { get } = require("jquery");

jQuery(document).ready(function ($) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"').attr("content")
        }
    });

    $('.select2').select2({
        theme: 'bootstrap4'
    })


    var columnsTable = [
        { data: "no" },
        { data: "user" },
        { data: "logName" },
        { data: "description" },
        { data: "created_at" },
        { data: "action" },
    ];

    var tableActivity = $("#table-activity").DataTable({
        "searching": false,
        order: [
            [0, 'DESC']
        ],
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + "/activity/datatable",
            dataType: "json",
            type: "POST",
            data: function (dataFilter) {
                var columnsFilter = $('#columnsFilter').val();
                var filterVal = $('#filterVal').val();
                var jenis_data = $('#jenis_data').val();

                dataFilter.columnsFilter = columnsFilter;
                dataFilter.filterVal = filterVal;
                dataFilter.jenis_data = jenis_data;
            }
        },

        columns: columnsTable,
        columnDefs: [{
            orderable: false,
            targets: [0, 1, -1]
        }]
    });
    $("#table-activity_filter input").unbind();
    $("#table-activity_filter input").bind("keyup", function (e) {
        if (e.keyCode == 13) {
            tableActivity.search(this.value).draw();
        }
    });

    function refreshTable() {
        tableActivity.search("").draw();
        tableActivity.ajax.reload();
    }

    var btnReloadActivity = document.getElementById('btn-activityReload');
    if (btnReloadActivity) {
        btnReloadActivity.addEventListener('click', function () {
            refreshTable();
        });
    }

    /** ./end datatable */

    $('#openCard').on('click', function () {
        openCard();
    });

    $('#closeCard').on('click', function () {
        closeCard();
    });
    $('#formReset').on('click', function () {
        formReset();
    });

    function closeCard() {
        var elementLink = document.getElementById("cardFormUser");
        elementLink.classList.add("collapsed-card");

        $('.collapse').collapse('hide');

    }

    function openCard() {
        var elementLink = document.getElementById("cardFormUser");
        elementLink.classList.remove("collapsed-card");

        $('.collapse').collapse('show');

    }


    function formReset() {
        $('#formUser')[0].reset();
        $("#formUser").attr("action", base_url + "/user");
        $('#role').val('');
        $('[name="_method"]').remove();
        closeCard();
    }





    $('#table-activity').on('click', '.btn-detail', function () {

        Swal.fire({
            imageUrl: base_url + "/images/loading.gif",
            imageHeight: 300,
            showConfirmButton: false,
            title: "Loading ...",
            allowOutsideClick: false
        });

        var idAct = $(this).data('id');
        var urlDetail = base_url + "/activity/" + idAct + "/show";

        $.ajax({
            url: urlDetail,
            type: "get",
            success: function (data) {
                var dataAct = data.data;
                $('#txt_user').val(dataAct.user);
                $('#txt_logName').val(dataAct.log_name);
                $('#txt_desc').val(dataAct.description);
                $('#txt_data').val(dataAct.properties);
                $('#txt_created').val(dataAct.created_at);



                Swal.close();
                $("#detailAct").modal({
                    show: true,
                    backdrop: "static",
                    keyboard: false // to prevent closing with Esc button (if you want this too)
                });
            },
            error: function (XHR) {
                console.log(XHR);
            }

        });
    });

}); // ./end document
