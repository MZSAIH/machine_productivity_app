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

function change_machine_prod(prod_id) {
    $.ajax(
    {
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: base_url + '/production/change_machine',
        data:{
            p_id: prod_id,
            m_id: $('#machine_prod' + prod_id).val(),
        },
        success: function (result) {
            location.reload();
            // console.log(result);
            iziToast.success({
                message: 'Change machine successfully..!!',
                position: 'topRight',
            });
        },
        error: function (err) {
            console.log('err ', err)
        }
    });
}

function select_action_change(value){
    alert(value);
    // switch (value) {
    //     case 71:
    //         alert('777')
    //         $('#material').prop( "disabled", false );
    //         break;
    //     default:
    //         alert('def')
    //         $('#material').prop( "disabled", true );
    //         break;
    // }
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
