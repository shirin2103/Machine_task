$(document).ready(function() {
    $('.add_Product').addClass('active');
    // $('#menu1').load();

});

$('#a_add_new_product_form').submit(function(e) {
    e.preventDefault();
    var addProductForm = $(this);
    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: addProductForm.attr('action'),
        data: new FormData(this),
        contentType: false,
        processData: false,
        beforeSend:function(){
            $('#hlx_aap_button').button('loading');
        },
        success: function(response){
            if (response.status=='success') {
                $('form#a_add_new_product_form').trigger('reset');
                $('#hlx_aap_button').button('reset');
                $('.chosen-select-deselect').val('').trigger('chosen:updated');
                success_msg("Product Added Successfully");
                $('#a_product_data').DataTable().ajax.reload();
            } else if(response.status=='failure') {
                error_msg(response.error);
                $('#hlx_aap_button').button('reset');
            } else {
                window.location.replace(response['url']);
            }
        }
    });
});


$(document).ready(function(){  
    load_product_data();
});

function load_product_data() {
    var dataTable = $('#a_product_data').DataTable({  
            dom: 'lBfrtip', 
            rowReorder: {
                selector: 'td:nth-child(2)'
            },       
            responsive: true,
           "ajax":{  
                url:frontend_path+'admin/display_product_datatable',  
                type:"POST"  
           }
    });  
}

$(document).on('click', '.a_product_edit', function () {
    var id = $(this).attr("id");
    $.ajax({
        url: frontend_path+'admin/get_product_edit_info',
        method: "POST",//new
        data: {
            id: id
        },
        dataType: "json",
        beforeSend:function(){
            document.getElementById('header_loader').style.visibility = "visible";
        },
        success: function (data) {
            if (data.status=='success') {
                document.getElementById('header_loader').style.visibility = "hidden";
                var info = data.product_info;
                $('#a_edit_product_id').val(info['id']);
                $('#a_edit_product_name').val(info['product_name']);
                $('#a_edit_product_description').val(info['product_desccription']);
                $('#a_edit_product_price').val(info['product_price']);
                $('#old_image').val(info['product_image']);
                var html=''
                if (info['product_image']) {
                   var image = info['product_image'].split(",");
                // con
                 $.each(image, function (key, val) {
                    html += '<img src="' + val + '" class="display-img" style="width="50px; height="50px;">';

                });
                } else {
                    html = '<img src="' + frontend_path + 'assets/image/noimage.png" class="display-img">';
                }
                $('#a_edit_display_product_image').html(html);
                $('#a_edit_product_category').trigger("chosen:updated");
            } else {
                window.location.replace(data['url']);
            }
        }
    });
});

$('#a_update_product_form').submit(function(e) {
    e.preventDefault();
    var updateProductForm = $(this);
    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: updateProductForm.attr('action'),
        data: new FormData(this),
        contentType: false,
        processData: false,
        beforeSend:function(){
            $('#hlx_apupdate_button').button('loading');
        },
        success: function(response){
            if (response.status=='success') {
                $('form#a_update_product_form').trigger('reset');
                $('#hlx_apupdate_button').button('reset');
                $('.chosen-select-deselect').val('').trigger('chosen:updated');
                $('#a_product_edit_modal').modal('hide');
                success_msg("Product Updated Successfully");
                $('#a_product_data').DataTable().ajax.reload();
            } else if(response.status=='failure') {
                error_msg(response.error);
                $('#hlx_apupdate_button').button('reset');
            } else {
                window.location.replace(response['url']);
            }
        }
    });
});


$(document).on('click', '.a_product_view', function () {
    var id = $(this).attr("id");
    $.ajax({
        url: frontend_path+'admin/get_product_edit_info',
        method: "POST",
        data: {
            id: id
        },
        dataType: "json",
        beforeSend:function(){
            document.getElementById('header_loader').style.visibility = "visible";
        },
        success: function (data) {
            if (data.status=='success') {
                document.getElementById('header_loader').style.visibility = "hidden";
                var info = data.product_info;
                $('#a_view_product_name').text(info['product_name']);
                $('#a_view_product_description').text(info['product_desccription']);
                $('#a_view_product_price').text(info['product_price']);
                var html=''
                if (info['product_image']) {
                var image = info['product_image'].split(",");
                // con
                 $.each(image, function (key, val) {
                    html += '<img src="' + val + '" class="display-img" style="width="50px; height="50px;">';

                });

                } else {
                    html = '<img src="' + frontend_path + 'assets/image/noimage.png" class="display-img">';
                }
                $('#a_view_display_product_image').html(html);
            } else {
                window.location.replace(response['url']);
            }
        }
    });
});

$(document).on('click', '.a_product_delete', function (e) {
    var id = $(this).attr('id');
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: !0,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        confirmButtonClass: "btn btn-success mt-2",
        cancelButtonClass: "btn btn-danger ml-2 mt-2",
        buttonsStyling: !1
    }).then(function (t) {
        if (t.value) {
            $.ajax({
                type: "POST",
                url: frontend_path+'admin/delete_product',
                data: {
                    'id': id
                },
                dataType: 'json',
                cache: false,
                success: function (result) {
                    if (result['status'] == 'success') {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your data has been deleted.",
                            type: "success"
                        });
                        $('#a_product_data').DataTable().ajax.reload(null, false);
                    } else if (result['status'] == 'login_failure') {
                        window.location.replace(response['url']);
                    }
                }
            });
        } else {
            Swal.fire({
                title: "Cancelled",
                text: "Your data is safe :)",
                type: "error"
            })
        }
    })
});