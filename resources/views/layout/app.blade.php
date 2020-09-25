<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo')</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('plugins/growl/js/jquery.growl.js') }}"></script>
    <script src="{{ asset('plugins/bootbox/bootbox.all.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/dist/jquery.validate.js') }}"></script>
    <script src="{{ asset('plugins/select2-4.0.13/dist/js/select2.full.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/growl/css/jquery.growl.css') }}" rel="stylesheet" />
    <link href="{{ asset('font-awesome/4.5.0/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/select2-4.0.13/dist/css/select2.css') }}" rel="stylesheet" />
</head>

<body class="global">
    <div class="container-fluid">
        <style>
            .select-card:hover {
                -webkit-box-shadow: -1px 9px 25px -12px rgba(0, 0, 0, 0.75);
                -moz-box-shadow: -1px 9px 25px -12px rgba(0, 0, 0, 0.75);
                box-shadow: -1px 9px 25px -12px rgba(0, 0, 0, 0.75);
            }

            .select-card.active {
                -webkit-box-shadow: -1px 9px 25px -12px rgba(0, 0, 0, 0.75);
                -moz-box-shadow: -1px 9px 25px -12px rgba(0, 0, 0, 0.75);
                box-shadow: -1px 9px 25px -12px rgba(0, 0, 0, 0.75);
                margin-top: -1%;
            }
        </style>
        <div class="col-12 mt-3">
            <div class="d-flex justify-content-end mb-2">
                <div class="p-2">
                    <button id="btnConfiguracion" type="button" class="btn btn-secondary btn-sm" data-toggle="tooltipconfig" data-placement="bottom" title="Todas las opciones de configuración del aplicativo se encuentran en esta sección.">
                        <span class="fa fa-cogs"></span> Configuración
                    </button>
                </div>
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="row">
                <div class="col-3">
                    <div class="row mb-4 align-items-center">
                        <div class="col-12">
                            <a href="/editorial" class="text-decoration-none text-reset">
                                <div class="card select-card">
                                    <div class="row no-gutters">
                                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                                            <h1 class="display-4"><span class="fa fa-pencil-square font-s text-secondary"></span></h1>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">Editoriales</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row mb-4 align-items-center">
                        <div class="col-12">
                            <a href="/libro" class="text-decoration-none text-reset">
                                <div class="card select-card">
                                    <div class="row no-gutters">
                                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                                            <h1 class="display-4"><span class="fa fa-book font-s text-secondary"></span></h1>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">Libros</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row mb-4 align-items-center">
                        <div class="col-12">
                            <a href="/autor" class="text-decoration-none text-reset">
                                <div class="card select-card">
                                    <div class="row no-gutters">
                                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                                            <h1 class="display-4"><span class="fa fa-male font-s text-secondary"></span></h1>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">Autores</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    @yield('contenido')
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mdlConfiguracion" tabindex="-1" aria-labelledby="Opciones de Configuración" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <form id="frmDescuentos">
                    <div class="modal-body" style="height: 550px;">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-porcentaje-tab" data-toggle="tab" href="#nav-porcentaje" role="tab" aria-controls="nav-porcentaje" aria-selected="true"><span class="fa fa-percent"></span> Porcentajes de Venta</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-porcentaje" role="tabpanel" aria-labelledby="nav-porcentaje-tab">

                                <div class="col-12">
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-row">
                                                        <div class="col-6">
                                                            <div class="input-group input-group-sm">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">% Descuento</span>
                                                                </div>
                                                                <input id="txtDescuento" name="txtDescuento" type="number" class="form-control" value="0" />
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="input-group input-group-sm">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">% Adicional</span>
                                                                </div>
                                                                <input id="txtAdicional" name="txtAdicional" type="number" class="form-control" value="0" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="card-title text-uppercase">Descuento por Autor</h6>
                                                    <hr />
                                                    <div class="form-row">
                                                        <div class="col-5">
                                                            <div class="input-group input-group-sm">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">% Descuento</span>
                                                                </div>
                                                                <input id="txtDescuentoAutor" name="txtDescuentoAutor" type="number" class="form-control" value="0" require />
                                                            </div>
                                                        </div>
                                                        <div class="col-5">
                                                            <div class="input-group input-group-sm">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Autor</span>
                                                                </div>
                                                                <select name="txtAutor" id="txtAutor" class="custom-select" require>
                                                                    <option selected disabled value="">Seleccionar...</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <button id="btnAgregarDescuentoAutor" type="button" class="btn btn-success btn-sm w-100">Agregar</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-2">
                                                        <table id="tblDescuentoAutor" class="table table-sm table-striped table-bordered dt-responsive">
                                                            <thead>
                                                                <tr>
                                                                    <th>Autor</th>
                                                                    <th>Descuento</th>
                                                                    <th style="width: 50px;"></th>
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
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><span class="fa fa-close"></span> Cancelar</button>
                        <button id="btnGuardarConfiguracion" type="button" class="btn btn-primary btn-sm"><span class="fa fa-save"></span> Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        jQuery.validator.setDefaults({
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        function __ajax(url, data, metodo) {
            var ajax = $.ajax({
                method: metodo,
                url: url,
                data: data
            });
            return ajax;
        }

        var languageDt = {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla =(",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        };

        $(document).ready(function() {
            /*$('.select-card').hover(
                function() {
                    $(this).animate({
                        marginTop: "-=1%",
                    }, 200);
                },

                function() {
                    $(this).animate({
                        marginTop: "0%",
                    }, 200);
                }
            );*/

            var table = $('#tblDescuentoAutor').DataTable({
                "paging": false,
                "bInfo": false,
                "ordering": false,
                "language": languageDt,
                "columnDefs": [{
                    "className": 'delete-control',
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<a class=\"badge badge-danger badge-sm\" style=\"cursor: pointer\">ELIMINAR</a>"
                }]
            });

            $('a').each(function() {
                if ($(this).prop('href') == window.location.href) {
                    $(this).children('.card').addClass('active');
                } else {
                    $(this).children('.card').removeClass('active');
                }
            });

            $('[data-toggle="tooltipconfig"]').tooltip();
            $('#btnConfiguracion').click(function() {
                $('#mdlConfiguracion').modal('show');
            });

            __ajax("/autor/list", null, "GET")
                .done(function(response) {
                    if (response.length > 0) {
                        $.each(response, function(key, value) {
                            var texto = value.aut_nombres.concat(' ', value.aut_apellidos);
                            $("#txtAutor").append('<option value="' + texto + '">' + texto + '</option>');
                        });
                    }
                });

            $('#btnAgregarDescuentoAutor').on('click', function() {
                var formulario = $("#frmDescuentos");
                formulario.validate({
                    ignore: '.ignore',
                    focusInvalid: false,
                    rules: {
                        txtDescuentoAutor: "required",
                        txtAutor: "required"
                    },
                    messages: {
                        txtDescuentoAutor: "Este campo es requerido",
                        txtAutor: "Este campo es requerido"
                    }
                });
                if (formulario.valid()) {
                    var existe = false;
                    table.rows().every(function(rowIdx, tableLoop, rowLoop) {
                        var data = this.data();
                        if (data[0] == $('#txtAutor').val()) {
                            existe = true;
                        }
                    });
                    if (existe) {
                        $.growl.warning({
                            duration: 3000,
                            title: '<strong><span class="fa fa-exclamation"></span> ADVERTENCIA</strong>',
                            message: 'El autor seleccionado ya está agregado.',
                            size: 'medium'
                        });
                    } else {
                        table.row.add([
                            $('#txtAutor').val(),
                            $('#txtDescuentoAutor').val()
                        ]).draw(false);
                        $('#txtAutor').val("");
                        $('#txtDescuentoAutor').val("0");
                    }
                }
            });

            $('#tblDescuentoAutor tbody').on('click', 'td.delete-control a', function() {
                table.row($(this).parents('tr')).remove().draw();
            });

            $('#btnGuardarConfiguracion').click(function() {
                var lista = [];
                $.each(table.rows().data(), function(index, valor) {
                    lista.push({
                        autor: valor[0],
                        descuento: valor[1]
                    });
                });
                var data = {
                    descuento: $('#txtDescuento').val(),
                    adicional: $('#txtAdicional').val(),
                    descuentoAutor: lista,
                    _token: '{{csrf_token()}}'
                };
                __ajax("/configuracion/save", data, "POST")
                    .done(function(response) {
                        $('#mdlConfiguracion').modal('hide');
                        if (response.success) {
                            console.log(response);
                            $.growl.notice({
                                duration: 3000,
                                title: '<strong><span class="fa fa-info-circle"></span> INFO</strong>',
                                message: response.mensaje,
                                size: 'medium'
                            });
                        } else {
                            $.growl.error({
                                duration: 3000,
                                title: '<strong><span class="fa fa-exclamation"></span> ERROR</strong>',
                                message: response.mensaje,
                                size: 'medium'
                            });
                        }
                    });
            });
        });
    </script>
    @yield('script')
</body>

</html>