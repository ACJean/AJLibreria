@extends('layout.app')

@section('titulo')
    Editoriales
@endsection

@section('contenido')
<div class="card">
    <div class="card-body">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">
                Editoriales
            </legend>
            <div class="d-flex justify-content-between mb-2">
                <div class="p-2">
                    <form class="form-inline">
                        <div class="form-group">
                            <label for="busquedaNombre">Buscar: </label>
                            <input type="text" class="form-control form-control-sm mx-sm-3" id="busquedaNombre" placeholder="Nombre" />
                        </div>
                    </form>
                </div>
                <div class="p-2">
                    <button id="btnNuevo" class="btn btn-success rounded-circle"><span class="fa fa-plus"></span></button>
                    <button id="btnEditar" class="btn btn-info btn-sm rounded-circle"><span class="fa fa-pencil"></span></button>
                    <button id="btnEliminar" class="btn btn-danger btn-sm rounded-circle"><span class="fa fa-trash"></span></button>
                </div>
            </div>
            <table id="tblEditorial" class="table table-sm table-striped table-bordered table-hover dt-responsive">
                <thead>
                    <tr>
                        <!--<th style="width: 5%"></th>-->
                        <th>Nombre</th>
                        <th>Estado Registro</th>
                    </tr>
                </thead>
            </table>
        </fieldset>
    </div>
</div>

<div class="modal fade" id="mdlEditarNuevo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="frmEditorial">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="h5Titulo">Titulo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="hiddenId" name="hiddenId" type="hidden">
                    <div class="form-group">
                        <label for="ediNombre">Nombre</label>
                        <input name="ediNombre" id="ediNombre" type="text" class="form-control form-control-sm" aria-label="Input nombre" aria-describedby="inputGroup-sizing-sm" autocomplete="off" require />
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
@endsection

@section('script')
<script>
    var table = loadDataTable();

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
        var table = $('#tblEditorial').DataTable({
            "ajax": {
                "url": "/editorial/list",
                "type": "GET",
                "dataSrc": ''
            },
            "columns": [{
                    "className": 'rowSearch',
                    "data": "edi_nombre"
                },
                {
                    "className": 'rowSearch',
                    "width": '15%',
                    "data": "edi_estado_registro",
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
    }

    function eventosDataTable() {
        disabledButtonsEditDelete(true);

        $('#busquedaNombre').on('keyup', function() {
            table.$('tr.selected').removeClass('selected');
            disabledButtonsEditDelete(true);
            table
                .columns(0)
                .search(this.value)
                .draw();
        });

        $('#tblEditorial tbody').on('click', 'tr', function() {
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
            $('#h5Titulo').text("Nueva Editorial");
            $('#hiddenId').val("");
            $('#ediNombre').val("");
            $('#mdlEditarNuevo').modal('show');
        });
        $('#btnEditar').click(function() {
            $('#h5Titulo').text("Editar Editorial");
            $('#hiddenId').val(table.row('.selected').data().edi_id);
            $('#ediNombre').val(table.row('.selected').data().edi_nombre);
            $('#mdlEditarNuevo').modal('show');
        });
        $('#btnEliminar').click(function() {
            var mensaje = "¿Está seguro de eliminar este registro?";
            console.log(table.rows({ selected: true }).data());
            bootbox.confirm({
                size: "small",
                closeButton: false,
                message: mensaje,
                callback: function(result) {
                    if (result) {
                        //Eliminar
                        __ajax("/editorial/delete", {
                                edi_id: table.row('.selected').data().edi_id,
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

        $('#btnGrabar').click(function() {
            var formulario = $("#frmEditorial");
            formulario.validate({
                ignore: '.ignore',
                focusInvalid: false,
                rules: {
                    ediNombre: "required"
                },
                messages: {
                    ediNombre: "Este campo es requerido"
                }
            });
            if (formulario.valid()) {
                __ajax("/editorial/save", formulario.serialize(), "POST")
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
    }
</script>
@endsection