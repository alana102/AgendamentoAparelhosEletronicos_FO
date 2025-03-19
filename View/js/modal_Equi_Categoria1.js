function initModal1() {
    const botoesModal1 = document.querySelectorAll('[data-abre-modal]');
    const modaisModal1 = document.querySelectorAll('.estrutura');
    const mascarasModal1 = document.querySelectorAll('.mascara');

    botoesModal1.forEach(botaoEl => botaoEl.addEventListener('click', abreModal1));
    mascarasModal1.forEach(mascara => mascara.addEventListener('click', bloqueiaEvento1));

    modaisModal1.forEach(modal => {
        modal.addEventListener('click', function(e) {
            e.stopPropagation(); // Impede a propagação do evento de clique nos modais
        });
    });

    function abreModal1(e) {
        const botaoClicadoEl = e.currentTarget;
        const seletorDoModal = botaoClicadoEl.dataset.abreModal;
        const modalEl = document.querySelector(seletorDoModal);

        fechaModalAberto1(); // Fecha qualquer modal aberto antes de abrir um novo

        modalEl.classList.add('visivel');

        const mascara = document.querySelector(`#${modalEl.id} + .mascara`);
        mascara.classList.add('visivel');
    }

    const botoesDeFecharModal1 = document.querySelectorAll('.fechar-modal');
    botoesDeFecharModal1.forEach(fechaEl => fechaEl.addEventListener('click', fechaModal1));

    function fechaModal1(e) {
        const fecharModalEl = e.currentTarget;
        const modalEl = fecharModalEl.closest('.estrutura');

        modalEl.classList.remove('visivel');

        const mascara = document.querySelector(`#${modalEl.id} + .mascara`);
        mascara.classList.remove('visivel');
    }

    function fechaModalAberto1(){
        const modalAberto = document.querySelector('.estrutura.visivel');

        if (modalAberto) {
            modalAberto.classList.remove('visivel');

            const mascara = document.querySelector(`#${modalAberto.id} + .mascara`);
            mascara.classList.remove('visivel');
        }
    }

    function bloqueiaEvento1(e) {
        e.stopPropagation(); // Impede que o evento se propague (no caso, para os modais)
    }
}

function initModal2() {
    const botoesModal2 = document.querySelectorAll('[data-abre-modal]');
    const fecharModal2 = document.getElementById('fechar_agen_pdf');
    const modal2 = document.getElementById('agen-pdf');
    const mascara2 = document.getElementById('mascara-1');

    botoesModal2.forEach(botaoEl => {
        botaoEl.addEventListener('click', function() {
            const seletorDoModal = botaoEl.getAttribute('data-abre-modal');
            const modalEl = document.querySelector(seletorDoModal);

            modalEl.classList.add('visivel');
            mascara2.classList.add('visivel');
        });
    });

    fecharModal2.addEventListener('click', function() {
        modal2.classList.remove('visivel');
        mascara2.classList.remove('visivel');
    });

    mascara2.addEventListener('click', function(e) {
        e.stopPropagation();
        fecharModal2.removeEventListener('click', fecharModal2Handler);
        mascara2.classList.remove('visivel');
    });
}

// Inicializa os dois modais
initModal1();
initModal2();
