var base_url = $('#mainurl').val();
var appointment_chart = "";
var earning_chart = "";


function chartMachineProd(canvas,objectif,progress,labels){
    let reste = objectif - progress;
    const data = {
        labels: labels?['Progress', 'Remaining']:[],
        datasets: [
            {
                data: [progress, reste],
                backgroundColor: ['#72e484','#dfe7e0']
            }
        ]
    };
    const config = {
        type: 'doughnut',
        data: data,
        options: {
            responsive: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Progress'
                }
            }
        },
    };

    const myChart = new Chart(
        document.getElementById(canvas),
        config
    );
}

function change_production(id) {
    $.ajax({
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: base_url + '/operation/change_production',
        data:
        {
            id: id,
        },
        success: function (result) {
            location.reload();
            //console.log(result);
            iziToast.success({
                message: 'Change production successfully..!!',
                position: 'topRight',
            })
        },
        error: function (err) {
            //console.log(err);
        }
    });
}


$(document).ready(function ()
{
    // if (window.location.origin + window.location.pathname == $('#mainurl').val() + '/operation')
    // {
    //     chartMachineProd('progressChart',10000,5410,true);
    // }

    // if (window.location.origin + window.location.pathname == $('#mainurl').val() + '/home')
    // {
    //     chartMachineProd(
    //         'progressChart1',
    //         12000,
    //         5410,
    //         false
    //     );
    //     chartMachineProd(
    //         'progressChart3',
    //         20000,
    //         14000,
    //         false
    //     );
    //     chartMachineProd(
    //         'progressChart4',
    //         50000,
    //         14000,
    //         false
    //     );
    // }

    $(document).on('mouseover','.main-sidebar', function () {
        $(this).getNiceScroll().resize();
    });

    datatable();
    $(function () {
        $(".loader").fadeOut(1000, function () {
            $(".for-loader").fadeIn(400);
        });
    });

    $('.select2').select2({
        width: '100%',
        height: '100%',
    });

    $('.show_vendor_model_select2').select2(
        {
            width: '100%',
            height: '100%',
            dropdownParent: $('#insert_modal')
    });

    $('.privacy_policy').summernote({
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });

    $("#start").timepicker({
        icons: {
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down'
        }
    });

    $('input[name="date_range"]').daterangepicker(
        {
            opens: 'left',
            locale:
            {
                format: 'YYYY-MM-DD'
            },
        }, function (start, end, label) {
            $('#start_Period').val(start.format('YYYY-MM-DD'));
            $('#end_Period').val(end.format('YYYY-MM-DD'));
    });

    $('input[name="filter_date_range"]').daterangepicker(
    {
        opens: 'left',
        minDate: today,
        locale:
        {
            format: 'YYYY-MM-DD'
        },
    },
    function (start, end, label)
    {
        $.ajax(
        {
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: base_url + '/admin/orderChart',
            data:
            {
                start_date: start.format('YYYY-MM-DD'),
                end_date: end.format('YYYY-MM-DD'),
            },
            success: function (result)
            {
                appointment_chart.data.labels = [];
                appointment_chart.data.datasets = [];
                appointment_chart.update();
                orderChart(result);
                return true;
            },
            error: function (err) {
                console.log('err ', err)
            }
        });
        $.ajax(
        {
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            data:
            {
                start_date: start.format('YYYY-MM-DD'),
                end_date: end.format('YYYY-MM-DD'),
            },
            url: base_url + '/admin/earningChart',
            success: function (result)
            {
                earning_chart.data.labels = [];
                earning_chart.data.datasets = [];
                earning_chart.update();
                earningChart(result);
            },
            error: function (err) {
                console.log('err ', err)
            }
        });
    });

    if (window.location.origin + window.location.pathname == $('#mainurl').val() + '/admin/home')
    {
        $.ajax(
        {
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: base_url + '/admin/orderChart',
            success: function (result) {
                $(".main-sidebar").getNiceScroll().resize();
                orderChart(result);
            },
            error: function (err) {
                console.log('err ', err)
            }
        });

        $.ajax(
        {
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: base_url + '/admin/earningChart',
            success: function (result) {
                console.log('result', result);
                $(".main-sidebar").getNiceScroll().resize();
                earningChart(result);
            },
            error: function (err) {
                console.log('err ', err)
            }
        });

        $.ajax(
        {
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: base_url + '/admin/topItems',
            success: function (result) {
                console.log('result', result);
                // ItemsChart(result);
            },
            error: function (err) {
                console.log('err ', err)
            }
        });

        $.ajax(
        {
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: base_url + '/admin/avarageItems',
            success: function (result)
            {
                $(".main-sidebar").getNiceScroll().resize();
                avarageAdminItems(result);
            },
            error: function (err) {
                console.log('err ', err)
            }
        });
    }

    if (window.location.origin + window.location.pathname == $('#mainurl').val() + '/vendor/vendor_home') {
        $.ajax(
        {
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: base_url + '/vendor/revenueChart',
            success: function (result) {
                console.log('result', result);
                revenueChart(result);
            },
            error: function (err) {
                console.log('err ', err)
            }
        });

        $.ajax(
        {
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: base_url + '/vendor/orderChart',
            success: function (result) {
                console.log('result', result);
                vendor_userChart(result);
            },
            error: function (err) {
                console.log('err ', err)
            }
        });

        $.ajax(
        {
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: base_url + '/vendor/vendorAvarageTime',
            success: function (result)
            {
                avarageVendorItems(result);
            },
            error: function (err) {
                console.log('err ', err)
            }
        });
    }

    $('#master').on('click', function(e) {
        if($(this).is(':checked',true))
        {
            $(".sub_chk").prop('checked', true);
        }
        else
        {
            $(".sub_chk").prop('checked',false);
        }
    });

    $('.custom-file-input').on('change',function(e)
    {
        var fileName = e.target.files[0].name;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
            $(this).next('.custom-file-label').html(fileName);
        }else{
            $('input[type=file]').val('');
            alert("Only jpg/jpeg and png files are allowed!");
        }
    })

    $('input[type=number]').bind('keypress', function(evt)
    {
        // if(evt.keyCode === 8 || evt.keyCode === 46 ? true : !isNaN(Number(evt.key)))
        if(evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
    });

    var today = new Date();

    var date = new Date();
    currentDate = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();

    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0' + minutes : minutes;
    var strTime = hours + ':' + minutes + '-' + ampm;
    $('.hidden_dateTime').val(currentDate + ' ' + strTime);

    $('#cp1').colorpicker();

    $(".flatpickr").flatpickr(
    {
        minDate: "today",
        enableTime: true,
        dateFormat: "Y-m-d h:i-K",
        minTime: strTime,
        defaultDate: currentDate + ' ' + strTime,
    });

    $(".flatpickr").change(function () {
        $('.hidden_dateTime').val(this.value);
    });

    $('.textarea_editor').summernote({
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });

    $('.textarea_editor_term').summernote({
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });

    $(function () {
        $('input[name="start_end_date"]').daterangepicker({
            opens: 'left',
            minDate: today,
            locale:
            {
                format: 'YYYY-MM-DD'
            },
        }, function (start, end, label) {
            $('#start_Period').val(start.format('YYYY-MM-DD'));
            $('#end_Period').val(end.format('YYYY-MM-DD'));
        });

        $('input[name="update_start_end_date"]').daterangepicker({
            opens: 'left',
            locale:
            {
                format: 'YYYY-MM-DD'
            },
        }, function (start, end, label) {
            $('#start_Period').val(start.format('YYYY-MM-DD'));
            $('#end_Period').val(end.format('YYYY-MM-DD'));
        });
    });

    var start_time = $('#start_time').val();
    var end_time = $('#end_time').val();
    var timeslot = $('#timeslot').val();

    $('.timeslots').timepicker({
        timeFormat: 'h:mm p',
        interval: timeslot,
        dynamic: false,
        dropdown: true,
        scrollbar: true,
        minTime: start_time,
        maxTime: end_time,
    });

    $('input[name=qty_reset]').change(function () {
        if (this.value == 'daily') {
            $('input[name=item_reset_value]').prop("disabled", false);
        }
        else {
            $('input[name=item_reset_value]').prop("disabled", true);
        }
    });

    $('select[name=submenu_filter]').change(function ()
    {
        var menu_id = $('input[name=menu_id]').val();
        var vendor_id = $('input[name=vendor_id]').val();
        $.ajax({
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            data:
            {
                filter:this.value,
                menu_id:menu_id,
                vendor_id:vendor_id
            },
            url: base_url + '/vendor/vendor_menu/'+menu_id,
            success: function (result)
            {
                $('.display_submenu').html('');
                $('.display_submenu').append(result.html);
                datatable();
            },
            error: function (err) {
            }
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var type = $('#previewImage').attr('data-id');
                var fileName = document.getElementById("previewImage").value;
                var idxDot = fileName.lastIndexOf(".") + 1;
                var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
                if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
                    $('.logoContainer #image').attr('src', e.target.result);
                }else{
                    $('input[type=file]').val('');
                    alert("Only jpg/jpeg and png files are allowed!");
                    if(type == 'add'){
                        $('#image').attr('src', base_url+'/images/upload/impageplaceholder.png');
                    }
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#previewImage").change(function () {
        readURL(this);
    });

    function readNatImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var fileName = document.getElementById("previewnational_identity").value;
                var idxDot = fileName.lastIndexOf(".") + 1;
                var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
                if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
                    $('.logoContainer #national_identity').attr('src', e.target.result);
                }else{
                    $('input[type=file]').val('');
                    alert("Only jpg/jpeg and png files are allowed!");
                    $('#image').attr('src', base_url+'/images/upload/impageplaceholder.png');
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#previewnational_identity").change(function () {
        readNatImg(this);
    });

    function readLicnDoc(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var fileName = document.getElementById("previewlicence_doc").value;
                var idxDot = fileName.lastIndexOf(".") + 1;
                var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
                if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
                    $('.logoContainer #licence_doc').attr('src', e.target.result);
                }else{
                    $('input[type=file]').val('');
                    alert("Only jpg/jpeg and png files are allowed!");
                    $('#image').attr('src', base_url+'/images/upload/impageplaceholder.png');
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#previewlicence_doc").change(function () {
        readLicnDoc(this);
    });

    $('input[type=checkbox][name=verification_email]').change(function () {
        $('.setting_alert').hide();
        var user_verification = $('input[type=checkbox][name=verification]').is(":checked");
        var mail_verification = $('input[type=checkbox][name=verification_phone]').is(":checked");
        if (user_verification == true) {
            if (this.checked == false && mail_verification == false) {
                $('.setting_alert').show();
            }
        }
    });

    $('input[type=checkbox][name=verification_phone]').change(function () {
        $('.setting_alert').hide();
        var user_verification = $('input[type=checkbox][name=verification]').is(":checked");
        var mail_verification = $('input[type=checkbox][name=verification_email]').is(":checked");
        if (user_verification == true) {
            if (this.checked == false && mail_verification == false) {
                $('.setting_alert').show();
            }
        }
    });

    $('input[type=checkbox][name=business_availability]').change(function () {
        if (this.checked == false) {
            $('.business_avai_msg').show();
        }
        else {
            $('.business_avai_msg').hide();
        }
    });

    $('input[type=checkbox][name=isAcceptMultiple]').change(function () {
        if (this.checked == true) {
            $('.txtaccept_multiple').show();
        }
        else {
            $('.txtaccept_multiple').hide();
        }
    });

    $('select[name=delivery_type]').change(function () {
        if (this.value == 'home') {
            $('.lblUser').show();
            $('.divUser').show();
        }
        else {
            $('.lblUser').hide();
            $('.divUser').hide();
        }
    });


    $('input[type=checkbox][name=customer_notification]').change(function () {
        if (this.checked == true) {
            $('.customer_notification_card').show();
        }
        else {
            $('.customer_notification_card').hide();
            $.ajax({
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data:
                {
                    customer_notification:0
                },
                url: base_url + '/admin/update_noti',
                success: function (result)
                {
                    if (result.success == true)
                    {
                        location.reload();
                    }
                },
                error: function (err) {
                }
            });
        }
    });

    $('input[type=checkbox][name=vendor_notification]').change(function () {
        if (this.checked == true) {
            $('.vendor_notification_card').show();
        }
        else {
            $('.vendor_notification_card').hide();
            $.ajax({
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data:
                {
                    vendor_notification:0
                },
                url: base_url + '/admin/update_noti',
                success: function (result)
                {
                    if (result.success == true)
                    {
                        location.reload();
                    }
                },
                error: function (err) {
                }
            });
        }
    });

    $('input[type=checkbox][name=driver_notification]').change(function () {
        if (this.checked == true) {
            $('.driver_notification_card').show();
        }
        else
        {
            $('.driver_notification_card').hide();
            $.ajax({
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data:
                {
                    driver_notification:0
                },
                url: base_url + '/admin/update_noti',
                success: function (result)
                {
                    if (result.success == true)
                    {
                        location.reload();
                    }
                },
                error: function (err) {
                }
            });
        }
    });

    $('input[type=checkbox][name=stripe]').change(function () {
        if (this.checked == true) {
            $('.stripe_card').show();
        }
        else {
            $('.stripe_card').hide();
            $.ajax({
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data:
                {
                    stripe:0
                },
                url: base_url + '/admin/update_status',
                success: function (result)
                {
                    if (result.success == true)
                    {
                        location.reload();
                    }
                },
                error: function (err) {
                }
            });
        }
    });

    $('input[type=checkbox][name=COD]').change(function () {
        if (this.checked == true)
        {
            $.ajax({
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data:
                {
                    cod:1
                },
                url: base_url + '/admin/update_status',
                success: function (result)
                {
                    if (result.success == true)
                    {
                        location.reload();
                    }
                },
                error: function (err) {
                }
            });
        }
        else
        {
            $.ajax({
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data:
                {
                    cod:0
                },
                url: base_url + '/admin/update_status',
                success: function (result)
                {
                    if (result.success == true)
                    {
                        location.reload();
                    }
                },
                error: function (err) {
                }
            });
        }
    });

    $('input[type=checkbox][name=wallet]').change(function () {
        if (this.checked == true)
        {
            $.ajax({
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data:
                {
                    wallet:1
                },
                url: base_url + '/admin/update_status',
                success: function (result)
                {
                    if (result.success == true)
                    {
                        location.reload();
                    }
                },
                error: function (err) {
                }
            });
        }
        else
        {
            $.ajax({
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data:
                {
                    wallet:0
                },
                url: base_url + '/admin/update_status',
                success: function (result)
                {
                    if (result.success == true)
                    {
                        location.reload();
                    }
                },
                error: function (err) {
                }
            });
        }
    });

    $('input[type=checkbox][name=paypal]').change(function () {
        if (this.checked == true) {
            $('.paypal_card').show();
        }
        else {
            $('.paypal_card').hide();
            $.ajax(
            {
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data:
                {
                    paypal:0
                },
                url: base_url + '/admin/update_status',
                success: function (result)
                {
                    if (result.success == true)
                    {
                        location.reload();
                    }
                },
                error: function (err) {
                }
            });
        }
    });

    $('input[type=checkbox][name=razorpay]').change(function () {
        if (this.checked == true) {
            $('.razorpay_card').show();
        }
        else {
            $('.razorpay_card').hide();
            $.ajax({
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data:
                {
                    razorpay:0
                },
                url: base_url + '/admin/update_status',
                success: function (result)
                {
                    if (result.success == true)
                    {
                        location.reload();
                    }
                },
                error: function (err) {
                }
            });
        }
    });

    $('input[type=checkbox][name=flutterwave]').change(function () {
        if (this.checked == true) {
            $('.flutterwave_card').show();
        }
        else {
            $('.flutterwave_card').hide();
            $.ajax({
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data:
                {
                    flutterwave:0
                },
                url: base_url + '/admin/update_status',
                success: function (result)
                {
                    if (result.success == true)
                    {
                        location.reload();
                    }
                },
                error: function (err) {
                }
            });
        }
    });

    $('input[type=checkbox][name=isFlat]').change(function () {
        var checked = $('input[type=checkbox][name=isFlat]').is(":checked");
        if (checked == true) {
            $('.discountType').hide();
            $('.max_disc_amount').hide();
            $('.flatDiscount').show();
        }
        else {
            $('.discountType').show();
            $('.max_disc_amount').show();
            $('.flatDiscount').hide();
        }
    });

    $('input[type=checkbox][name=isItemTax]').change(function () {
        var checked = this.checked;
        if (checked == true) {
            $('.txtItemTax').hide();
        }
        else {
            $('.txtItemTax').show();
        }
    });

    $('select[name=delivery_charge_type]').change(function () {
        if (this.value == 'order_amount') {
            $('.order_charge_table').show();
            $('.delivery_charge_table').hide();
        }
        if (this.value == 'delivery_distance') {
            $('.order_charge_table').hide();
            $('.delivery_charge_table').show();
        }
    });

    var table_length = $('.custimization_table').length;

    for (let i = 1; i <= table_length; i++) {
        $('#chkbox' + i).change(function () {
            console.log(this.checked);
        });
    }

    $('input[type=checkbox][name=delivery_type]').change(function () {
        if (this.checked == true) {
            $('.user_address_btn').show();
        }
        else {
            $('.user_address_btn').hide();
        }
    });

    $('input[type=checkbox][name=is_driver_accept_multipleorder]').change(function () {
        if (this.checked == true) {
            $('.driver_accept_multi_order').show();
        }
        else {
            $('.driver_accept_multi_order').hide();
        }
    });

    $('input[type=checkbox][name=delivery_at]').change(function () {
        if (this.checked == true) {
            $('#staticBackdrop').modal();
            $('#staticBackdrop').addClass('show');
        }
        else {
            $('#staticBackdrop').hide();
        }
    });

    $(document).on('click', 'button.removebtn', function () {
        $(this).closest('tr').remove();
        return false;
    });
});

