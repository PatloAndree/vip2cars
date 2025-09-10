<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Importamos estilos de librerias -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.34.1/tabler-icons.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css" rel="stylesheet">

</head>

<body>
    
    <div class="container mt-5">
        <div class="d-flex justify-content-between  align-items-center mb-3">
            <h1 class="text-center mb-4">VIP 2 CARS</h1>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">Cerrar sesión</button>
            </form>
        </div>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card p-2 border-0">
                     
                    <div class="row">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs mb-3" id="dashboardTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="usuarios-tab" data-bs-toggle="tab" data-bs-target="#usuarios" type="button" role="tab" aria-controls="usuarios" aria-selected="true">
                                    Usuarios
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="vehiculos-tab" data-bs-toggle="tab" data-bs-target="#vehiculos" type="button" role="tab" aria-controls="vehiculos" aria-selected="false">
                                    Vehículos
                                </button>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- usurios -->
                            <div class="tab-pane fade show active" id="usuarios" role="tabpanel" aria-labelledby="usuarios-tab">
                                <!-- Aquí puedes poner el formulario de registro de usuario -->
                                <div class="mb-3 text-end">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#userModal">Nuevo usuario +</button>
                                </div>  
                                <div class="table-responsive mt-3">
                                    <table id="userTable" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Apellio</th>
                                                <th>Dni</th>
                                                <th>Correo</th>
                                                <th>Telefono</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- vehiculos -->
                            <div class="tab-pane fade" id="vehiculos" role="tabpanel" aria-labelledby="vehiculos-tab">
                                <div class="mb-3 text-end">
                                    <button type="button" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#VehicleModal">Nuevo vehiculo +</button>
                                </div>  
                                <div class="table-responsive mt-3">
                                    <table id="vehicleTable" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Cliente</th>
                                                <th>Dni</th>
                                                <th>Placa</th>
                                                <th>Marca</th>
                                                <th>Modelo</th>
                                                <th>Año</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

     <!-- Modal Usuario-->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Registrar/Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span class="text-muted mb-2">Por favor completar todos los campos(*)</span>
                
                <form id="userForm" >
                <input type="text" name="user_edit" value="" id="user_edit" hidden>

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre (*)</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="lastname" class="form-label">Apellido (*)</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico (*)</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="documento" class="form-label">Documento (*)</label>
                    <input type="number" class="form-control" id="documento" name="documento" required>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono (*)</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" required>
                </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" id="sendUsuario" class="btn btn-primary">Guardar </button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal Vehiculo-->
    <div class="modal fade" id="VehicleModal" tabindex="-1" aria-labelledby="createVehicleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <form id="vehicleForm">
                @csrf

                <div class="modal-header">
                <h5 class="modal-title" id="createVehicleModalLabel">Crear/Editar Vehículo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body">
                    <span class="text-muted mb-2">Por favor completar todos los campos(*)</span>
                    <input type="text" name="vehicle_id" id="vehicle_id" hidden>
                    

                     <div class="mb-3">
                        <label for="user_id" class="form-label">Selecciona cliente (*)</label>

                        <select name="user_id" id="user_id" class="form-select" required="required">
                            <option value="">Selecciona cliente</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="placa" class="form-label">Placa (*)</label>
                        <input type="text" class="form-control" id="placa" name="placa" required>
                    </div>
                    <div class="mb-3">
                        <label for="marca" class="form-label">Marca (*)</label>
                        <input type="text" class="form-control" id="marca" name="marca" required>
                    </div>
                    <div class="mb-3">
                        <label for="modelo" class="form-label">Modelo (*)</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" required>
                    </div>
                    <div class="mb-3">
                        <label for="añofabricacion" class="form-label">Año de Fabricación (*)</label>
                        <input type="date" class="form-control" id="añofabricacion" name="añofabricacion" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono opcional (*)</label>
                        <input type="tel" class="form-control" id="telefonoOpcional" name="telefonoOpcional" required>
                    </div>
                    </div>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="sendVehicle" class="btn btn-primary">Guardar</button>
                </div>
            </form>
            </div>
        </div>
    </div>


    <!-- LIBRERIAS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.all.min.js"></script>
    
</body>
</html>


