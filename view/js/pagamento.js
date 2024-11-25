// Animações e Validacoes do Cartao de Pagamento


// caixa do cartão para animação
const cardBox = document.querySelector('div.card-content-box')
// botão para girar o cartão
const btnRotateCard = document.querySelector('#rotate-card')
// botão de envio do form
const btnSubmit = document.querySelector('#input-submit')


// seleciona os campos de entrada para os dados do cartão
const inputNumber = document.querySelector('#input-number')
const inputNumberInfo = document.querySelector('#input-number + .info')
const inputName = document.querySelector('#input-name')
const inputNameInfo = document.querySelector('#input-name + .info')
const inputCvv = document.querySelector('#input-cvv')
const inputCvvInfo = document.querySelector('#input-cvv + .info')
const inputValidate = document.querySelector('#input-validate')
const inputValidateInfo = document.querySelector('#input-validate + .info')


// seleciona os elementos de visualização no cartão
const cardViewName = document.querySelector('#card-user-name');
const cardViewNumber = document.querySelector('#card-user-number');
const cardViewCvv = document.querySelector('#card-user-cvv');
const cardViewDate = document.querySelector('#card-user-date');



// valida o número do cartão
inputNumber.onblur = (e) => {
    // obtem o valor inserido
    const value = e.target.value;
    // remove os espaços
    const valueReplace = value.replaceAll(' ', '')

// verifica se o campo está vazio
    if(value.length <= 0) {
        const message = "Preenchimento obrigatório!"
        inputNumberInfo.querySelector('.message').innerText = message
        inputNumberInfo.classList.add('visible')
        btnSubmit.classList.add('disable')
        return false;
    }

    // verifica se o número do cartão tem 16 dígitos numéricos
    if(!/^[0-9]{16}$/.test(valueReplace)){
        const message = "Use apenas números, e verifique se estão completos!"
        inputNumberInfo.querySelector('.message').innerText = message
        inputNumberInfo.classList.add('visible')
        btnSubmit.classList.add('disable')
        return false;
    }

    inputNumberInfo.querySelector('.message').innerText = ''
    inputNumberInfo.classList.remove('visible')

    // verifica se todos os campos foram preenchidos de forma certa
    canSubmit();
}


// valida o nome do titular
inputName.onblur = (e) => {
    const value = e.target.value;
    const valueReplace = value.replaceAll(' ', '')


    if(value.length <= 0) {
        const message = "Preenchimento obrigatório!"
        inputNameInfo.querySelector('.message').innerText = message
        inputNameInfo.classList.add('visible')
        btnSubmit.classList.add('disable')
        return false;
    }


    // verifica se o nome contém apenas letras
    if(!/^[a-z]+$/i.test(valueReplace)) {
        const message = "Insira o nome de forma correcta!"
        inputNameInfo.querySelector('.message').innerText = message
        inputNameInfo.classList.add('visible')
        btnSubmit.classList.add('disable')
        return false;
    }

    inputNameInfo.querySelector('.message').innerText = ''
    inputNameInfo.classList.remove('visible')
    canSubmit();
}


// valida a data de validade
inputValidate.onblur = (e) => {
    const value = e.target.value;
    const valueReplace = value.replaceAll(' ', '')


    if(value.length <= 0) {
        const message = "Preenchimento obrigatório!"
        inputValidateInfo.querySelector('.message').innerText = message
        inputValidateInfo.classList.add('visible')
        btnSubmit.classList.add('disable')
        return false;
    }

    // verifica se a data está no formato correto
    if(!/^[0-9]{2}\/[0-9]{2}$/.test(valueReplace)) {
        const message = `Use o padrão "mês/ano"`
        inputValidateInfo.querySelector('.message').innerText = message
        inputValidateInfo.classList.add('visible')
        btnSubmit.classList.add('disable')
        return false;
    }

    inputValidateInfo.querySelector('.message').innerText = ''
    inputValidateInfo.classList.remove('visible')
    canSubmit();
}


// formatação do campo de data de validade enquanto o usuário digita
inputValidate.addEventListener('input', (e) => {
    const value = e.target.value.replace(/\D/g, '')

    // se a quantidade de dígitos for maior ou igual a 3, insere o separador "/" após os dois primeiros dígitos
    if (value.length >= 3) {
        e.target.value = `${value.slice(0, 2)}/${value.slice(2, 4)}`
    } else {
        e.target.value = value
    }
    })

    // gira o cartão ao clicar no botão
    btnRotateCard.addEventListener('click', (e) => {
        cardBox.classList.toggle('rotate')
    })

    // funções para atualizar a visualização do cartão com os valores inseridos
    const handleName = (e) => {

        setTimeout(() => {

            const value = e.target.value

            // atualiza o nome no cartão
            cardViewName.innerText= value

        }, 100)
            
    }

    const handleNumber = (e) => {
        setTimeout(() => {

        const value = e.target.value


        // limita o número de caracteres do cartão a 19 (4 espaços)
        if(value.length >= 20) {
            return false;
        }

         // se a tecla pressionada for 'Backspace', mantém o número no cartão
        if(e.key == 'Backspace') {
            cardViewNumber.innerText = value
            return false
        }

        // add espaço após cada 4 dígitos digitados
        if(value.length == 4 || value.length == 9 || value.length == 14) {
            e.target.value += " "
        }

        // atualiza o número no cartão
        cardViewNumber.innerText = value

        }, 0)
            
        }

    const handleCvv = (e) => {

        setTimeout(() => {
            const value = e.target.value

            // atualiza o cvv
            cardViewCvv.innerText = value

        }, 0)
            
        }

    const handleValidate = (e) => {
        setTimeout(() => {

            const value = e.target.value

            // atualiza a data de validade
            cardViewDate.innerText = value

        }, 0)
            
        }

    // define ações ao focar e desfocar o campo de cvv
    inputCvv.onfocus = () => {
    cardBox.classList.remove('rotate')
    }

    inputCvv.onblur = () => {
        cardBox.classList.add('rotate')
        canSubmit();
    }

    // funcao que verifica se todos os campos estão preenchidos certos
    function canSubmit() {
            
        const inputs = document.querySelectorAll('input')

        for(let i = 0; i < inputs.length; i++) {

            if(inputs[i].value.length <= 0) {
                // desabilita o botão de envio se algum campo estiver vazio
                btnSubmit.classList.add('disable')
                return false;
            }
        }

        btnSubmit.classList.remove('disable')
}

// chama a função
canSubmit()