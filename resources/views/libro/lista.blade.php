@extends('layout.app')

@section('titulo')
Libros
@endsection

@section('contenido')
<div class="card">
    <div class="card-body">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">
                Libros
            </legend>
            <div class="d-flex justify-content-between mb-2">
                <div class="p-2">
                    <form class="form-inline">
                        <div class="form-group">
                            <label for="busquedaNombre">Buscar: </label>
                            <input type="text" class="form-control form-control-sm mx-sm-3" id="busquedaTitulo" placeholder="Título" />
                        </div>
                    </form>
                </div>
                <div class="p-2">
                    <button id="btnNuevo" class="btn btn-success rounded-circle"><span class="fa fa-plus"></span></button>
                    <button id="btnEditar" class="btn btn-info btn-sm rounded-circle"><span class="fa fa-pencil"></span></button>
                    <button id="btnEliminar" class="btn btn-danger btn-sm rounded-circle"><span class="fa fa-trash"></span></button>
                    <button id="btnVenta" class="btn btn-secondary btn-sm rounded-pill"><span class="fa fa-money"></span> Venta</button>
                </div>
            </div>
            <table id="tblLibro" class="table table-sm table-striped table-bordered table-hover dt-responsive">
                <thead>
                    <tr>
                        <!--<th style="width: 5%"></th>-->
                        <th>Título</th>
                        <th>ISBN</th>
                        <th>Año</th>
                        <th>Editorial</th>
                        <th>Precio</th>
                        <th>Estado Registro</th>
                    </tr>
                </thead>
            </table>
        </fieldset>
    </div>
</div>

