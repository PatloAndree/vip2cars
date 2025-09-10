<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.34.1/tabler-icons.min.css" rel="stylesheet">

</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">VIP 2 CARS </h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <form id="loginForm" class="card p-4">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico:</label>
                        <input type="email" id="email" name="email" value="" class="form-control" required autofocus>
                    </div>

                    <div class="mb-3 form-password-toggle">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password" placeholder="*******" required="">
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="button" class="btn btn-primary" id="sendLogin">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleIcon = document.querySelector(".input-group-text i");
        const passwordInput = document.getElementById("password");

        toggleIcon.addEventListener("click", function () {
            const isPassword = passwordInput.getAttribute("type") === "password";
            passwordInput.setAttribute("type", isPassword ? "text" : "password");

            // Alternar ícono
            toggleIcon.classList.toggle("ti-eye");
            toggleIcon.classList.toggle("ti-eye-off");
        });

        // Envío por AJAX
        const form = document.getElementById("loginForm");
        const url = "/login";
    
        // form.addEventListener("submit", function (e) {
        document.getElementById('sendLogin').addEventListener('click', async function() {

            console.log("Enviando formulario por AJAX...");
    
            const formData = new FormData(form);
    
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
                    window.location.href = data.redirect || "/dashboard";
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


</script>