function datatable() {
    // Variables
    var $dtBasic = $('#datatable');

    // Methods
    function init($this)
    {
        var options =
        {
            select: {
                style: "multi"
            },
            language: {
                paginate: {
                    previous: "<i class='fas fa-angle-left'>",
                    next: "<i class='fas fa-angle-right'>"
                },
            },
            order: [[ 1, "asc" ]],
            columnDefs: [{
                targets: [0],
                orderable: false
            }]
        };

        // Init the datatable

        var table = $this.on('init.dt', function () {
            $('div.dataTables_length select').removeClass('custom-select custom-select-sm');

        }).DataTable(options);
    }

    // Events

    if ($dtBasic.length) {
        init($dtBasic);
    }
}

function orderChart(data)
{
    // if (appointment_chart) {
    //     appointment_chart.clear()
    // }
    var color = getComputedStyle(document.documentElement).getPropertyValue('--site_color');
    appointment_chart = new Chart(document.getElementById("orderChart").getContext('2d'),
        {
            type: 'line',
            data: {
                labels: data.label,
                datasets: [{
                    label: 'Orders',
                    data: data.data,
                    borderColor: 'black',
                    backgroundColor: 'transparent',
                    pointBackgroundColor: color,
                    pointBorderColor: 'black',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                    }],
                    xAxes: [{
                        gridLines: {
                            color: '#fbfbfb',
                            lineWidth: 2
                        }
                    }]
                },
            }
    });
}

