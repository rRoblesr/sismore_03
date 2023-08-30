@extends('layouts.main', ['titlePage' => 'IMPORTAR DATOS - TABLETAS'])
@section('css')
    <!-- Table datatable css -->
    <link href="{{ asset('/') }}public/assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"> --}}
@endsection
@section('content')
    <div class="content">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                Error al Cargar Archivo <br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($mensaje != '')
            {{-- <div class="alert alert-danger"> --}}
            <div class="alert alert-{{ $tipo }}">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ $mensaje }}
                {{-- <ul>
                    <li>{{ $mensaje }}</li>
                </ul> --}}
            </div>
        @endif

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-border">
                    <div class="card-header border-success-0 bg-transparent pb-0">
                        <h3 class="card-title">Datos de importación
                        </h3>
                    </div>
                    <div class="card-body pb-0">
                        <form class="cmxform form-horizontal tasi-form upload_file">
                            @csrf
                            <input type="hidden" id="ccomment" name="comentario" value="">
                            {{-- <input type="hidden" id="anio" name="anio" value="{{ date('Y') }}"> --}}
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="col-form-label">Fuente de datos</label>
                                    <div class="">
                                        <input type="text" class="form-control btn-xs" readonly="readonly"
                                            value="SIDI - TABLETA">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="col-form-label">Fecha Versión</label>
                                    <div class="">
                                        <input type="date" class="form-control btn-xs" name="fechaActualizacion"
                                            placeholder="Ingrese fecha actualizacion" autofocus required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label">Archivo</label>
                                    <div class="">
                                        <input type="file" name="file" class="form-control btn-xs" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row  mt-0 mb-0">
                                {{-- <label class="col-md-2 col-form-label"></label> --}}
                                <div class="col-md-12">
                                    <div class="pwrapper m-0" style="display:none;">
                                        <div class="progress progress_wrapper">
                                            <div class="progress-bar progress-bar-striped bg-info progress-bar-animated progress_bar"
                                                role="progressbar" style="width:0%">0%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row ">
                                <div class="offset-lg-2 col-lg-10 text-right">
                                    <button class="btn btn-primary waves-effect waves-light mr-1"
                                        type="submit">Importar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-border">
                    <div class="card-header border-success-0 bg-transparent pb-0">
                        <h3 class="card-title">HISTORIAL DE IMPORTACION</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                                        style="font-size: 12px">
                                        <thead class="text-primary">
                                            <tr>
                                                <th>N°</th>
                                                <th>Version</th>
                                                <th>Fuente</th>
                                                <th>Usuario</th>
                                                <th>Area</th>
                                                <th>Registro</th>
                                                <th>Estado</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- card-body -->

                </div>

            </div> <!-- End col -->
        </div> <!-- End row -->

        <!-- Bootstrap modal -->
        <div id="modal-siagie-matricula" class="modal fade centrarmodal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="siagie-matricula" class="table table-striped table-bordered"
                                style="font-size:10px;width:5000px;">
                                <thead class="text-primary">
                                    <th>UGEL</th>
                                    <th>PROVINCIA</th>
                                    <th>DISTRITO</th>
                                    <th>COD_MOD</th>
                                    <th>INSTITUCION_EDUCATIVA</th>
                                    <th>ESTADO</th>
                                    <th>TABLETAS_PROGRAMADAS</th>
                                    <th>CARGADORES_PROGRAMADAS</th>
                                    <th>TABLETAS_CHIP</th>
                                    <th>TABLETAS_PECOSA</th>
                                    <th>CARGADORES_PECOSA</th>
                                    <th>TABLETAS_PECOSA_SIGA</th>
                                    <th>CARGADORES_PECOSA_SIGA</th>
                                    <th>TABLETAS_ENTREGADAS_SIGEMA</th>
                                    <th>CARGADORES_ENTREGADAS_SIGEMA</th>
                                    <th>TABLETAS_RECEPCIONADAS</th>
                                    <th>CARGADORES_RECEPCIONADAS</th>
                                    <th>TABLETAS_ASIGNADAS</th>
                                    <th>TABLETAS_ASIGNADAS_ESTUDIANTES</th>
                                    <th>TABLETAS_ASIGNADAS_DOCENTES</th>
                                    <th>CARGADORES_ASIGNADAS</th>
                                    <th>CARGADORES_ASIGNADAS_ESTUDIANTES</th>
                                    <th>CARGADORES_ASIGNADAS_DOCENTES</th>
                                    <th>TABLETAS_DEVUELTAS</th>
                                    <th>CARGADORES_DEVUELTOS</th>
                                    <th>TABLETAS_PERDIDAS</th>
                                    <th>CARGADORES_PERDIDOS</th>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bootstrap modal -->

    </div>
