const botoes = document.querySelectorAll('[data-abre-modal]');
for (let botaoEl of botoes){
    botaoEl.addEventListener('click', abreModal);
}

function abreModal(e) {
    const botaoClicadoEl = e.currentTarget;
    const seletorDoModal = botaoClicadoEl.dataset.abreModal;
    const modalEl = document.querySelector(seletorDoModal);
    modalEl.classList.add('visivel');
}

const botoesDeFechar = document.querySelectorAll('.fechar-modal');
botoesDeFechar.forEach(fechaEl => fechaEl.addEventListener('click', fechaModal));

function fechaModal(e) {
    const fecharModalEl = e.currentTarget;
    const modalEl = fecharModalEl.closest('.estrutura');
    modalEl.classList.remove('visivel');
}

const mascaraEl = document.querySelector('#mascara');
mascaraEl.addEventListener('click', fechaModalAberto);

function fechaModalAberto(){
    document.querySelector('.modal.visivel').classList.remove('visivel');
}