function earningChart(data)
{
    // if (earning_chart) {
    //     earning_chart.clear()
    // }
    var color = getComputedStyle(document.documentElement).getPropertyValue('--site_color');
    earning_chart = new Chart(document.getElementById("earningChart"),
    {
        type: 'line',
        data:
        {
            labels: data.label,
            datasets: [{
                label: 'Earnings',
                data: data.data,
                // borderWidth: 5,
                borderColor: 'black',
                backgroundColor: 'transparent',
                pointBackgroundColor: color,
                pointBorderColor: 'black',
                pointRadius: 4
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false,
                    },
                }],
                xAxes: [{
                    gridLines: {
                        color: '#fbfbfb',
                        lineWidth: 2
                    }
                }]
            },
        }
    });
}

function vendor_userChart(data) {
    var user_chart = document.getElementById("userChart");
    var color = getComputedStyle(document.documentElement).getPropertyValue('--site_color');

    var myChart = new Chart(user_chart,
        {
            type: 'line',
            data:
            {
                labels: data.label,
                datasets: [{
                    label: 'orders',
                    data: data.data,
                    // data: [10,20,35,40,58,62,77,80,90,100],
                    borderWidth: 1,
                    borderColor: 'black',
                    backgroundColor: 'transparent',
                    pointBackgroundColor: color,
                    pointBorderColor: 'black',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                    }],
                    xAxes: [{
                        gridLines: {
                            color: '#fbfbfb',
                            lineWidth: 1
                        }
                    }]
                },
            }
        });
}