<div class="modal fade" id="mdlEditarNuevo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="frmLibro">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="h5Titulo">Titulo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="hiddenId" name="hiddenId" type="hidden">
                    <div class="form-row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="libTitulo">Título</label>
                                <input name="libTitulo" id="libTitulo" type="text" class="form-control form-control-sm" aria-label="Input nombre" aria-describedby="inputGroup-sizing-sm" autocomplete="off" require />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="libIsbn">ISBN</label>
                                <input name="libIsbn" id="libIsbn" type="text" class="form-control form-control-sm" aria-label="Input isbn" aria-describedby="inputGroup-sizing-sm" autocomplete="off" require />
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="libAnioPublicacion">Año de Publicación</label>
                                <input name="libAnioPublicacion" id="libAnioPublicacion" type="text" class="form-control form-control-sm" aria-label="Input año publicación" aria-describedby="inputGroup-sizing-sm" autocomplete="off" require />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="libEdiId">Editorial</label>
                                <select name="libEdiId" id="libEdiId" class="custom-select custom-select-sm" require>
                                    <option selected disabled value="">Seleccionar...</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="autId">Autores</label></br>
                                <select name="autId[]" id="autId" multiple="multiple" style="width: 100%;">
                                    <option disabled value="">Seleccionar...</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><span class="fa fa-close"></span> Cancelar</button>
                    <button id="btnGrabar" type="button" class="btn btn-primary btn-sm"><span class="fa fa-save"></span> Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="mdlVenta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="frmLibroVenta">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Venta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="hiddenIdVenta" name="hiddenIdVenta" type="hidden">
                    <div class="form-row">
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="chkVenta" name="chkVenta">
                                <label class="form-check-label" for="chkVenta">
                                    Vender
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input name="libPrecio" id="libPrecio" type="text" class="form-control form-control-sm" aria-label="Input precio" aria-describedby="inputGroup-sizing-sm" autocomplete="off" require />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><span class="fa fa-close"></span> Cancelar</button>
                    <button id="btnGrabarVenta" type="button" class="btn btn-primary btn-sm"><span class="fa fa-save"></span> Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var table = loadDataTable();
    $(document).ready(function() {
        __ajax("/editorial/list", null, "GET")
            .done(function(response) {
                $.each(response, function(key, value) {
                    $("#libEdiId").append('<option value=' + value.edi_id + '>' + value.edi_nombre + '</option>');
                });
            });
        __ajax("/autor/list", null, "GET")
            .done(function(response) {
                var data = [];
                if (response.length > 0) {
                    $.each(response, function(index, item) {
                        data.push({
                            id: item.aut_id,
                            text: item.aut_nombres + " " + item.aut_apellidos
                        });
                    });
                }
                $('#autId').select2({
                    theme: 'bootstrap4',
                    data: data
                });
            });
    });

    function loadDataTable() {
        /* 
            - DETALLE DESPLEGABLE (AGREGAR AL ARRAY DE COLUMNS DEL DATA TABLE)
            {
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
        */
        var table = $('#tblLibro').DataTable({
            "ajax": {
                "url": "/libro/list",
                "type": "GET",
                "dataSrc": ''
            },
            "columns": [{
                    "className": 'rowSearch',
                    "data": "lib_titulo"
                },
                {
                    "className": 'rowSearch',
                    "data": "lib_isbn"
                },
                {
                    "className": 'rowSearch',
                    "width": '5%',
                    "data": "lib_anio_publicacion"
                },
                {
                    "className": 'rowSearch',
                    "data": "edi_nombre"
                },
                {
                    "className": 'rowSearch',
                    "width": '15%',
                    "data": "lib_precio",
                    "render": function(data, type, row) {
                        return '<div align="center">' + (data != null ? '<span class="badge badge-primary">' + data + '</span>' : '<span class="badge badge-light">SIN PRECIO</span>') + '</div>';
                    }
                },
                {
                    "className": 'rowSearch',
                    "width": '15%',
                    "data": "lib_estado_registro",
                    "render": function(data, type, row) {
                        return '<div align="center">' + (data == 1 ? '<span class="badge badge-success">ACTIVO</span>' : '<span class="badge badge-secondary">INACTIVO</span>') + '</div>';
                    }
                }
            ],
            "order": [
                [0, 'asc']
            ],
            "searching": true,
            "language": languageDt
        });
        eventosDataTable();
        return table;
    }

    function disabledButtonsEditDelete(value) {
        $('#btnEditar').prop('disabled', value);
        $('#btnEliminar').prop('disabled', value);
        $('#btnVenta').prop('disabled', value);
    }

    function eventosDataTable() {
        disabledButtonsEditDelete(true);

        $('#busquedaTitulo').on('keyup', function() {
            table.$('tr.selected').removeClass('selected');
            disabledButtonsEditDelete(true);
            table
                .columns(0)
                .search(this.value)
                .draw();
        });

        $('#tblLibro tbody').on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                disabledButtonsEditDelete(true);
            } else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                disabledButtonsEditDelete(false);
            }
        });

        $('#btnNuevo').click(function() {
            table.$('tr.selected').removeClass('selected');
            disabledButtonsEditDelete(true);
            $('#h5Titulo').text("Nuevo Libro");
            $('#hiddenId').val("");
            $('#libTitulo').val("");
            $('#libIsbn').val("");
            $('#libAnioPublicacion').val("");
            $('#libEdiId').val("");
            $('#mdlEditarNuevo').modal('show');
            $("#autId").val([]).trigger("change");
        });
        $('#btnEditar').click(function() {
            $('#h5Titulo').text("Editar Libro");
            $('#hiddenId').val(table.row('.selected').data().lib_id);
            $('#libTitulo').val(table.row('.selected').data().lib_titulo);
            $('#libIsbn').val(table.row('.selected').data().lib_isbn);
            $('#libAnioPublicacion').val(table.row('.selected').data().lib_anio_publicacion);
            $('#libEdiId').val(table.row('.selected').data().lib_edi_id);
            $('#mdlEditarNuevo').modal('show');
            var url = "/autores/" + $('#hiddenId').val();
            __ajax(url, null, "GET")
                .done(function(response) {
                    var data = [];
                    if (response.length > 0) {
                        $.each(response, function(index, item) {
                            data.push(item.aut_id);
                        });
                    }
                    $("#autId").val(Object.values(data)).trigger("change");
                });
        });
        $('#btnEliminar').click(function() {
            var mensaje = "¿Está seguro de eliminar este registro?";
            bootbox.confirm({
                size: "small",
                closeButton: false,
                message: mensaje,
                callback: function(result) {
                    if (result) {
                        //Eliminar
                        __ajax("/libro/delete", {
                                lib_id: table.row('.selected').data().lib_id,
                                _token: '{{csrf_token()}}'
                            }, "POST")
                            .done(function(response) {
                                if (response.success) {
                                    table.ajax.reload();
                                    disabledButtonsEditDelete(true);
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
                    }
                },
                className: "bootbox-sm"
            });
        });

        $('#btnVenta').click(function() {
            if (table.row('.selected').data().lib_precio != null) {
                $('#chkVenta').prop('checked', true);
                $('#libPrecio').val(table.row('.selected').data().lib_precio);
                $('#libPrecio').prop('disabled', false);
            } else {
                $('#chkVenta').prop('checked', false);
                $('#libPrecio').val("");
                $('#libPrecio').prop('disabled', true);
            }
            $('#hiddenIdVenta').val(table.row('.selected').data().lib_id);
            $('#mdlVenta').modal('show');
        });

        $('#chkVenta').change(function() {
            if ($(this).is(':checked')) {
                $('#libPrecio').prop('disabled', false);
            } else {
                $('#libPrecio').prop('disabled', true);
            }
        });

        $('#btnGrabar').click(function() {
            var formulario = $("#frmLibro");
            formulario.validate({
                ignore: '.ignore',
                focusInvalid: false,
                rules: {
                    libTitulo: "required",
                    libIsbn: "required",
                    libAnioPublicacion: "required",
                    libEdiId: "required"
                },
                messages: {
                    libTitulo: "Este campo es requerido",
                    libIsbn: "Este campo es requerido",
                    libAnioPublicacion: "Este campo es requerido",
                    libEdiId: "Este campo es requerido"
                }
            });
            if (formulario.valid()) {
                __ajax("/libro/save", formulario.serialize(), "POST")
                    .done(function(response) {
                        $('#mdlEditarNuevo').modal('hide');
                        if (response.success) {
                            table.ajax.reload();
                            disabledButtonsEditDelete(true);
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
            }
        });

        $('#btnGrabarVenta').click(function() {
            var formulario = $("#frmLibroVenta").serialize();
            if (!($('#chkVenta').is(':checked'))) {
                formulario += "&chkVenta=off";
            }
            __ajax("/libro/venta", formulario, "POST")
                .done(function(response) {
                    $('#mdlVenta').modal('hide');
                    if (response.success) {
                        table.ajax.reload();
                        disabledButtonsEditDelete(true);
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
    }
</script>
@endsection