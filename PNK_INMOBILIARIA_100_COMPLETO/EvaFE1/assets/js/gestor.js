document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

<link rel="stylesheet" href="assets/css/registro.css"></link>
        const rut = document.getElementById("rut").value.trim();
        const nombre = document.getElementById("nombre").value.trim();
        const fecha = document.getElementById("fecha-nacimiento").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();
        const sexo = document.getElementById("sexo").value;
        const telefono = document.getElementById("telefono").value.trim();
        const archivo = document.getElementById("certificado");

        if (!rut || !nombre || !fecha || !email || !password || !sexo || !telefono || archivo.files.length === 0) {
            Swal.fire("Campos incompletos", "Por favor completa todos los campos.", "warning");
            return;
        }

        if (!validarRUT(rut)) {
            Swal.fire("RUT inválido", "El RUT ingresado no es válido.", "error");
            return;
        }

        if (!validarEmail(email)) {
            Swal.fire("Correo inválido", "El formato del correo electrónico no es válido.", "error");
            return;
        }

        if (!/^\d{8,15}$/.test(telefono)) {
            Swal.fire("Teléfono inválido", "El teléfono debe ser numérico y tener entre 8 y 15 dígitos.", "error");
            return;
        }

        const archivoNombre = archivo.files[0].name;
        if (!archivoNombre.toLowerCase().endsWith(".pdf")) {
            Swal.fire("Archivo inválido", "El certificado debe ser un archivo PDF.", "error");
            return;
        }

        Swal.fire({
            title: "¿Deseas enviar el formulario?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Sí, enviar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Enviar solo si se confirma
            }
        });
    });

    function validarEmail(correo) {
        const re = /^[^@]+@[^@]+\.[a-zA-Z]{2,}$/;
        return re.test(correo);
    }

    function validarRUT(rut) {
        rut = rut.replace(/\./g, '').replace('-', '');
        const cuerpo = rut.slice(0, -1);
        let dv = rut.slice(-1).toUpperCase();

        let suma = 0;
        let multiplo = 2;

        for (let i = cuerpo.length - 1; i >= 0; i--) {
            suma += parseInt(cuerpo[i]) * multiplo;
            multiplo = multiplo < 7 ? multiplo + 1 : 2;
        }

        const dvEsperado = 11 - (suma % 11);
        const dvCalculado = dvEsperado === 11 ? '0' : dvEsperado === 10 ? 'K' : dvEsperado.toString();

        return dv === dvCalculado;
    }
});