function revenueChart(data) {
    var revenueChart = document.getElementById("revenueChart");
    var color = getComputedStyle(document.documentElement).getPropertyValue('--site_color');

    var myChart = new Chart(revenueChart,
        {
            type: 'line',
            data:
            {
                labels: data.label,
                datasets: [{
                    label: 'orders',
                    data: data.data,
                    // data: [10,20,35,40,58,62,77,80,90,100],
                    borderWidth: 1,
                    borderColor: 'black',
                    backgroundColor: 'transparent',
                    pointBackgroundColor: color,
                    pointBorderColor: 'black',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                    }],
                    xAxes: [{
                        gridLines: {
                            color: '#fbfbfb',
                            lineWidth: 1
                        }
                    }]
                },
            }
    });
}

function avarageAdminItems(data)
{
    var ctx = document.getElementById("avarageTime").getContext("2d");
    var site_color = getComputedStyle(document.documentElement).getPropertyValue('--site_color');
    var hover_color = getComputedStyle(document.documentElement).getPropertyValue('--hover_color');
    var myChart = new Chart(ctx,
    {
        type: 'line',
        data:
        {
            labels: data.label,
            datasets: [
                {
                    label: 'current month avarage time',
                    data: data.currentMonth,
                    // data: [0,0,0,0,0,0,0,0,0,0],
                    // borderWidth: 1,
                    borderWidth: 2,
                    backgroundColor: 'transparent',
                    borderColor: site_color,
                    borderWidth: 2.5,
                    pointBackgroundColor: 'transparent',
                    pointBorderColor: 'transparent',
                    pointRadius: 4
                },
                {
                    label: 'last month avarage time',
                    data: data.lastMonth,
                    // borderWidth: 1,
                    borderWidth: 2,
                    backgroundColor: 'transparent',
                    borderColor: 'black',
                    borderWidth: 0,
                    pointBackgroundColor: 'transparent',
                    pointBorderColor: 'transparent',
                    pointRadius: 4
                }
            ],
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false,
                    },
                }],
                xAxes: [{
                    gridLines: {
                        color: '#fbfbfb',
                        lineWidth: 1
                    }
                }]
            },
        }
    });
}

function avarageVendorItems(data)
{
var ctx = document.getElementById("vendorAvarageTime").getContext('2d');
    var myChart = new Chart(ctx,
    {
        type: 'doughnut',
        // data:
        // {
        //     datasets: [
        //         // {
        //         //     data: [12],
        //         //     data: data.currentMonthAvarageTime,
        //         //     backgroundColor: '#55D8FE',
        //         // },
        //         // {
        //         //     data: [56],
        //         //     // data: data.currentMonthAvarageTime,
        //         //     backgroundColor: '#FF8373',
        //         // },
        //     ],
        // },
        data: {
            datasets: [{
              data: [
                data.currentMonth,
                data.lastMonth,
                // 89,56
              ],
              backgroundColor: [
                '#55D8FE',
                '#FF8373',
              ],
              label: 'Dataset 1'
            }],
            labels: [
              'current month avarage delivery time',
              'last month avarage delivery time',
            ],
          },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            },
        }
    });
}

function ItemsChart(data) {
    var item = [];
    var count = [];
    for (let i = 0; i < data.items.length; i++) {
        item.push(data.items[i].itemName);
        count.push(data.items[i].total);
    }
    // console.log(item);
    var ctx = document.getElementById("topItems").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [
            {
                data: count,
                backgroundColor: [
                    '#55D8FE',
                    '#FF8373',
                    '#FFDA83',
                    '#A3A0FB',
                ],
                label: 'Dataset 1'
            }],
            labels: item,
        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            },
        }
    });
}

function VendororderChart(data) {
    color = [];
    for (let i = 0; i < 7; i++) {
        color.push('rgb(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ')');
    }
    var appointment_chart = document.getElementById("myChart").getContext('2d');

    var myChart = new Chart(appointment_chart, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    // data.data.pending_order,
                    // data.data.accept,
                    // data.data.reject,
                    // data.data.pickup,
                    // data.data.delivered,
                    // data.data.cancel,
                    // data.data.complete
                    34,
                    56,
                    67,
                    23,
                    45,
                    11,
                    16
                ],
                backgroundColor: color,
                label: 'Dataset 1'
            }],
            labels: [
                'pending order',
                'Accept',
                'Reject',
                'pickup',
                'delivered',
                'Cancel',
                'complete'
            ],
        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            },
        }
    });
    // var user_chart = document.getElementById("userChart").getContext('2d');

    // var myChart = new Chart(user_chart,
    // {
    //     type: 'bar',
    //     data:
    //     {
    //         labels: data.label,
    //         datasets: [{
    //             label: 'Users',
    //             data: data.data,
    //             borderWidth: 5,
    //             borderColor: '#6777ef',
    //             backgroundColor: '#6777ef',
    //             // backgroundColor: 'transparent',
    //             pointBackgroundColor: '#fff',
    //             pointBorderColor: '#6777ef',
    //             pointRadius: 4
    //         }]
    //     },
    //     options: {
    //         legend: {
    //             display: true
    //         },
    //         scales: {
    //             yAxes: [{
    //                 gridLines: {
    //                     display: false ,
    //                     drawBorder: false,
    //                 },
    //             }],
    //             xAxes: [
    //             {
    //                 gridLines:
    //                 {
    //                     color: '#fbfbfb',
    //                     lineWidth: 2
    //                 }
    //             }]
    //         },
    //     }
    // });
}

