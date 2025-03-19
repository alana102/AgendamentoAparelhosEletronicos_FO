function MostrarSenha(){
    var inputPass = document.getElementById('senha')
    var btnShowPass = document.getElementById('olho')

    if(inputPass.type === 'password'){
        inputPass.setAttribute('type', 'text')
        btnShowPass.classList.replace('fa-eye', 'fa-eye-slash')
    } else {
        inputPass.setAttribute('type', 'password')
        btnShowPass.classList.replace('fa-eye-slash', 'fa-eye')
    }
}