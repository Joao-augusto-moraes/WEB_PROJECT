document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('form');
    const span = document.querySelectorAll('.span_required');
    const campos = document.querySelectorAll('.inputuser');
    const email_regex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

    if (form) {
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            nameValidate();
            emailValidate();
            telefoneValidate();
            cidadeValidate();
            estadoValidate();
            enderecoValidate();
        });

        // Adicionar eventos de validação aos campos de entrada
        campos[0].addEventListener('input', nameValidate);
        campos[1].addEventListener('input', emailValidate);
        campos[2].addEventListener('input', telefoneValidate);
        campos[3].addEventListener('input', cidadeValidate);
        campos[4].addEventListener('input', estadoValidate);
        campos[5].addEventListener('input', enderecoValidate);

        //funções para validação

        function setError(index) {
            span[index].style.display = 'block';
        }

        function removeError(index) {
            span[index].style.display = 'none';
        }

        //função validar nome
        function nameValidate() {
            if (campos[0].value.length < 3) {
                setError(0);
            } else {
                removeError(0);
            }
        }

        //função validar email
        function emailValidate() {
            if (!email_regex.test(campos[1].value)) {
                setError(1);
            } else {
                removeError(1);
            }
        }

        function telefoneValidate() {
            if (campos[2].value.length < 8) {
                setError(2);
            } else {
                removeError(2);
            }
        }

        function cidadeValidate() {
            if (campos[3].value.length > 29) {
                setError(3);
            } else {
                removeError(3);
            }
        }

        function estadoValidate() {
            if (campos[4].value.length > 8) {
                setError(4);
            } else {
                removeError(4);
            }
        }

        function enderecoValidate() {
            if (campos[5].value.length >= 100) {
                setError(5);
            } else {
                removeError(5);
            }
        }
    } else {
        console.error("Elemento com ID 'form' não encontrado.");
    }
});