var DatatableBasic = (function () {

    // Variables
    var $dtBasic = $('.datatable');

    // Methods

    function init($this) {
        var options =
        {
            "pageLength": 31,
            keys: !0,
            select: {
                style: "multi"
            },
            language: {
                paginate: {
                    previous: "<i class='fas fa-angle-left'>",
                    next: "<i class='fas fa-angle-right'>"
                }
            },
        };

        // Init the datatable

        var table = $this.on('init.dt', function () {
            $('div.dataTables_length select').removeClass('custom-select custom-select-sm');

        }).DataTable(options);
    }
    // Events
    if ($dtBasic.length) {
        init($dtBasic);
    }
})();

var DatatableBasic = (function () {
    // Variables
    var $dtBasic = $('.report');
    // Methods
    function init($this) {

        var options = {
            keys: !0,
            select: {
                style: "multi"
            },
            dom: 'Bfrtip',
            language: {
                paginate: {
                    previous: "<i class='fas fa-angle-left'>",
                    next: "<i class='fas fa-angle-right'>"
                }
            },
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        };

        // Init the datatable

        var table = $this.on('init.dt', function () {
            $('div.dataTables_length select').removeClass('custom-select custom-select-sm');
        }).DataTable(options);
    }
    // Events
    if ($dtBasic.length) {
        init($dtBasic);
    }
})();

var DatatableBasic = (function ()
{
    // Variables
    // var $dtBasic = $('.orderTable');
    // Methods

    // function init($this)
    // {
    //     var options = {
    //         keys: !0,
    //         select: {
    //             style: "multi"
    //         },
    //         dom: 'Bfrtip',
    //         language: {
    //             paginate: {
    //                 previous: "<i class='fas fa-angle-left'>",
    //                 next: "<i class='fas fa-angle-right'>"
    //             }
    //         },
    //         buttons: [
    //             'copyHtml5',
    //             'excelHtml5',
    //             'csvHtml5',
    //             'pdfHtml5'
    //         ],
    //         "footerCallback": function (row, data, start, end, display)
    //         {
    //             alert(row);
    //             cur = $('input[name=currency]').val();
    //             var intVal = function (i) {
    //                 return typeof i === 'string' ?
    //                     i.replace(cur, '') * 1 :
    //                     typeof i === 'number' ?
    //                         i : 0;
    //             };
    //             var api = this.api();
    //             api.columns(6,
    //             {
    //                 page: 'current'
    //             })
    //             .every(function ()
    //             {
    //                 var sum = this.data()
    //                 .reduce(function (a, b) {
    //                     var x = intVal(a) || 0;
    //                     var y = intVal(b) || 0;
    //                     return x + y;
    //                 }, 0);
    //                 console.log('sum',sum);
    //                 // $(this.footer()).html("Total paid  : " + sum);
    //                 // $(api.column(6).footer()).html(cur + sum);
    //             });
    //         }
    //     };
    //     // Init the datatable

    //     // var table = $this.on('init.dt', function () {
    //     //     $('div.dataTables_length select').removeClass('custom-select custom-select-sm');
    //     // }).DataTable(options);
    // }

    // // Events

    // if ($dtBasic.length) {
    //     init($dtBasic);
    // }
    // Variables
    var $dtBasic = $('.orderTable')
    // Methods
    function init($this)
    {
        var options =
        {
            keys: !0,
            select: {
                style: "multi"
            },
            dom: 'Bfrtip',
            language:
            {
                paginate:
                {
                    previous: "<i class='fas fa-angle-left'>",
                    next: "<i class='fas fa-angle-right'>"
                }
            },
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            "footerCallback": function (row, data, start, end, display)
            {
                cur = $('input[name=currency]').val();
                var intVal = function (i) {
                    return typeof i === 'string' ?
                        i.replace(cur, '') * 1 :
                        typeof i === 'number' ?
                            i : 0;
                };
                var api = this.api();
                api.columns(7,
                {
                    page: 'current'
                })
                .every(function ()
                {
                    var sum = this.data()
                    .reduce(function (a, b) {
                        var x = intVal(a) || 0;
                        var y = intVal(b) || 0;
                        return x + y;
                    }, 0);
                    $(api.column(7).footer()).html(cur + sum);
                });
            }
        };
        // };

        // Init the datatable
        var table = $this.on('init.dt', function ()
        {
            $('div.dataTables_length select').removeClass('custom-select custom-select-sm');
        }).DataTable(options);
    }
    // Events
    if ($dtBasic.length) {
        init($dtBasic);
    }
})();

function update_custimization(i, name)
{
    // var name = name.replace(' ', '_');
    var name = name.split(' ').join('_');
    var tds = parseInt($("input[name='name" + name + "[]']").length);
    $('#custom' + i).append('<tr id="custom' + i + '"><td><input type="text" name="name' + name + '[]" class="form-control" required placeholder="item" style="text-transform: none;"></td><td><input type="number" name="price[]" class="form-control" required placeholder="price"></td><td><input type="radio" name="isdefault_' + name + '" value="' + tds + '" id="' + i + '_' + tds + '"><label for="' + i + '_' + tds + '">&nbsp;Default</label></td><td><input type="checkbox" id="status' + i + '_' + tds + '" name="status' + tds + '"><label for="status' + i + '_' + tds + '">Status</label></td><td><button type="button" class="btn btn-primary removebtn"><i class="fas fa-times"></i></button></td></tr>');
}

function add_field() {
    $('.delivery_table').append('<tr><td><input type="number" required name="min_value[]" class="form-control"></td><td><input type="number" required name="max_value[]" class="form-control"></td><td><input type="number" required name="charges[]" class="form-control"></td><td><button type="button" class="btn btn-primary removebtn"><i class="fas fa-times"></i></button></td></tr>');
}

function add_cancel_reason() {
    $('.cancel_reason').append('<tr><td><input type="text" name="cancel_reason[]" class="form-control" required></td><td><button type="button" class="btn btn-primary removebtn"><i class="fas fa-times"></i></button></td></tr>');
}

function add_drivervehical_field() {
    $('.driver_vehical_table').append('<tr><td><input type="text" name="vehical_type[]" class="form-control" required></td><td><select name="license[]" class="form-control"><option value="yes">Yes</option><option value="no">no</option></select></td><td><button type="button" class="btn btn-primary removebtn"><i class="fas fa-times"></i></button></td></tr>');
}

