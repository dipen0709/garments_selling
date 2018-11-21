$(document).ready(function () {
//        $('#birthdate').datetimepicker({
//            formainsert-order-formt: 'YYYY-MM-DD',
//            viewMode: 'years',
//            maxDate: moment(),
//            widgetPositioning: {
//                horizontal: 'left'
//            }
//        });
$('.add_cloth').click(function (e) {
    $('#add_cloth').modal('show');
    return false;
});

$('.insert-cloth').click(function (e) {    
    var cloth_name = $('#cloth_name').val();
    if (!cloth_name) {
        $.toast({
            heading: langauge_var.common_error_header,
            showHideTransition: 'slide',
            text: 'Please enter cloth type.',
            icon: 'error'
        });
    } else {
        var _token = $("#_token").val();
        $.ajax({
            type: "post",
            url: base_url + "add-cloth",
            data: {'_token': _token, 'cloth_name': cloth_name},
            dataType: "json",
            success: function (data) {
                if (data.flag) {
                    if (data.count) {
                        var c_data = data.cloth;
                        var opt = '<option value="">Select Cloth / Kapad</option>';
                        for (var a = 0; a < c_data.length; a++) {
                            opt += '<option value="' + c_data[a].id + '">' + c_data[a].name + '</option>';
                        }
                        $('#cloth_id').html(opt);
                    }

                    $.toast({
                        heading: langauge_var.common_error_header,
                        showHideTransition: 'slide',
                        text: data.msg,
                        icon: 'success'
                    });
                    $('#add_cloth').modal('hide');

                } else {
                    $.toast({
                        heading: langauge_var.common_error_header,
                        showHideTransition: 'slide',
                        text: data.msg,
                        icon: 'error'
                    });
                }
            }
        });
    }

});

    $('#customers').validate({
        rules: {
            name: {required: true},
            email: {required: true, email: true},
            password: {
                required: true,
                minlength: 8,
                PASSWORD: true},
            confirmpassword: {equalTo: '#password'},
            mobile: {number: true, maxlength: 10, phoneUSCustom: true}
        },
        messages: {
            name: {required: langauge_var.common_name},
            email: {required: langauge_var.login_email, email: langauge_var.login_valid_email},
            password: {required: langauge_var.common_password, minlength: langauge_var.common_password_len8},
            confirmpassword: {required: langauge_var.common_confirm_password, equalTo: langauge_var.common_password_match},
            mobile: {number: langauge_var.valid_mobile_number, maxlength: langauge_var.mobile_length}
        },
        showErrors: function (errorMap, errorList) {
            var error = [];
            $.each(errorMap, function (key, value) {
                error.push(value);
            });
            if (error.length != 0) {
                $.toast({
                    heading: langauge_var.common_error_header,
                    text: error,
                    icon: 'error',
                    hideAfter: 5000,
                    position: 'toast-bottom-right'
                });
            }
        },
        onkeyup: false,
        focusInvalid: false
    });
       
    $('#resetpassword').validate({
        rules: {
            password: {
                required: {required: true},
                minlength: 8,
                PASSWORD: true},
            confirmpassword: {required: true,  equalTo: '#password'}
        },
        messages: {
            password: {required: langauge_var.common_password, minlength: langauge_var.common_password_len8},
            confirmpassword: {required: langauge_var.common_confirm_password, equalTo: langauge_var.common_password_match}
        },
        showErrors: function (errorMap, errorList) {
            var error = [];
            $.each(errorMap, function (key, value) {
                error.push(value);
            });
            if (error.length != 0) {
                $.toast({
                    heading: langauge_var.common_error_header,
                    text: error,
                    icon: 'error',
                    hideAfter: 5000,
                    position: 'toast-bottom-right'
                });
            }
        },
        onkeyup: false,
        focusInvalid: false
    });
    $('#size_with_price').validate({
        rules: {
            serial_name: {required: true},
            mobile: {number: true, maxlength: 10, phoneUSCustom: true}
        },
        messages: {
            serial_name: {required: langauge_var.common_serial_name},
            mobile: {number: langauge_var.valid_mobile_number, maxlength: langauge_var.mobile_length}
        },
        showErrors: function (errorMap, errorList) {
            var error = [];
            $.each(errorMap, function (key, value) {
                error.push(value);
            });
            if (error.length != 0) {
                $.toast({
                    heading: langauge_var.common_error_header,
                    text: error,
                    icon: 'error',
                    hideAfter: 5000,
                    position: 'toast-bottom-right'
                });
            }
        },
        submitHandler: function (form) {
            var size = $('#size_1').val();
            var price = $('#price_1').val();
            var kapad_id = $('#kapad_id_1_1').val();
            var use_kapad = $('#use_kapad_1_1').val();
            if (size == '') {
                $.toast({
                    heading: langauge_var.common_error_header,
                    text: langauge_var.common_size_name,
                    icon: 'error',
                    hideAfter: 5000,
                    position: 'toast-bottom-right'
                });
                return false;
            }
            if (price == '') {
                $.toast({
                    heading: langauge_var.common_error_header,
                    text: langauge_var.common_price_name,
                    icon: 'error',
                    hideAfter: 5000,
                    position: 'toast-bottom-right'
                });
                return false;
            }
            if (kapad_id == '' || kapad_id == undefined) {
                $.toast({
                    heading: langauge_var.common_error_header,
                    text: 'Please select kapad.',
                    icon: 'error',
                    hideAfter: 5000,
                    position: 'toast-bottom-right'
                });
                if (kapad_id == undefined) {
                    $('.add_average').trigger('click');
                }
                return false;
            }
            if (use_kapad == '' || use_kapad == undefined) {
                $.toast({
                    heading: langauge_var.common_error_header,
                    text: langauge_var.common_use_cloth_name,
                    icon: 'error',
                    hideAfter: 5000,
                    position: 'toast-bottom-right'
                });
                return false;
            }
            form.submit();
        },
        onkeyup: false,
        focusInvalid: false
    });
    
    $('.add_sizewithprice').click(function (e) {
    var oldCount = $("#addDetails").val();
    var newCount = parseInt(oldCount) + 1;
    var html = $('.sizewithprice_html').html();
    var new_html = html.replace(/\xxxx/g, newCount);
    var new_html = new_html.replace(/\_yyyy/g, '');
    $('.sizewithprice_append').append(new_html);
    $("#addDetails").val(newCount);
    return false;
});

$(document).on('click', '.add_average', function (e) {
    var x = $(this).data('id');
    var total_avg = $('#total_avg_' + x).val();
    var new_avg = parseInt(total_avg) + 1;
    var html = $('.average_hidden_html').html();
    var new_html = html.replace(/\xxxx/g, x);
    var new_html = new_html.replace(/\yyyy/g, new_avg);
    $('.sub_row_' + x).append(new_html);
    $('#total_avg_' + x).val(new_avg);
    return false;
});


    
    $(document).on('change', '.form-control-file', function (e) {
        var val = $(this).val();
        var file_size = this.files[0].size;
        var default_upload_size = 5 * 1000 * 1000;//10MB size
        var ext = val.substring(val.lastIndexOf('.') + 1).toLowerCase();

        switch (ext) {
            case 'gif':
            case 'jpg':
            case 'png':
            case 'jpeg' :

                $(this).parent().removeClass('has-error');
                break;
            default:
                $.toast({
                    heading: langauge_var.common_error_header,
                    text: langauge_var.common_invalid_file_format,
                    icon: 'error'
                });
                $(this).val('');
                $(this).filestyle('clear');
                break;
        }
        //to validate the image size
        if (file_size > default_upload_size) {
            $.toast({
                heading: langauge_var.common_error_header,
                text: langauge_var.common_file_size_5mb,
                icon: 'error'
            });
            $(this).val('');
            $(this).filestyle('clear');
        }
    });
});

$('.datepicker').datepicker();
$('.category_description').click(function (e) {
    var id = $(this).data('id');
    $('#category_description_'+id).modal('show');
    return false;
});
$('.price_validate').keypress(function (event) {
    if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
    if (($(this).val().indexOf('.') != -1) && ($(this).val().substring($(this).val().indexOf('.'), $(this).val().indexOf('.').length).length > 2)) {
        event.preventDefault();
    }
});
    
    function deleteconfirm(str){
    if(confirm(str)){
        return true;
    }
    return false;
}