@extends('layouts.main', ['activePage' => 'usuarios', 'titlePage' => 'Categoria Presupuestal'])

@section('css')
    <!-- Table datatable css -->
    <link href="{{ asset('/') }}public/assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/') }}public/assets/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/') }}public/assets/libs/datatables/fixedHeader.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/') }}public/assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/') }}public/assets/libs/datatables/scroller.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <link href="{{ asset('/') }}public/assets/jquery-ui/jquery-ui.css" rel="stylesheet" />

    <style>
        .tablex thead th {
            padding: 6px;
            text-align: center;
        }

        .tablex thead td {
            padding: 6px;
            text-align: center;
            vertical-align: middle;
            font-weight: bold;
        }

        .tablex tbody td,
        .tablex tbody th,
        .tablex tfoot td,
        .tablex tfoot th {
            padding: 5px;
        }

        .ui-autocomplete {
            z-index: 215000000 !important;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        {{-- <form class="">@csrf </form> --}}

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-border">
                    <div class="card-header bg-transparent pb-0">
                        <div class="card-widgets">
                            <button type="button" class="btn btn-danger btn-xs" onclick="location.reload()"><i
                                    class="fa fa-redo"></i> Actualizar</button>
                        </div>
                        <h3 class="card-title">FILTRO</h3>
                    </div>
                    <div class="card-body pt-2 pb-0">
                        <form class="form-horizontal" id="form-filtro">
                            @csrf
                            <div class="form">
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label class=" col-form-label">Año</label>
                                        <div class="">
                                            <select class="form-control" name="ganio" id="ganio"
                                                onchange="cargarcuadros2();">
                                                @foreach ($ano as $item)
                                                    <option value="{{ $item->anio }}">{{ $item->anio }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="col-form-label">Producto/Proyecto</label>
                                        <div class="">
                                            <select class="form-control" name="garticulo" id="garticulo"
                                                onchange="cargarcuadros2();">
                                                <option value="0">TODOS</option>
                                                @foreach ($articulo as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="col-form-label">Unidad Ejecutora</label>
                                        <div class="">
                                            <select class="form-control" name="gue" id="gue"
                                                onchange="cargarcuadros2();">
                                                <option value="0">TODOS</option>
                                                @foreach ($ue as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="col-form-label">Tipo Categoria</label>
                                        <div class="">
                                            <select class="form-control" name="gtc" id="gtc"
                                                onchange="cargarcuadros2();">
                                                <option value="0">TODOS</option>
                                                <option value="ACCIONES CENTRALES">ACCIONES CENTRALES</option>
                                                <option value="APNOP">APNOP</option>
                                                <option value="PROGRAMA PRESUPUESTAL">PROGRAMA PRESUPUESTAL</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- card-body -->
                </div>
                <!-- card -->
            </div>
            <!-- col -->
        </div>
        <!-- End row -->

        <div class="row">
            <div class="col-xl-12 principal">
                <div class="card card-border">
                    <div class="card-header border-primary">{{--  bg-transparent pb-0 mb-0 --}}
                        <div class="card-widgets">
                            <button type="button" class="btn btn-success btn-xs" onclick="descargar()"><i
                                    class="fa fa-file-excel"></i>
                                Excel</button>
                        </div>
                        <h3 class="card-title">Ejecución de Gastos, según Categoría Presupuestal</h3>
                    </div>
                    <div class="card-body pb-0 pt-0">
                        <div class="table-responsive" id="vista4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end  row --}}

        <div class="row">
            <div class="col-xl-12">
                <div class="card card-border card-primary">
                    <div class="card-header border-primary bg-transparent p-0">
                        <h3 class="card-title anal1">Categoria Presupuestal</h3>
                    </div>
                    <div class="card-body p-0">
                        <div id="anal1"></div>{{-- style="min-width:100%;height:600px;margin:0 auto;" --}}
                        {{--  style="min-width:400px;height:300px;margin:0 auto;" --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- end  row --}}

    </div>

    <!-- Bootstrap modal -->
    <div id="modal_form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        style="overflow:auto">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="form_title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bootstrap modal -->
@endsection

@section('js')
    <script src="{{ asset('/') }}public/assets/jquery-ui/jquery-ui.js"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}

    <!-- third party js -->
    <script src="{{ asset('/') }}public/assets/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}public/assets/libs/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="{{ asset('/') }}public/assets/libs/datatables/dataTables.responsive.min.js"></script>
    <script src="{{ asset('/') }}public/assets/libs/datatables/responsive.bootstrap4.min.js"></script>

    <script src="{{ asset('/') }}public/assets/libs/datatables/dataTables.buttons.min.js"></script>
    <script src="{{ asset('/') }}public/assets/libs/datatables/buttons.bootstrap4.min.js"></script>

    <script src="{{ asset('/') }}public/assets/libs/jszip/jszip.min.js"></script>
    <script src="{{ asset('/') }}public/assets/libs/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('/') }}public/assets/libs/pdfmake/vfs_fonts.js"></script>

    <script src="{{ asset('/') }}public/assets/libs/datatables/buttons.html5.min.js"></script>
    <script src="{{ asset('/') }}public/assets/libs/datatables/buttons.print.min.js"></script>

    <script src="{{ asset('/') }}public/assets/libs/datatables/dataTables.fixedHeader.min.js"></script>
    <script src="{{ asset('/') }}public/assets/libs/datatables/dataTables.keyTable.min.js"></script>
    <script src="{{ asset('/') }}public/assets/libs/datatables/dataTables.scroller.min.js"></script>

    {{-- highcharts --}}
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        var save_method = '';
        var table_principal;

        $(document).ready(function() {
            $("input").change(function() {
                $(this).parent().removeClass('has-error');
                $(this).next().empty();
            });
            $("textarea").change(function() {
                $(this).parent().removeClass('has-error');
                $(this).next().empty();
            });
            $("select").change(function() {
                $(this).parent().removeClass('has-error');
                $(this).next().empty();
            });

            cargarcuadros2();
        });


        function cargarcuadros2() {
            /*
             *AJAX PARA LA PRESENTACION DE LA PRIMERA tabla 2
             */
            $.ajax({
                url: "{{ route('basesiafweb.rpt2.tabla01') }}",
                data: {
                    'anio': $('#ganio').val(),
                    'articulo': $('#garticulo').val(),
                    'ue': $('#gue').val(),
                    'tc': $('#gtc').val(),
                },
                type: "GET",
                beforeSend: function() {
                    $('#vista4').html('<span><i class="fa fa-spinner fa-spin"></i></span>');
                },
                success: function(data) {
                    $('#vista4').html(data);
                    $('#tabla1').DataTable({
                        "language": table_language,
                        paging: false,
                        searching: false,
                        //"aLengthMenu":[100]
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    $('#vista4').html('Sin Informacion Disponible');
                },
            });
        }

        function graficar(id, nombre) {
            $.ajax({
                url: "{{ route('basesiafweb.rpt2.gra.1') }}",
                data: {
                    'anio': $('#ganio').val(),
                    'articulo': $('#garticulo').val(),
                    'ue': $('#gue').val(),
                    'tipocategoria': $('#gtc').val(),
                    'categoriapresupuestal': id,
                },
                type: "GET",
                dataType: "JSON",
                beforeSend: function() {
                    $('#anal1').html('<span><i class="fa fa-spinner fa-spin"></i></span>');
                },
                success: function(data) {
                    $('.registros').removeClass('table-warning');
                    $('#reg' + id).addClass('table-warning');
                    $('.anal1').html(nombre);
                    gAnidadaColumn('anal1',
                        data.info.categoria,
                        data.info.series,
                        '',
                        'PIM Y DEVENGADO ACUMULADO Y EJECUCIÓN MENSUAL');

                    /* $('.modal-title').html(nombre);
                    $('#modal_form').modal('show'); */
                },
                erro: function(jqXHR, textStatus, errorThrown) {
                    console.log("ERROR GRAFICA 1");
                    console.log(jqXHR);
                },
            });
        }

        function descargar() {
            $.ajax({
                url: "{{ url('/') }}/SiafGastos/reportes2/Exportar/excel/null/null/null/null",
                type: "GET",
                success: function(data) {
                    window.open("{{ url('/') }}/SiafGastos/reportes2/Exportar/excel/" +
                        $('#ganio').val() + "/" + $('#garticulo').val() + "/" + $('#gue').val() + "/" + $(
                            '#gtc').val());

                },
            });
        }
    </script>
    <script>
        function gAnidadaColumn(div, categoria, series, titulo, subtitulo) {
            Highcharts.chart(div, {
                chart: {
                    zoomType: 'xy',
                },
                title: {
                    text: titulo, //'Browser market shares in January, 2018'
                },
                subtitle: {
                    text: subtitulo,
                },
                xAxis: [{
                    categories: categoria,
                    crosshair: true
                }],
                yAxis: [{ // Primary yAxis
                        //max: 2000000000,
                        labels: {
                            enabled: false,
                        },
                        title: {
                            enabled: false,
                        },
                        /* labels: {
                            format: '{value}°C',
                            style: {
                                color: Highcharts.getOptions().colors[2]
                            }
                        },
                        title: {
                            text: 'Temperature',
                            style: {
                                color: Highcharts.getOptions().colors[2]
                            }
                        }, */
                        //opposite: true,
                    }, { // Secondary yAxis
                        gridLineWidth: 0,
                        labels: {
                            enabled: false,
                        },
                        title: {
                            enabled: false,
                        },
                        /* title: {
                            text: 'Rainfall',
                            style: {
                                color: Highcharts.getOptions().colors[0]
                            }
                        },
                        labels: {
                            format: '{value} mm',
                            style: {
                                color: Highcharts.getOptions().colors[0]
                            }
                        }, */
                        min: -100,
                        max: 150,
                        opposite: true,
                    },
                    /* { // Tertiary yAxis
                                       gridLineWidth: 0,
                                       title: {
                                           text: 'Sea-Level Pressure',
                                           style: {
                                               color: Highcharts.getOptions().colors[1]
                                           }
                                       },
                                       labels: {
                                           format: '{value} mb',
                                           style: {
                                               color: Highcharts.getOptions().colors[1]
                                           }
                                       },
                                       opposite: true
                                   } */
                ],
                series: series,
                plotOptions: {
                    /* columns: {
                        stacking: 'normal'
                    }, */
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            //format: '{point.y:,.0f}',
                            //format: '{point.y:.1f}%',
                            formatter: function() {
                                if (this.y > 1000000) {
                                    return Highcharts.numberFormat(this.y / 1000000, 0) + "M";
                                } else if (this.y > 1000) {
                                    return Highcharts.numberFormat(this.y / 1000, 0) + "K";
                                } else if (this.y < 101) {
                                    return this.y + "%";
                                } else {
                                    return this.y;
                                }
                            },
                            style: {
                                fontWeight: 'normal',
                            }
                        },
                    },
                },
                tooltip: {
                    shared: true,
                },
                legend: {
                    itemStyle: {
                        "color": "#333333",
                        "cursor": "pointer",
                        "fontSize": "10px",
                        "fontWeight": "normal",
                        "textOverflow": "ellipsis"
                    },
                },
                credits: false,
            });
        }
    </script>
@endsection