function add_driverearning_field() {
    $('.driver_earning_table').append('<tr><td><input type="number" name="min_km[]" class="form-control" required></td><td><input type="number" name="max_km[]" class="form-control" required></td><td><input type="number" name="charge[]" class="form-control" required></td><td><button type="button" class="btn btn-primary removebtn"><i class="fas fa-times"></i></button></td></tr>');
}

function addhours(i) {
    var start_time = $('#start_time').val();
    var end_time = $('#end_time').val();
    var timeslot = $('#timeslot').val();
    $('#tr' + i).after('<tr><td><input class="timeslots" name="start_time_' + i + '[]" /></td><td><input class="timeslots" name="end_time_' + i + '[]"/></td><td><button type="button" class="removebtn btn btn-danger text-light"><i class="fas fa-times"></i></button></tr>');
    $('.timeslots').timepicker({
        timeFormat: 'h:mm p',
        defaultTime: '11',
        interval: timeslot,
        dynamic: false,
        dropdown: true,
        scrollbar: true,
        minTime: start_time,
        maxTime: end_time,
    });
}

function show_order(id) {
    $.ajax(
    {
        //alert('show order')
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: base_url + '/vendor/order/' + id,
        data:
        {
            id: id,
        },
        success: function (result) {
            if (result.success == true)
            {
                $('.show_order_id').text(result.data.order.order_id);
                $('.show_user_name').text(result.data.order.user.name);
                $('.show_date').text(result.data.order.date);
                $('.show_time').text(result.data.order.time);
                $('.show_admin_commission').text(result.data.currency + result.data.order.admin_commission);
                $('.show_vendor_amount').text(result.data.currency + result.data.order.vendor_amount);
                $('.TaxTable').html('');
                if(!Array.isArray(result.data.order.tax))
                {
                    var t = JSON.parse(result.data.order.tax);
                    t.forEach(element => {
                        $('.TaxTable').append('<tr><td>'+element.name+'</td><td>'+result.data.currency + element.tax+'</td></tr>');
                    });
                }

                $('.show_order_table').html('');
                result.data.order.orderItems.forEach(element => {
                    $('.show_order_table').append('<tr><td>' + element.itemName + '(' + element.qty + ')' + '</td><td>' + result.data.currency + element.price + '</td><td class="show_custimization_name' + element.id + '"></td><td class="show_custimization_price' + element.id + '"></td></tr>');
                    if (element.custimization != null) {
                        element.custimization.forEach(custimization => {
                            $('.show_custimization_name' + element.id).text(custimization.data.name);
                            $('.show_custimization_price' + element.id).text(result.data.currency + custimization.data.price);
                        });
                    }
                    else {
                        $('.show_custimization_name' + element.id).text("doesn't apply any custimization");
                    }
                });
                $('.show_delivery_at').text(result.data.order.delivery_type);
                $('.show_total_amount').text(result.data.currency + result.data.order.amount);
                if (result.data.order.promocode_price != null) {
                    $('.show_discount').text(result.data.currency + result.data.order.promocode_price);
                }
                else if (result.data.order.vendor_discount_price != null) {
                    $('.show_discount').text(result.data.currency + result.data.order.vendor_discount_price);
                }
                else {
                    $('.show_discount').text("doesn't apply any promo code");
                }
            }
        },
        error: function (err) {
            console.log('err ', err)
        }
    });
}

function show_admin_order(id) {
    $.ajax(
    {
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: base_url + '/admin/order/' + id,
        data:
        {
            id: id,
        },
        success: function (result) {
            if (result.success == true)
            {
                // $('.show_order_id').text(result.data.order.order_id);
                // $('.show_user_name').text(result.data.order.user.name);
                // $('.show_date').text(result.data.order.date);
                // $('.show_time').text(result.data.order.time);
                // $('.show_admin_commission').text(result.data.currency + result.data.order.admin_commission);
                // $('.show_vendor_amount').text(result.data.currency + result.data.order.vendor_amount);
                // $('.show_order_table').html('');
                // result.data.order.orderItems.forEach(element => {
                //     $('.show_order_table').append('<tr><td>' + element.itemName + '</td><td>' + result.data.currency + element.price + '</td><td class="show_custimization_name' + element.id + '"></td><td class="show_custimization_price' + element.id + '"></td></tr>');
                //     if (element.custimization != null) {
                //         JSON.parse(element.custimization).forEach(custimization => {
                //             $('.show_custimization_name' + element.id).text(custimization.custimization_name);
                //             $('.show_custimization_price' + element.id).text(result.data.currency + custimization.custimization_price);
                //         });
                //     }
                //     else {
                //         $('.show_custimization_name' + element.id).text("doesn't apply any custimization");
                //     }
                // });
                // $('.show_delivery_at').text(result.data.order.delivery_type);
                // $('.show_total_amount').text(result.data.currency + result.data.order.amount);
                // if (result.data.order.promocode_price != null) {
                //     $('.show_discount').text(result.data.currency + result.data.order.promocode_price);
                // }
                // else if (result.data.order.vendor_discount_price != null) {
                //     $('.show_discount').text(result.data.currency + result.data.order.vendor_discount_price);
                // }
                // else {
                //     $('.show_discount').text("doesn't apply any promo code");
                // }
                $('.show_order_id').text(result.data.order.order_id);
                $('.show_user_name').text(result.data.order.user.name);
                $('.show_date').text(result.data.order.date);
                $('.show_time').text(result.data.order.time);
                $('.show_admin_commission').text(result.data.currency + result.data.order.admin_commission);
                $('.show_vendor_amount').text(result.data.currency + result.data.order.vendor_amount);
                $('.StatusTable').html('');

                console.log(result.data);

                result.data.order.statuses.forEach(element => {
                    $('.StatusTable').append('<tr><td>'+element.title+'</td><td>'+element.created_at+'</td></tr>');
                });

                if(!Array.isArray(result.data.order.statuses))
                {
                    var t = JSON.parse(result.data.order.statuses);
                    t.forEach(element => {
                        $('.StatusTable').append('<tr><td>'+element.code+'</td><td>'+result.data.currency + element.tax+'</td></tr>');
                    });
                }

                $('.show_order_table').html('');
                result.data.order.orderItems.forEach(element => {
                    $('.show_order_table').append('<tr><td>' + element.itemName + '(' + element.qty + ')' + '</td><td>' + result.data.currency + element.price + '</td><td class="show_custimization_name' + element.id + '"></td><td class="show_custimization_price' + element.id + '"></td></tr>');
                    if (element.custimization != null) {
                        element.custimization.forEach(custimization => {
                            $('.show_custimization_name' + element.id).text(custimization.data.name);
                            $('.show_custimization_price' + element.id).text(result.data.currency + custimization.data.price);
                        });
                    }
                    else {
                        $('.show_custimization_name' + element.id).text("doesn't apply any custimization");
                    }
                });
                $('.show_delivery_at').text(result.data.order.delivery_type);
                $('.show_total_amount').text(result.data.currency + result.data.order.amount);
                if (result.data.order.promocode_price != null) {
                    $('.show_discount').text(result.data.currency + result.data.order.promocode_price);
                }
                else if (result.data.order.vendor_discount_price != null) {
                    $('.show_discount').text(result.data.currency + result.data.order.vendor_discount_price);
                }
                else {
                    $('.show_discount').text("doesn't apply any promo code");
                }
            }
        },
        error: function (err) {
            console.log('err ', err)
        }
    });
}

