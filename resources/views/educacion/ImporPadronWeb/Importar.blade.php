@extends('layouts.main', ['titlePage' => 'IMPORTAR DATOS - PADRON WEB DE INSTITUCIONES EDUCATIVAS'])
@section('css')
    <!-- Table datatable css -->
    <link href="{{ asset('/') }}public/assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"> --}}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-border">
                <div class="card-header border-success-0 bg-transparent pb-0">
                    <div class="card-widgets">
                        <button type="button" class="btn btn-success btn-xs waves-effect waves-light" data-toggle="modal"
                            data-target=".bs-example-modal-lg" data-backdrop="static" data-keyboard="false"><i
                                class="ion ion-md-cloud-upload"></i> Importar</button>
                    </div>
                    <h3 class="card-title">HISTORIAL DE IMPORTACION </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="font-size: 12px">
                                    <thead class="text-white bg-success-0">
                                        <tr>
                                            <th>N°</th>
                                            <th>Fecha Version</th>
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
            </div>
        </div>
    </div>


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
                            {{-- width:7200px; --}}
                            <thead class="text-primary">
                                <th>COD_MOD</th>
                                <th>COD_LOCAL</th>
                                <th>INSTITUCION_EDUCATIVA</th>
                                <th>COD_NIVELMOD</th>
                                <th>NIVEL_MODALIDAD</th>
                                <th>MODALIDAD</th>
                                <th>FORMA</th>
                                <th>COD_CAR</th>
                                <th>CARACTERISTICA</th>
                                <th>COD_GENERO</th>
                                <th>GENERO</th>
                                <th>COD_GEST</th>
                                <th>GESTION</th>
                                <th>COD_GES_DEP</th>
                                <th>GESTION_DEPENDENCIA</th>
                                <th>DIRECTOR</th>
                                <th>TELEFONO</th>
                                <th>EMAIL</th>
                                <th>DIRECCION_CENTRO_EDUCATIVO</th>
                                <th>LOCALIDAD</th>
                                <th>CODCP_INEI</th>
                                <th>COD_CCPP</th>
                                <th>CENTRO_POBLADO</th>
                                <th>COD_AREA</th>
                                <th>AREA_GEOGRAFICA</th>
                                <th>CODGEO</th>
                                <th>PROVINCIA</th>
                                <th>DISTRITO</th>
                                <th>CODOOII</th>
                                <th>UGEL</th>
                                <th>NLAT_IE</th>
                                <th>NLONG_IE</th>
                                <th>COD_TUR</th>
                                <th>TURNO</th>
                                <th>COD_ESTADO</th>
                                <th>ESTADO</th>
                                <th>TALUM_HOM</th>
                                <th>TALUM_MUJ</th>
                                <th>TALUMNO</th>
                                <th>TDOCENTE</th>
                                <th>TSECCION</th>
                                <th>FECHA_REGISTRO</th>
                                <th>FECHA_ACT</th>

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

    <!--  Modal content for the above example -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Importar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form class="cmxform form-horizontal tasi-form upload_file">
                                @csrf
                                <input type="hidden" id="ccomment" name="comentario" value="">
                                <div class="form-group">
                                    <div class="">
                                        <label class="col-form-label">Fuente de datos</label>
                                        <div class="">
                                            <input type="text" class="form-control btn-xs" readonly="readonly"
                                                value="ESCALE">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label class="col-form-label">Fecha Versión</label>
                                        <div class="">
                                            <input type="date" class="form-control btn-xs" name="fechaActualizacion"
                                                placeholder="Ingrese fecha actualizacion" autofocus required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
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
                                    <div class="col-lg-12 text-center">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit"><i
                                                class="ion ion-md-cloud-upload"></i> Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
@endsection