<script>

    let tableUser;
    let tableVehicle;

    document.addEventListener("DOMContentLoaded", function () {

        cargarUsuariosActivos();
       
        tableUser = new DataTable('#userTable', {
            // Configuración de DataTable
            ajax: {
                url: "{{ route('users.list') }}",
                dataSrc: function(json) {
                    if (!json.data) {
                        json.data = []; // Si no hay data, asegúrate de devolver un array vacío
                    }
                    return json.data;
                }
            },
            dom: '<"card-header d-flex border-top rounded-0 flex-wrap py-0 flex-column flex-md-row align-items-start"<"me-5 ms-n4 pe-5 mb-n6 mb-md-0"f><"d-flex justify-content-start justify-content-md-end align-items-baseline"<"dt-action-buttons d-flex flex-column align-items-start align-items-sm-center justify-content-sm-center pt-0 gap-sm-4 gap-sm-0 flex-sm-row"lB>>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.1.7/i18n/es-ES.json'
            },
            columns: [{
                    data: 'name'
                },
                {
                    data: 'lastname'
                },
                {
                    data: 'documento'
                },
                {
                    data: 'email'
                },
                {
                    data: 'telefono'
                },
                
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                                <button class="btn btn-sm btn-text-warning rounded-pill btn-icon" onclick="editUser(${row.id})" title="Editar">
                                    <i class="ti ti-pencil ti-md"></i>
                                </button>
                                <button class="btn btn-sm btn-text-warning rounded-pill btn-icon" onclick="deleteUser(${row.id})" title="Eliminar">
                                    <i class="ti ti-trash ti-md"></i>
                                </button>
                            `;
                    }
                }
            ],
            buttons: [{
                text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Nuevo Usuario</span>',
                className: "add-new btn btn-primary ms-2 ms-sm-0 waves-effect waves-light",
                action: function() {
                    $("#id").val(0);
                    $("#divDatosPagos").find('input, select').each(function() {
                        $(this).attr('required', 'required');
                        const fieldName = $(this).attr('name');
                        fv.addField(fieldName);
                    });
                    $("#createUserModal").modal('show');
                }
            }],
            processing: true,
            error: function(xhr, error, thrown) {
                console.error('Error en la carga de datos:', error, thrown);
            }
        });

        tableVehicle = new DataTable('#vehicleTable', {
                // Configuración de DataTable
            ajax: {
                url: "{{ route('vehicles.list') }}",
                dataSrc: function(json) {
                    if (!json.data) {
                        json.data = []; // Si no hay data, asegúrate de devolver un array vacío
                    }
                    return json.data;
                }
            },
            dom: '<"card-header d-flex border-top rounded-0 flex-wrap py-0 flex-column flex-md-row align-items-start"<"me-5 ms-n4 pe-5 mb-n6 mb-md-0"f><"d-flex justify-content-start justify-content-md-end align-items-baseline"<"dt-action-buttons d-flex flex-column align-items-start align-items-sm-center justify-content-sm-center pt-0 gap-sm-4 gap-sm-0 flex-sm-row"lB>>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.1.7/i18n/es-ES.json'
            },
            columns: [
                {
                    data: null,
                    render: function(data, type, row) {
                        return `${row.usuario.name} ${row.usuario.lastname}`;
                    },
                },
                {
                    data: 'usuario.documento'
                },
                {
                    data: 'placa'
                },
                {
                    data: 'marca'
                },
                {
                    data: 'modelo'
                },
                {
                    data: 'añofabricacion'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                                <button class="btn btn-sm btn-text-warning rounded-pill btn-icon" onclick="editVehicle(${row.id})" title="Editar">
                                    <i class="ti ti-pencil ti-md"></i>
                                </button>
                                <button class="btn btn-sm btn-text-warning rounded-pill btn-icon" onclick="deleteVehicle(${row.id})" title="Eliminar">
                                    <i class="ti ti-trash ti-md"></i>
                                </button>
                            `;
                    }
                }
            ],
            buttons: [{
                text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Nuevo Usuario</span>',
                className: "add-new btn btn-primary ms-2 ms-sm-0 waves-effect waves-light",
                action: function() {
                    $("#id").val(0);
                    $("#divDatosPagos").find('input, select').each(function() {
                        $(this).attr('required', 'required');
                        const fieldName = $(this).attr('name');
                        fv.addField(fieldName);
                    });
                    $("#createUserModal").modal('show');
                }
            }],
            processing: true,
            error: function(xhr, error, thrown) {
                console.error('Error en la carga de datos:', error, thrown);
            }
        });

        document.getElementById('sendUsuario').addEventListener('click', async function() {
            const form = document.getElementById("userForm");
            const formData = new FormData(form);
            let url = "{{ route('users.store') }}";

            fetch(url, {
                method: "POST",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirigir o mostrar mensaje
                    $("#userModal").modal('hide');
                     tableUser.ajax.reload();
                     cargarUsuariosActivos();
                } else {
                    // Mostrar errores
                    alert(data.message || "Error al iniciar sesión");
                }
            })
            .catch(error => {
                console.error("Error en el envío AJAX:", error);
                alert("Ocurrió un error inesperado.");
            });
        });

        document.getElementById('sendVehicle').addEventListener('click', async function() {

            const form = document.getElementById("vehicleForm");

            const formData = new FormData(form);
            let url = "{{ route('vehicles.store') }}";

            fetch(url, {
                method: "POST",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirigir o mostrar mensaje
                    $("#VehicleModal").modal('hide');
                    tableVehicle.ajax.reload();
                } else {
                    // Mostrar errores
                    alert(data.message || "Error al iniciar sesión");
                }
            })
            .catch(error => {
                console.error("Error en el envío AJAX:", error);
                alert("Ocurrió un error inesperado.");
            });

           
            
        });
        
    });

    function cargarUsuariosActivos() {
        fetch("{{ route('usuarios.activos') }}")
            .then(response => response.json())
            .then(usuarios => {
                const select = document.getElementById('user_id');
                select.innerHTML = '<option value="">Selecciona cliente</option>';
                usuarios.forEach(usuario => {
                    select.innerHTML += `<option value="${usuario.id}">Dni: ${usuario.documento} - ${usuario.name} ${usuario.lastname}</option>`;
                });
            });
    }

    $('#userModal').on('hidden.bs.modal', function() {
        document.getElementById('userForm').reset();
    });

    $('#VehicleModal').on('hidden.bs.modal', function() {
        document.getElementById('vehicleForm').reset();
    });
    
    function editUser(id) {
        let url = `{{ route('user.edit', ':id') }}`;
        url = url.replace(':id', id);
        fetch(url)
            .then(response => response.json())
            .then(data => {
                
                $('#user_edit').val(data.usuario.id);
                $('#name').val(data.usuario.name);
                $('#lastname').val(data.usuario.lastname);
                $('#email').val(data.usuario.email);
                $('#documento').val(data.usuario.documento);
                $('#telefono').val(data.usuario.telefono);

                $('#userModal').modal('show');
            })
            .catch(error => {
                console.error('Error al obtener los datos del usuario:', error);
                alert('Ocurrió un error al obtener los datos del usuario.');
            });
    }
    
    function editVehicle(id) {
        let url = `{{ route('vehicle.edit', ':id') }}`;
        url = url.replace(':id', id);
        fetch(url)
            .then(response => response.json())
            .then(data => {
                const v = data.vehiculo;
                $('#vehicle_id').val(v.id);
                $('#user_id').val(v.user_id);
                $('#placa').val(v.placa);
                $('#marca').val(v.marca);
                $('#modelo').val(v.modelo);
                $('#añofabricacion').val(v.añofabricacion);
                $('#telefonoOpcional').val(v.telefono);
                $('#VehicleModal').modal('show');
            })
            .catch(error => {
                console.error('Error al obtener los datos del usuario:', error);
                alert('Ocurrió un error al obtener los datos del usuario.');
            });
    }

    function deleteUser(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡Esta acción desactivará el usuario!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                let url = `{{ route('user.delete', ':id') }}`;
                url = url.replace(':id', id);
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Eliminado',
                                text: 'El usuario ha sido desactivado.',
                                icon: 'success',
                                timer: 1000,
                                showConfirmButton: false
                            });
                            tableUser.ajax.reload();
                            cargarUsuariosActivos();
                        } else {
                            Swal.fire('Error', 'No se pudo eliminar el usuario.', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error al obtener los datos del usuario:', error);
                        Swal.fire('Error', 'Ocurrió un error al obtener los datos del usuario.', 'error');
                    });
            }
        });
    }
    
    function deleteVehicle(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡Esta acción desactivará el vehiculo!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                let url = `{{ route('vehicle.delete', ':id') }}`;
                url = url.replace(':id', id);
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Eliminado',
                                text: 'El vehiculo ha sido desactivado.',
                                icon: 'success',
                                timer: 1000,
                                showConfirmButton: false
                            });
                            tableVehicle.ajax.reload();
                        } else {
                            Swal.fire('Error', 'No se pudo eliminar el vehiculo.', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error al obtener los datos del vehiculo:', error);
                        Swal.fire('Error', 'Ocurrió un error al obtener los datos del vehiculo.', 'error');
                    });
            }
        });
    }

</script>