function show_settle_details(index) {
    var duration = $('#duration' + index).text();
    $.ajax({
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: base_url + '/admin/show_settalement/' + duration,
        success: function (result) {
            if (result.success == true) {
                $('.details_body').html('');
                $('.details_body').append('<div class="table-responsive"><table class="table"><thead class="display"><tr><th>Date</th><th>Vendor earning</th><th>Settlement with</th><th>Payment token</th></tr></thead></table></div>');
                if (result.data.length != 0) {
                    result.data.forEach(element => {
                        if (element.vendor_status == 1) {
                            var token = element.payment_token == null ? "Payment with cod" : element.payment_token;
                            $('.display').after('<tbody><td>' + element.date + '</td><td>' + result.currency + element.vendor_earning + '</td><td>' + element.payment_type + '</td><td>' + token + '</td></tbody>');
                        }
                        else {
                            $('.display').after('<tbody><td>' + element.date + '</td><td>' + result.currency + element.vendor_earning + '</td><td class="text-center" colspan=2>' + "Payment not complete" + '</td></tbody>');
                        }
                    });
                }
                else {
                    $('.display').after('<tbody class="text-center"><td colspan="4">No details found</td></tbody>');
                }
            }
        },
        error: function (err) {
            console.log('err ', err)
        }
    });
}

function show_driver_settle_details(index, id) {
    var duration = $('#duration' + index).text();
    $.ajax({
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: base_url + '/admin/show_driver_settle_details/' + duration + '/' + id,
        success: function (result) {
            if (result.success == true) {
                $('.details_body').html('');
                $('.details_body').append('<div class="table-responsive"><table class="table"><thead class="display"><tr><th>Date</th><th>Vendor earning</th><th>Settlement with</th><th>Payment token</th></tr></thead></table></div>');
                if (result.data.length != 0) {
                    result.data.forEach(element => {
                        if (element.driver_status == 1) {
                            var token = element.driver_payment_token == null ? "Payment with cod" : element.driver_payment_token;
                            $('.display').after('<tbody><td>' + element.date + '</td><td>' + result.currency + element.driver_earning + '</td><td>' + element.driver_payment_type + '</td><td>' + token + '</td></tbody>');
                        }
                        else {
                            $('.display').after('<tbody><td>' + element.date + '</td><td>' + result.currency + element.driver_earning + '</td><td class="text-center" colspan=2>' + "Payment not complete" + '</td></tbody>');
                        }
                    });
                }
                else {
                    $('.display').after('<tbody class="text-center"><td colspan="4">No details found</td></tbody>');
                }
            }
        },
        error: function (err) {
            console.log('err ', err)
        }
    });
}

function notificationTemplateEdit(id) {
    $.ajax({
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: base_url + '/admin/notification_template/' + id + '/edit/',
        data:
        {
            id: id,
        },
        success: function (result)
        {
            if (result.success == true) {
                $('#notification_content').val(result.data.notification_content);
                $("h2").html(result.data.title);
                $('#subject').val(result.data.subject);
                $('#title').val(result.data.title);
                $('.textarea_editor').summernote('code', result.data.mail_content);
                $('.edit_notification_template_form').attr("action", base_url + "/admin/notification_template/" + result.data.id);
            }
        },
        error: function (err) {
            console.log('err ', err)
        }
    });
}

function update_submenu(id) {
    $.ajax({
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: base_url + '/admin/submenu/' + id + '/edit',
        success: function (result) {
            $('#update_submenu_form').attr("action", base_url + "/admin/submenu/" + result.data.id);
            $('#update_image').attr('src', result.data.image);
            $('#update_name').val(result.data.name);
            $('#update_price').val(result.data.price);
            $('#update_description').val(result.data.description);
            $('#type').val(result.data.type);

            if (result.data.qty_reset == 'never') {
                $('input[name=item_reset_value]').prop("disabled", true);
                $('input[name=item_reset_value]').val(0);
                $("#never").prop('checked', true);
            }
            else {
                $('input[name=item_reset_value]').prop("disabled", false);
                $('input[name=item_reset_value]').val(result.data.item_reset_value);
                $("#daily").prop('checked', true);
            }
        },
        error: function (err) {

        }
    });
}

function order_status(id) {
    $.ajax(
    {
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        data:
        {
            id: id,
            status: $('#status' + id).val(),
        },
        url: base_url + '/admin/order/change_status',
        success: function (result) {
            //alert(result);
            if (result.success == true)
            {
                location.reload();
                if (result.data.status == 'PENDING') {
                    $('.orderStatusTd' + id).html('');
                    $('.orderStatusTd' + id).html('<span class="badge badge-pill pending order_status' + result.data.order_id + '">PENDING</span>');
                }

                if (result.data.status == 'APPROVE') {
                    $('.orderStatusTd' + id).html('');
                    $('.orderStatusTd' + id).html('<span class="badge badge-pill approve order_status' + result.data.order_id + '">APPROVE</span>');
                }

                if (result.data.status == 'REJECT') {
                    $('.orderStatusTd' + id).html('');
                    $('.orderStatusTd' + id).html('<span class="badge badge-pill reject order_status' + result.data.order_id + '">REJECT</span>');
                }

                if (result.data.status == 'CANCEL') {
                    $('.orderStatusTd' + id).html('');
                    $('.orderStatusTd' + id).html('<span class="badge badge-pill cancel order_status' + result.data.order_id + '">CANCEL</span>');
                }

                if (result.data.status == 'PICKUP') {
                    $('.orderStatusTd' + id).html('');
                    $('.orderStatusTd' + id).html('<span class="badge badge-pill pickup order_status' + result.data.order_id + '">PICKUP</span>');
                }

                if (result.data.status == 'DELIVERED') {
                    $('.orderStatusTd' + id).html('');
                    $('.orderStatusTd' + id).html('<span class="badge badge-pill delivered order_status' + result.data.order_id + '">DELIVERED</span>');
                }

                if (result.data.status == 'COMPLETE') {
                    $('.orderStatusTd' + id).html('');
                    $('.orderStatusTd' + id).html('<span class="badge badge-pill complete order_status' + result.data.order_id + '">COMPLETE</span>');
                }

                if (result.data.status == 'PREPARE_FOR_ORDER') {
                    $('.orderStatusTd' + id).html('');
                    $('.orderStatusTd' + id).html('<span class="badge badge-pill preparre-food order_status' + result.data.order_id + '">PREPARE FOR ORDER</span>');
                }

                if (result.data.status == 'READY_FOR_ORDER') {
                    $('.orderStatusTd' + id).html('');
                    $('.orderStatusTd' + id).html('<span class="badge badge-pill ready_for_food order_status' + result.data.order_id + '">READY FOR ORDER</span>');
                }
            }
            else {

            }
        },
        error: function (err) {
            console.log('err ', err)
        }
    });
}