@section('js')
    <script>
        var table_principal = '';
        $(document).ready(function() {
            $('.upload_file').on('submit', upload);

            table_principal = $('#datatable').DataTable({
                responsive: true,
                autoWidth: false,
                order: true,
                language: table_language,
                ajax: "{{ route('ImporPadronWeb.listar.importados') }}",
                type: "POST",
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
                url: "{{ route('ImporPadronWeb.guardar') }}",
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
                        url: "{{ route('ImporPadronWeb.eliminar', '') }}/" + id,
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
                    "headers": {
                        'X-CSRF-TOKEN': $('input[name=_token]').val()
                    },
                    "url": "{{ route('ImporPadronWeb.listarimportados', '') }}/" + importacion,
                    "type": "POST",
                    "dataType": 'JSON',
                },
                "columns": [{
                        data: 'cod_Mod',
                        name: 'cod_Mod'
                    },
                    {
                        data: 'cod_Local',
                        name: 'cod_Local'
                    },
                    {
                        data: 'cen_Edu',
                        name: 'cen_Edu'
                    },
                    {
                        data: 'niv_Mod',
                        name: 'niv_Mod'
                    },
                    {
                        data: 'd_Niv_Mod',
                        name: 'd_Niv_Mod'
                    },
                    {
                        data: 'modalidad',
                        name: 'modalidad'
                    },
                    {
                        data: 'd_Forma',
                        name: 'd_Forma'
                    },
                    {
                        data: 'cod_Car',
                        name: 'cod_Car'
                    },
                    {
                        data: 'd_Cod_Car',
                        name: 'd_Cod_Car'
                    },
                    {
                        data: 'TipsSexo',
                        name: 'TipsSexo'
                    },
                    {
                        data: 'd_TipsSexo',
                        name: 'd_TipsSexo'
                    },
                    {
                        data: 'gestion',
                        name: 'gestion'
                    },
                    {
                        data: 'd_Gestion',
                        name: 'd_Gestion'
                    },
                    {
                        data: 'ges_Dep',
                        name: 'ges_Dep'
                    },
                    {
                        data: 'd_Ges_Dep',
                        name: 'd_Ges_Dep'
                    },
                    {
                        data: 'director',
                        name: 'director'
                    },
                    {
                        data: 'telefono',
                        name: 'telefono'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'dir_Cen',
                        name: 'dir_Cen'
                    },
                    {
                        data: 'localidad',
                        name: 'localidad'
                    },
                    {
                        data: 'codcp_Inei',
                        name: 'codcp_Inei'
                    },
                    {
                        data: 'codccpp',
                        name: 'codccpp'
                    },
                    {
                        data: 'cen_Pob',
                        name: 'cen_Pob'
                    },
                    {
                        data: 'area_Censo',
                        name: 'area_Censo'
                    },
                    {
                        data: 'd_areaCenso',
                        name: 'd_areaCenso'
                    },
                    {
                        data: 'codGeo',
                        name: 'codGeo'
                    },
                    {
                        data: 'd_Prov',
                        name: 'd_Prov'
                    },
                    {
                        data: 'd_Dist',
                        name: 'd_Dist'
                    },
                    {
                        data: 'codOOII',
                        name: 'codOOII'
                    },
                    {
                        data: 'd_DreUgel',
                        name: 'd_DreUgel'
                    },
                    {
                        data: 'nLat_IE',
                        name: 'nLat_IE'
                    },
                    {
                        data: 'nLong_IE',
                        name: 'nLong_IE'
                    },
                    {
                        data: 'cod_Tur',
                        name: 'cod_Tur'
                    },
                    {
                        data: 'D_Cod_Tur',
                        name: 'D_Cod_Tur'
                    },
                    {
                        data: 'estado',
                        name: 'estado'
                    },
                    {
                        data: 'd_Estado',
                        name: 'd_Estado'
                    },
                    {
                        data: 'tAlum_Hom',
                        name: 'tAlum_Hom'
                    },
                    {
                        data: 'tAlum_Muj',
                        name: 'tAlum_Muj'
                    },
                    {
                        data: 'tAlumno',
                        name: 'tAlumno'
                    },
                    {
                        data: 'tDocente',
                        name: 'tDocente'
                    },
                    {
                        data: 'tSeccion',
                        name: 'tSeccion'
                    },
                    {
                        data: 'fechaReg',
                        name: 'fechaReg'
                    },
                    {
                        data: 'fecha_Act',
                        name: 'fecha_Act'
                    },
                ],
            });

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
