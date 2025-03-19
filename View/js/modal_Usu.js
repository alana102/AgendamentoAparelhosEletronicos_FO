const botaoEl = document.querySelector('.botao-registro');
botaoEl.addEventListener('click', abreModal);

function abreModal(e) {
    const modalEl = document.querySelector('.estrutura');
    modalEl.classList.add('visivel');
    console.log('abriu');
}

const botoesDeFechar = document.querySelectorAll('.fechar-modal');
botoesDeFechar.forEach(fechaEl => fechaEl.addEventListener('click', fechaModal));

function fechaModal(e) {
    const modalEl = document.querySelector('.estrutura');
    modalEl.classList.remove('visivel');
}