function update_submenucustimization(id) {
    $.ajax({
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: base_url + '/admin/customization_type/' + id + '/edit',
        success: function (result) {
            console.log(result);

            $('#update_cutimization_form').attr("action", base_url + "/admin/customization_type/" + result.data.id);
            $('#update_name').val(result.data.name);
            $('#update_min_item_selection').val(result.data.min_item_selection);
            $('#update_max_item_selection').val(result.data.max_item_selection);
            if (result.data.qty_reset == 'veg') {
                $("#veg").prop('checked', true);
            }
            else {
                $("#non-veg").prop('checked', true);
            }
        },
        error: function (err) {
        }
    });
}

function update_delivery_time() {
    var a = $("input[name=start_time").length;
    $.ajax({
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: base_url + '/admin/update_delivery_time',
        success: function (result) {

        },
        error: function (err) {
        }
    });
}

function update_menu(id) {
    $.ajax({
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: base_url + '/admin/menu/' + id + '/edit',
        success: function (result) {
            if (result.success == true) {
                $('#update_menu_form').attr("action", base_url + "/admin/menu/" + result.data.id);
                $('#update_image').attr('src', result.data.image);
                $('#update_menu').val(result.data.name);
                // $('#update_menu_category_id').val(result.data.menu_category_id);
            }
        },
        error: function (err) {
            console.log('err ', err)
        }
    });
}

function update_cuisine(id) {
    $.ajax({
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",

        url: base_url + '/admin/cuisine/' + id + '/edit',
        success: function (result) {
            console.log('result', result);
            if (result.success == true) {
                $('#update_image').attr('src', result.data.image);
                $('#update_cuisine_form').attr("action", base_url + "/admin/cuisine/" + result.data.id);
                $('#update_cuisine').val(result.data.name);
            }
        },
        error: function (err) {
            console.log('err ', err)
        }
    });
}

function update_banner(id) {
    $.ajax({
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",

        url: base_url + '/admin/banner/' + id + '/edit',
        success: function (result) {
            console.log('result', result);
            if (result.success == true) {
                $('#update_banner_form').attr("action", base_url + "/admin/banner/" + result.data.id);
                $('#update_image').attr('src', result.data.image);
                $('#update_name').val(result.data.name);
            }
        },
        error: function (err) {
            console.log('err ', err)
        }
    });
}

function change_selling_timeslot(url, id) {
    $.ajax({
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: base_url + '/' + url + '/selling_timeslot',
        data:
        {
            id: id,
        },
        success: function (result) {
            iziToast.success({
                message: 'Change timeslots successfully..!!',
                position: 'topRight',
            })
        },
        error: function (err) {
            console.log('err ', err)
        }
    });
}

function change_status(url, id) {
    console.log(base_url + '/' + url + '/change_status');
    $.ajax({
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: base_url + '/' + url + '/change_status',
        data:
        {
            id: id,
        },
        success: function (result) {
            iziToast.success({
                message: 'Change status successfully..!!',
                position: 'topRight',
            })
        },
        error: function (err) {

        }
    });
}

function driver_assign(order_id)
{
    $.ajax(
    {
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        data:
        {
            order_id: order_id,
            driver_id: $('#driver_id' + order_id).val(),
        },
        url: base_url + '/vendor/order/driver_assign',
        success: function (result) {
            if (result.success == true)
            {
                $('#driver_id' + order_id).prop('disabled',true);
                iziToast.success({
                    message: 'Driver assigned successfully..!!',
                    position: 'topRight',
                    })
            }
        },
        error: function (err) {
            console.log('err ', err)
        }
    });
}

function user_bank_details(id)
{
    $.ajax(
    {
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: base_url + '/admin/user_bank_details/'+id,
        success: function (result) {
            if (result.success == true)
            {
                $('.ifsc_code').text(result.data.ifsc_code);
                $('.account_name').text(result.data.account_name);
                $('.micr_code').text(result.data.micr_code);
                $('.account_number').text(result.data.account_number);
                $('.user_name').text(result.data.name);
            }
        },
        error: function (err) {
            console.log('err ', err)
        }
    });
}

function refundStatus(refund_id)
{
    $.ajax(
    {
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        data:
        {
            refund_id: refund_id,
            refund_status: $('#' + refund_id).val(),
        },
        url: base_url + '/admin/refund/refund_status',
        success: function (result) {
            if (result.success == true)
            {
                location.reload();
            }
        },
        error: function (err) {
            console.log('err ', err)
        }
    });
}


function deleteData(url, id,name) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "DELETE",
                dataType: "JSON",
                url: base_url + '/' + url + '/' + id,
                success: function (result) {
                    console.log(result);
                    if (result.success == true) {
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                        console.log('result ', result)
                        Swal.fire(
                            'Deleted!',
                            'Your '+name+' has been deleted.',
                            'success'
                        )
                    }
                    else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: result.data
                        })
                    }
                },
                error: function (err) {
                    console.log('err ', err)
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'This record is conntect with another data!'
                    })
                }
            });
        }
    });
}

function deleteAll(url,name)
{
    var allVals = [];
    $(".sub_chk:checked").each(function() {
        allVals.push($(this).attr('data-id'));
    });
    if(allVals.length <=0)
    {
        alert("Please select row.");
    }
    else
    {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: base_url + '/admin' +'/' + url,
                    data:{
                        ids: allVals.join(","),
                    },
                    success: function (result) {
                        console.log(result);
                        if (result.success == true) {
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                            console.log('result ', result)
                            Swal.fire(
                                'Deleted!',
                                'Your '+name+' has been deleted.',
                                'success'
                            )
                        }
                        else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: result.data
                            })
                        }
                    },
                    error: function (err) {
                        console.log('err ', err)
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'This record is conntect with another data!'
                        })
                    }
                });
            }
        });
    }
}

