/* Validação do Cnpj */

document.getElementById('cnpj').addEventListener('input', function (e) {
    let cnpj = e.target.value.replace(/\D/g, '')
    if (cnpj.length > 14) cnpj = cnpj.slice(0, 14)

    //XX.XXX.XXX/XXXX-XX - cnpj
    e.target.value = cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/, "$1.$2.$3/$4-$5")
})


/* Validação do CPF */
document.getElementById('cpf').addEventListener('input', function (e) {
    let cpf = e.target.value.replace(/\D/g, '')
    if (cpf.length > 11) cpf = cpf.slice(0, 11)

    //XXX.XXX.XXX-XX
    e.target.value = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4")
})

/* Validação do CEP */
document.getElementById('cep').addEventListener('input', function (e) {
    let cep = e.target.value.replace(/\D/g, '')
    if (cep.length > 8) cep = cep.slice(0, 8)

    //XXXXX-XXX
    e.target.value = cep.replace(/(\d{5})(\d{3})/, "$1-$2")
})

/* Validação do Telefone */
document.getElementById('phoneNumber').addEventListener('input', function (e) {
    let phone = e.target.value.replace(/\D/g, '')
    if (phone.length > 11) phone = phone.slice(0, 11)

    //(XX) XXXXX-XXXX
    e.target.value = phone.replace(/(\d{2})(\d{5})(\d{4})/, "($1) $2-$3")
})