@endsection

@section('js')
    <script>
        var table_principal = '';
        $(document).ready(function() {
            $('.upload_file').on('submit', upload);

            table_principal = $('#datatable').DataTable({
                responsive: true,
                autoWidth: false,
                ordered: true,
                language: table_language,
                ajax: "{{ route('importableta.listar.importados') }}",
                type: "GET",
            });
        });

        function upload(e) {
            e.preventDefault();
            let form = $(this),
                wrapper = $('.pwrapper'),
                /* wrapper_f = $('.wrapper_files'), */
                progress_bar = $('.progress_bar'),
                data = new FormData(form.get(0));

            progress_bar.removeClass('bg-success bg-danger').addClass('bg-info');
            progress_bar.css('width', '0%');
            progress_bar.html('Preparando...');

            wrapper.fadeIn();

            $.ajax({
                xhr: function() {
                    let xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(e) {
                        if (e.lengthComputable) {
                            let percentComplete = Math.floor((e.loaded / e.total) * 100);
                            progress_bar.css('width', percentComplete + '%');
                            progress_bar.html(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                type: "POST",
                url: "{{ route('importableta.guardar') }}",
                dataType: "json",
                contentType: false,
                processData: false,
                cache: false,
                data: data,
                beforeSend: () => {
                    $('button', form).attr('disabled', true);
                }
            }).done(res => {
                if (res.status === 200) {
                    progress_bar.removeClass('bg-info').addClass('bg-success');
                    progress_bar.html('Listo!');
                    form.trigger('reset');

                    setTimeout(() => {
                        wrapper.fadeOut();
                        progress_bar.removeClass('bg-success bg-danger').addClass('bg-info');
                        progress_bar.css('width', '0%');
                        table_principal.ajax.reload();
                    }, 1500);
                } else {
                    progress_bar.css('width', '100%');
                    progress_bar.html(res.msg);
                    form.trigger('reset');
                    //alert(res.msg);
                }
            }).fail(err => {
                progress_bar.removeClass('bg-success bg-info').addClass('bg-danger');
                //progress_bar.html('Hubo un error!!');
                progress_bar.html('Archivo desconocido');
            }).always(() => {
                $('button', form).attr('disabled', false);
            });
        }

        function geteliminar(id) {
            bootbox.confirm("Seguro desea Eliminar este IMPORTACION?", function(result) {
                if (result === true) {
                    $.ajax({
                        url: "{{ route('importableta.eliminar', '') }}/" + id,
                        type: "GET",
                        dataType: "JSON",
                        beforeSend: function() {
                            $('#eliminar' + id).html(
                                '<span><i class="fa fa-spinner fa-spin"></i></span>');
                        },
                        success: function(data) {
                            $('#modal_form').modal('hide');
                            table_principal.ajax.reload();
                            toastr.success('El registro fue eliminado exitosamente.', 'Mensaje');
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            toastr.error(
                                'No se puede eliminar este registro por seguridad de su base de datos, Contacte al Administrador del Sistema',
                                'Mensaje');
                        }
                    });
                }
            });
        };

        function monitor(importacion) {
            $('#siagie-matricula').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "responsive": false,
                    "autoWidth": false,
                    "ordered": true,
                    "destroy": true,
                    "language": table_language,
                    "ajax": {
                        "url": "{{ route('importableta.listarimportados', '') }}/" + importacion,
                        "type": "GET",
                        "dataType": 'JSON',
                    },
                    "columns": [{
                            data: 'ugel',
                            name: 'ugel'
                        },
                        {
                            data: 'provincia',
                            name: 'provincia'
                        },
                        {
                            data: 'distrito',
                            name: 'distrito'
                        },
                        {
                            data: 'cod_mod',
                            name: 'cod_mod'
                        },
                        {
                            data: 'institucion_educativa',
                            name: 'institucion_educativa'
                        },
                        {
                            data: 'estado',
                            name: 'estado'
                        },
                        {
                            data: 'tabletas_programadas',
                            name: 'tabletas_programadas'
                        },
                        {
                            data: 'cargadores_programadas',
                            name: 'cargadores_programadas'
                        },
                        {
                            data: 'tabletas_chip',
                            name: 'tabletas_chip'
                        },
                        {
                            data: 'tabletas_pecosa',
                            name: 'tabletas_pecosa'
                        },
                        {
                            data: 'cargadores_pecosa',
                            name: 'cargadores_pecosa'
                        },
                        {
                            data: 'tabletas_pecosa_siga',
                            name: 'tabletas_pecosa_siga'
                        },
                        {
                            data: 'cargadores_pecosa_siga',
                            name: 'cargadores_pecosa_siga'
                        },
                        {
                            data: 'tabletas_entregadas_sigema',
                            name: 'tabletas_entregadas_sigema'
                        },
                        {
                            data: 'cargadores_entregadas_sigema',
                            name: 'cargadores_entregadas_sigema'
                        },
                        {
                            data: 'tabletas_recepcionadas',
                            name: 'tabletas_recepcionadas'
                        },
                        {
                            data: 'cargadores_recepcionadas',
                            name: 'cargadores_recepcionadas'
                        },
                        {
                            data: 'tabletas_asignadas',
                            name: 'tabletas_asignadas'
                        },
                        {
                            data: 'tabletas_asignadas_estudiantes',
                            name: 'tabletas_asignadas_estudiantes'
                        },
                        {
                            data: 'tabletas_asignadas_docentes',
                            name: 'tabletas_asignadas_docentes'
                        },
                        {
                            data: 'cargadores_asignadas',
                            name: 'cargadores_asignadas'
                        },
                        {
                            data: 'cargadores_asignadas_estudiantes',
                            name: 'cargadores_asignadas_estudiantes'
                        },
                        {
                            data: 'cargadores_asignadas_docentes',
                            name: 'cargadores_asignadas_docentes'
                        },
                        {
                            data: 'tabletas_devueltas',
                            name: 'tabletas_devueltas'
                        },
                        {
                            data: 'cargadores_devueltos',
                            name: 'cargadores_devueltos'
                        },
                        {
                            data: 'tabletas_perdidas',
                            name: 'tabletas_perdidas'
                        },
                        {
                            data: 'cargadores_perdidos',
                            name: 'cargadores_perdidos'
                        },

                    ],
                }

            );

            $('#modal-siagie-matricula').modal('show');
            $('#modal-siagie-matricula .modal-title').text('Importado');
        }
    </script>
    <script src="{{ asset('/') }}public/assets/libs/jquery-validation/jquery.validate.min.js"></script>
    <!-- Validation init js-->
    <script src="{{ asset('/') }}public/assets/js/pages/form-validation.init.js"></script>

    <script src="{{ asset('/') }}public/assets/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}public/assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('/') }}public/assets/libs/datatables/dataTables.responsive.min.js"></script>
    <script src="{{ asset('/') }}public/assets/libs/datatables/responsive.bootstrap4.min.js"></script>
@endsection
