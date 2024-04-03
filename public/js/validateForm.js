document.addEventListener('DOMContentLoaded', function () {

    const form = document.querySelector('form');

    form.addEventListener('submit', function (event) {

        const isValidName = validateName(document.getElementById('name').value);
        const isValidEmail = validateEmail(document.getElementById('email').value);
        /*const isValidCpfCnpj = validaCPFouCNPJ(document.getElementById('cpf_cnpj').value);*/
        const isValidTel = validaTelefone(document.getElementById('tel').value);
        const isValidMessage = validateMensagem(document.getElementById('mensagem').value);
        const isValidDepartamento = validateDepartamento(document.getElementById('departamento').value);
        const isValidEmpresa = validateEmpresa(document.getElementById('empresa').value);

        if (!isValidName || !isValidEmail || !isValidTel || !isValidDepartamento || !isValidMessage || !isValidEmpresa) {

            event.preventDefault();
            console.log("Formulário inválido, envio bloqueado");
            displayFormError('Por favor, corrija os erros antes de enviar.');
        } else {

            console.log("Formulário válido, permitindo o envio");
            clearFormError();
        }
    });

    // Funções para controlar a exibição de erros no formulário
    function displayFormError(message) {
        const errorElement = document.getElementById('form-error');
        errorElement.textContent = message;
    }

    function clearFormError() {
        document.getElementById('form-error').textContent = '';
    }

    document.getElementById('name').addEventListener('blur', function () {
        validateName(this.value);
    });

    document.getElementById('empresa').addEventListener('blur', function () {
        validateEmpresa(this.value);
    });

    document.getElementById('mensagem').addEventListener('blur', function () {
        validateMensagem(this.value);
    });

    document.getElementById('departamento').addEventListener('blur', function () {
        validateDepartamento(this.value);
    });

    document.getElementById('email').addEventListener('blur', function () {
        validateEmail(this.value);
    });

    /*
    document.getElementById('cpf_cnpj').addEventListener('blur', function() {
        validaCPFouCNPJ(this.value);
    });*/

    document.getElementById('tel').addEventListener('blur', function () {
        validaTelefone(this.value);
    });
});

function validateName(name) {
    if (name.trim() === '') {
        displayError('name', 'Por favor, insira o nome.');
        return false;
    } else {
        clearError('name');
        return true;
    }
}

function validateEmpresa(empresa) {
    if (empresa.trim() === '') {
        displayError('empresa', 'Por favor, insira o nome da empresa.');
        return false;
    } else {
        clearError('empresa');
        return true;
    }
}

function validateMensagem(mensagem) {
    if (mensagem.trim() === '') {
        displayError('mensagem', 'Por favor, insira a mensagem.');
        return false;
    } else {
        clearError('mensagem');
        return true;
    }
}

function validateDepartamento(departamento) {
    if (departamento.trim() === '') {
        displayError('departamento', 'Por favor, escolha um departamento.');
        return false;
    } else {
        clearError('departamento');
        return true;
    }
}

function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!regex.test(email)) {
        displayError('email', 'Por favor, insira um e-mail válido.');
        return false;
    } else {
        clearError('email');
        return true;
    }
}


function validaCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');
    if (cpf == '' || cpf.length != 11 || /^(\d)\1{10}$/.test(cpf)) return false;

    let soma = 0;
    for (let i = 0; i < 9; i++) soma += parseInt(cpf.charAt(i)) * (10 - i);
    let resto = (soma * 10) % 11;
    if ((resto == 10) || (resto == 11)) resto = 0;
    if (resto != parseInt(cpf.charAt(9))) return false;

    soma = 0;
    for (let i = 0; i < 10; i++) soma += parseInt(cpf.charAt(i)) * (11 - i);
    resto = (soma * 10) % 11;
    if ((resto == 10) || (resto == 11)) resto = 0;
    if (resto != parseInt(cpf.charAt(10))) return false;

    return true;
}

function validaCNPJ(cnpj) {
    cnpj = cnpj.replace(/[^\d]+/g, '');
    if (cnpj == '' || cnpj.length != 14) return false;

    if (/^(\d)\1+$/.test(cnpj)) return false;

    let tamanho = cnpj.length - 2;
    let numeros = cnpj.substring(0, tamanho);
    let digitos = cnpj.substring(tamanho);
    let soma = 0;
    let pos = tamanho - 7;
    for (let i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2) pos = 9;
    }

    let resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0)) return false;

    tamanho = tamanho + 1;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (let i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2) pos = 9;
    }

    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1)) return false;

    return true;
}

function validaCPFouCNPJ(valor) {
    const input = valor.replace(/[^\d]/g, ''); // Remove caracteres não numéricos

    if (input.length === 11) {
        if (validaCPF(input)) {

            clearError('cpf_cnpj');
            return true;
        } else {

            displayError('cpf_cnpj', 'CPF inválido.');
            return false;
        }
    } else if (input.length === 14) {
        if (validaCNPJ(input)) {
            clearError('cpf_cnpj');
            return true;
        } else {
            displayError('cpf_cnpj', 'CNPJ inválido.');
            return false;
        }
    } else {
        displayError('cpf_cnpj', 'CPF ou CNPJ inválido.');
        return false;
    }
}

function validaTelefone(valor) {
    const input = valor.replace(/[^\d]/g, ''); // Remove caracteres não numéricos

    // Valida celular com 11 dígitos (inclui o dígito 9 após o DDD)
    if (input.length === 11) {
        clearError('tel');
        return true;
    }
    // Valida telefone fixo com 10 dígitos
    else if (input.length === 10) {
        clearError('tel');
        return true;
    } else {
        displayError('tel', 'Número de telefone inválido.');
        return false;
    }
}

// Funções para exibir e limpar mensagens de erro
function displayError(fieldId, message) {
    document.getElementById(fieldId + '-error').textContent = message;
}

function clearError(fieldId) {
    document.getElementById(fieldId + '-error').textContent = '';
}


function mascaraCPFouCNPJ(valor) {
    valor = valor.replace(/\D/g, ''); // Remove tudo o que não é dígito
    if (valor.length <= 11) { // CPF
        valor = valor.substring(0, 11); // Limita a 11 dígitos
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    } else { // CNPJ
        valor = valor.substring(0, 14); // Limita a 14 dígitos
        valor = valor.replace(/^(\d{2})(\d)/, '$1.$2');
        valor = valor.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
        valor = valor.replace(/\.(\d{3})(\d)/, '.$1/$2');
        valor = valor.replace(/(\d{4})(\d)/, '$1-$2');
    }
    return valor;
}

function mascaraTelefone(valor) {
    valor = valor.replace(/\D/g, ''); // Remove tudo que não é dígito

    if (valor.length === 11) {
        // Celular com 11 dígitos, inclui um espaço após o nono dígito (o dígito 9)
        valor = valor.replace(/^(\d{2})(\d)(\d{4})(\d{4})/, '($1) $2 $3-$4');
    } else if (valor.length === 10) {
        // Telefone fixo com 10 dígitos
        valor = valor.replace(/^(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
    }

    return valor;
}

// Aplica as máscaras nos campos

/*
    document.getElementById('cpf_cnpj').addEventListener('input', function() {
        this.value = mascaraCPFouCNPJ(this.value);
    });*/

document.getElementById('tel').addEventListener('input', function () {
    this.value = mascaraTelefone(this.value);
});