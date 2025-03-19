<?php
function obterDiasUteisDaSemana() {
    $diasUteis = [];
    $dataAtual = new DateTime();

    // Configura a localização para português do Brasil
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');

    // Obtemos o número do dia da semana (1 para segunda-feira, 2 para terça-feira, etc.)
    $diaDaSemana = $dataAtual->format('N');

    // Ajustamos a data para a segunda-feira desta semana
    $dataAtual->modify('-' . ($diaDaSemana - 1) . ' days');

    // Obtemos os próximos 5 dias úteis da semana
    for ($i = 0; $i < 6; $i++) {
        $diasUteis[] = clone $dataAtual;
        $dataAtual->modify('+1 day');
    }

    return $diasUteis;
}

// Obtém os dias úteis da semana
$diasUteis = obterDiasUteisDaSemana();

// Exibe o formulário de seleção



$dataAtual = new DateTime();
foreach ($diasUteis as $dia) {
    $opcaoDesativada = $dia->format('Y-m-d') < $dataAtual->format('Y-m-d') ? 'disabled' : '';
    echo '<option value="' . $dia->format('Y-m-d') . '" ' . $opcaoDesativada . '>' . ucfirst(strftime('%A, %d/%m/%Y', $dia->getTimestamp())) . '</option>';
}



?>
