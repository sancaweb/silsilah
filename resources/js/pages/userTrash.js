const { get } = require("jquery");

jQuery(document).ready(function ($) {

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"').attr("content")
        }
    });

    var columnsTable = [
        { data: "no" },
        { data: "foto" },
        { data: "name" },
        { data: "email" },
        { data: "username" },
        { data: "role" },
        { data: "action" },
    ];

    var tableUserTrash = $("#table-userTrash").DataTable({
        // "searching": false,
        order: [
            [0, 'DESC']
        ],
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + "/user/datatabletrash",
            dataType: "json",
            type: "POST",
            // data: function (dataFilter) {
            //     var columnsFilter = $('#columnsFilter').val();
            //     var filterVal = $('#filterVal').val();
            //     var jenis_data = $('#jenis_data').val();

            //     dataFilter.columnsFilter = columnsFilter;
            //     dataFilter.filterVal = filterVal;
            //     dataFilter.jenis_data = jenis_data;
            // }
        },

        columns: columnsTable,
        columnDefs: [{
            orderable: false,
            targets: [0, 1, -1]
        }]
    });
    $("#table-userTrash_filter input").unbind();
    $("#table-userTrash_filter input").bind("keyup", function (e) {
        if (e.keyCode == 13) {
            tableUserTrash.search(this.value).draw();
        }
    });

    function refreshTable() {
        tableUserTrash.search("").draw();
        // tableUserTrash.ajax.reload();
    }

    var btnReloadUser = document.getElementById('btn-userReload');
    if (btnReloadUser) {
        btnReloadUser.addEventListener('click', function () {
            refreshTable();
        });
    }

    /** ./end datatable */

    $('#table-userTrash').on("click", ".btn-restore", function () {
        console.log('restoreaja');
        Swal.fire({
            title: 'Anda yakin?',
            text: "Anda yakin ingin Me-Restore data User ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            allowOutsideClick: false
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    imageUrl: base_url + "/images/loading.gif",
                    imageHeight: 300,
                    showConfirmButton: false,
                    title: "Loading ...",
                    allowOutsideClick: false
                });

                var idUser = $(this).data('id');
                var urlDelete = base_url + '/user/' + idUser + '/restore';
                $.ajax({
                    url: urlDelete,
                    type: "POST",
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        Swal.fire({
                            icon: "success",
                            title: data.meta.message,
                            showConfirmButton: false,
                            timer: 2000,
                            allowOutsideClick: false
                        }).then(function () {
                            refreshTable();
                        });

                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                        var error = jqXHR.responseJSON;
                        Swal.fire({
                            icon: "error",
                            title: error.message,
                            showConfirmButton: false,
                            timer: 2000,
                            allowOutsideClick: false
                        });

                    }
                });

            }
        });
    });
    //./end restore

    $('#table-userTrash').on("click", ".btn-destroy", function () {
        Swal.fire({
            title: 'Anda yakin?',
            text: "Anda yakin ingin menghapus Permanent ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            allowOutsideClick: false
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    imageUrl: base_url + "/images/loading.gif",
                    imageHeight: 300,
                    showConfirmButton: false,
                    title: "Loading ...",
                    allowOutsideClick: false
                });

                var idUser = $(this).data('id');
                var urlDelete = base_url + '/user/' + idUser + '/destroy';
                $.ajax({
                    url: urlDelete,
                    type: "DELETE",
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        Swal.fire({
                            icon: "success",
                            title: data.meta.message,
                            showConfirmButton: false,
                            timer: 2000,
                            allowOutsideClick: false
                        }).then(function () {
                            refreshTable();
                        });

                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                        var error = jqXHR.responseJSON;
                        Swal.fire({
                            icon: "error",
                            title: error.meta.message,
                            showConfirmButton: false,
                            timer: 2000,
                            allowOutsideClick: false
                        });

                    }
                });

            }
        });
    });


    /** ================== BATAS EDITING =================== */





    // $('.select2').select2({
    //     theme: 'bootstrap4'
    // })



    // $('#inputFoto').on("change", function () {
    //     var review = 'imageReview';
    //     var linkFoto = 'linkFoto';
    //     readURL(this, review, linkFoto);
    // });

    // function readURL(input, review, linkFoto) {
    //     if (input.files && input.files[0]) {
    //         var reader = new FileReader();

    //         reader.onload = function (e) {

    //             $('#' + review).attr('src', e.target.result);
    //             $('#' + linkFoto).attr('href', e.target.result);
    //         }

    //         reader.readAsDataURL(input.files[0]); // convert to base64 string
    //     }
    // }


    // $('#openCard').on('click', function () {
    //     openCard();
    // });

    // $('#closeCard').on('click', function () {
    //     closeCard();
    // });
    // $('#formReset').on('click', function () {
    //     formReset();
    // });

    // function closeCard() {
    //     var elementLink = document.getElementById("cardFormUser");
    //     elementLink.classList.add("collapsed-card");

    //     $('.collapse').collapse('hide');

    // }

    // function openCard() {
    //     var elementLink = document.getElementById("cardFormUser");
    //     elementLink.classList.remove("collapsed-card");

    //     $('.collapse').collapse('show');

    // }


    // function formReset() {
    //     $('#formUser')[0].reset();
    //     $("#formUser").attr("action", base_url + "/user");
    //     $('#role').val('');
    //     $('[name="_method"]').remove();
    //     $('#imageReview').attr('src', base_url + '/images/no-image.png');
    //     $("#titleForm").html('<i class="fas fa-user-plus"></i>&nbsp; Add User');
    //     closeCard();
    // }



    // $("#formUser").on("submit", function (e) {
    //     e.preventDefault();
    //     Swal.fire({
    //         imageUrl: base_url + "/images/loading.gif",
    //         imageHeight: 300,
    //         showConfirmButton: false,
    //         title: "Loading ...",
    //         allowOutsideClick: false
    //     });
    //     var formData = new FormData($("#formUser")[0]);
    //     var url = $("#formUser").attr("action");
    //     $.ajax({
    //         url: url,
    //         type: "POST",
    //         data: formData,
    //         contentType: false,
    //         processData: false,
    //         dataType: "JSON",
    //         success: function (data) {
    //             Swal.fire({
    //                 icon: "success",
    //                 title: data.meta.message,
    //                 showConfirmButton: false,
    //                 timer: 2000,
    //                 allowOutsideClick: false
    //             }).then(function () {
    //                 refreshTable();
    //                 formReset();

    //             });
    //         },
    //         error: function (jqXHR, textStatus, errorThrown) {
    //             if (jqXHR.responseJSON.data.errorValidator) {
    //                 var errors = jqXHR.responseJSON.data.errorValidator;
    //                 var message = jqXHR.responseJSON.message;
    //                 var li = '';
    //                 $.each(errors, function (key, value) {

    //                     li += "<li>" + value + "</li>"
    //                 });

    //                 Swal.fire({
    //                     icon: "error",
    //                     title: message,
    //                     html: '<div class="alert alert-danger text-left" role="alert">' +
    //                         '<ul>' + li + '</ul>' +
    //                         '</div>',
    //                     footer: "Pastikan data yang anda masukkan sudah benar!",
    //                     allowOutsideClick: false,
    //                     showConfirmButton: true,
    //                 });

    //             } else {
    //                 var message = jqXHR.responseJSON.meta.message;
    //                 var data = jqXHR.responseJSON.data;

    //                 Swal.fire({
    //                     icon: "error",
    //                     title: message + " <br>Copy error dan hubungi Programmer!",
    //                     html: '<div class="alert alert-danger text-left" role="alert">' +
    //                         '<p>Error Message: <strong>' + message + '</strong></p>' +
    //                         '<p>Error: ' + data.error + '</p>' +
    //                         '</div>',
    //                     allowOutsideClick: false,
    //                     showConfirmButton: true,
    //                 });
    //             }

    //         }
    //     });
    // });

    // /** Proses edit */
    // $('#table-userTrash').on('click', '.btn-edit', function () {
    //     Swal.fire({
    //         imageUrl: base_url + "/images/loading.gif",
    //         imageHeight: 300,
    //         showConfirmButton: false,
    //         title: "Loading ...",
    //         allowOutsideClick: false
    //     });

    //     var idUser = $(this).data("id");
    //     var urlEdit = base_url + '/user/' + idUser + '/edit';

    //     $.ajax({
    //         url: urlEdit,
    //         type: "get",
    //         success: function (x) {
    //             var dataUser = x.data.user;

    //             $("#formUser").attr("action", x.data.action);
    //             $('<input name="_method" value="patch">').attr("type", "hidden").appendTo("#formUser");
    //             $("#titleForm").html('<i class="fas fa-edit"></i>&nbsp; Edit User');

    //             $('#imageReview').attr('src', dataUser.foto);
    //             $('[name="nama"]').val(dataUser.name);
    //             $('[name="username"]').val(dataUser.username);
    //             $('[name="email"]').val(dataUser.email);
    //             $('#role').val(dataUser.role).trigger('change');



    //             openCard();
    //             Swal.close();


    //         },
    //         error: function (jqXHR, textStatus, errorThrown) {
    //             var meta = jqXHR.responseJSON.meta;
    //             var data = jqXHR.responseJSON.data;

    //             Swal.fire({
    //                 icon: "error",
    //                 title: meta.message,
    //                 html: '<div class="alert alert-danger text-left" role="alert">' +
    //                     '<p>' + data.message + '</p>' +
    //                     '</div>',
    //                 allowOutsideClick: false
    //             });
    //         }
    //     });
    // });

    // /** delete user */

    // $('#table-userTrash').on('click', '.btn-delete', function () {
    //     formReset();
    //     Swal.fire({
    //         title: 'Anda yakin?',
    //         text: "Anda yakin ingin menghapus data?",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, delete it!',
    //         allowOutsideClick: false
    //     }).then((result) => {
    //         if (result.value) {
    //             Swal.fire({
    //                 imageUrl: base_url + "/images/loading.gif",
    //                 imageHeight: 300,
    //                 showConfirmButton: false,
    //                 title: "Loading ...",
    //                 allowOutsideClick: false
    //             });

    //             var idUser = $(this).data('id');
    //             var urlDelete = base_url + '/user/' + idUser + '/delete';
    //             $.ajax({
    //                 url: urlDelete,
    //                 type: "DELETE",
    //                 contentType: false,
    //                 processData: false,
    //                 success: function (data) {
    //                     Swal.fire({
    //                         icon: "success",
    //                         title: data.data.message,
    //                         showConfirmButton: false,
    //                         timer: 2000,
    //                         allowOutsideClick: false
    //                     }).then(function () {
    //                         refreshTable();
    //                     });

    //                 },
    //                 error: function (jqXHR, textStatus, errorThrown) {

    //                     var error = jqXHR.responseJSON;
    //                     Swal.fire({
    //                         icon: "error",
    //                         title: error.meta.message,
    //                         showConfirmButton: false,
    //                         timer: 2000,
    //                         allowOutsideClick: false
    //                     });

    //                 }
    //             });

    //         }
    //     });
    // });

}); // ./end document
