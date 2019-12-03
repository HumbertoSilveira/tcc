<?php
function so_numero($string)
{
    return !is_null($string) ? preg_replace('/[^0-9]/', '', $string) : '';
}

function moeda_en($valor) {
    //return preg_replace('#\D#','',$valor)/100;
    if (!is_float($valor)) {
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", ".", $valor);
        return $valor;
    }
    return $valor;
}
function moeda_br($valor) {
    return number_format($valor, 2, ',', '.');
}

function formata_telefone($telefone)
{
    $telefone = str_replace(array('(', ')', '[', ']', ' ', '.', '-', ',', '/'), '', $telefone);
    $tam = strlen($telefone);

    if ($tam > 11) {
        $telefone = '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '.' . substr($telefone, 7, 4);
    } else if ($tam == 11 && substr($telefone, 0, 4) == '0800') {
        $telefone = substr($telefone, 0, 4) . '-' . substr($telefone, 4, 3) . '-' . substr($telefone, 7, 4);
    } else if ($tam == 11) {
        $telefone = '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 1) . ' ' . substr($telefone, 3, 4) . '.' . substr($telefone, 7, 4);
    } else if ($tam == 10) {
        $telefone = '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 4) . '.' . substr($telefone, 6, 4);
    } else if ($tam == 9) {
        $telefone = substr($telefone, 0, 1) . '-' . substr($telefone, 1, 4) . '.' . substr($telefone, 5, 4);
    } else if ($tam == 8) {
        $telefone = substr($telefone, 0, 4) . '.' . substr($telefone, 4, 4);
    } else {
        $telefone = '';
    }

    return $telefone;
}

function formata_cpf_cnpj(string $cpf_cnpj)
{
    $cpf_cnpj = preg_replace("#[' '-./ t]#", '', $cpf_cnpj);
    $tamanho = (strlen($cpf_cnpj) - 2);

    if ($tamanho != 9 && $tamanho != 12) {
        return '';
    }

    $mascara = ($tamanho == 9) ? '###.###.###-##' : '##.###.###/####-##';

    $indice = -1;
    for ($i = 0; $i < strlen($mascara); $i++) {
        if ($mascara[$i] == '#') {
            $mascara[$i] = $cpf_cnpj[++$indice];
        }
    }

    return $mascara;
}

function valida_cpf(string $CPF)
{
    if (strlen($CPF) != 11) {
        return false;
    } else {
        if ($CPF == "00000000000") {
            return false;
        } else {
            $n[1] = intval(substr($CPF, 1 - 1, 1));
            $n[2] = intval(substr($CPF, 2 - 1, 1));
            $n[3] = intval(substr($CPF, 3 - 1, 1));
            $n[4] = intval(substr($CPF, 4 - 1, 1));
            $n[5] = intval(substr($CPF, 5 - 1, 1));
            $n[6] = intval(substr($CPF, 6 - 1, 1));
            $n[7] = intval(substr($CPF, 7 - 1, 1));
            $n[8] = intval(substr($CPF, 8 - 1, 1));
            $n[9] = intval(substr($CPF, 9 - 1, 1));
            $n[10] = intval(substr($CPF, 10 - 1, 1));
            $n[11] = intval(substr($CPF, 11 - 1, 1));
            $soma = 10 * $n[1] + 9 * $n[2] + 8 * $n[3] + 7 * $n[4] + 6 * $n[5] + 5 * $n[6] + 4 * $n[7] + 3 * $n[8] + 2 * $n[9];
            $soma = $soma - (11 * (intval($soma / 11)));

            if ($soma == 0 || $soma == 1) {
                $resultado1 = 0;
            } else {
                $resultado1 = 11 - $soma;
            }

            if ($resultado1 == $n[10]) {
                $soma = $n[1] * 11 + $n[2] * 10 + $n[3] * 9 + $n[4] * 8 + $n[5] * 7 + $n[6] * 6 + $n[7] * 5 + $n[8] * 4 + $n[9] * 3 + $n[10] * 2;
                $soma = $soma - (11 * (intval($soma / 11)));

                if ($soma == 0 || $soma == 1) {
                    $resultado2 = 0;
                } else {
                    $resultado2 = 11 - $soma;
                }
                if ($resultado2 == $n[11]) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }
}

function valida_cnpj(string $CNPJ)
{
    if (strlen($CNPJ) != 14) {
        return false;
    } else {
        if ($CNPJ == "00000000000000") {
            return false;
        } else {
            $n[1] = intval(substr($CNPJ, 1 - 1, 1));
            $n[2] = intval(substr($CNPJ, 2 - 1, 1));
            $n[3] = intval(substr($CNPJ, 3 - 1, 1));
            $n[4] = intval(substr($CNPJ, 4 - 1, 1));
            $n[5] = intval(substr($CNPJ, 5 - 1, 1));
            $n[6] = intval(substr($CNPJ, 6 - 1, 1));
            $n[7] = intval(substr($CNPJ, 7 - 1, 1));
            $n[8] = intval(substr($CNPJ, 8 - 1, 1));
            $n[9] = intval(substr($CNPJ, 9 - 1, 1));
            $n[10] = intval(substr($CNPJ, 10 - 1, 1));
            $n[11] = intval(substr($CNPJ, 11 - 1, 1));
            $n[12] = intval(substr($CNPJ, 12 - 1, 1));
            $n[13] = intval(substr($CNPJ, 13 - 1, 1));
            $n[14] = intval(substr($CNPJ, 14 - 1, 1));
            $soma = $n[1] * 5 + $n[2] * 4 + $n[3] * 3 + $n[4] * 2 + $n[5] * 9 + $n[6] * 8 + $n[7] * 7 + $n[8] * 6 + $n[9] * 5 + $n[10] * 4 + $n[11] * 3 + $n[12] * 2;
            $soma = $soma - (11 * (intval($soma / 11)));

            if ($soma == 0 || $soma == 1) {
                $resultado1 = 0;
            } else {
                $resultado1 = 11 - $soma;
            }
            if ($resultado1 == $n[13]) {
                $soma = $n[1] * 6 + $n[2] * 5 + $n[3] * 4 + $n[4] * 3 + $n[5] * 2 + $n[6] * 9 + $n[7] * 8 + $n[8] * 7 + $n[9] * 6 + $n[10] * 5 + $n[11] * 4 + $n[12] * 3 + $n[13] * 2;
                $soma = $soma - (11 * (intval($soma / 11)));
                if ($soma == 0 || $soma == 1) {
                    $resultado2 = 0;
                } else {
                    $resultado2 = 11 - $soma;
                }
                if ($resultado2 == $n[14]) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }
}

function formata_cep(string $cep)
{
    return $cep ? substr($cep, 0, 5) . '-' . substr($cep, 5, 3) : '';
}

function formata_numero($numero)
{
    return $numero ? number_format($numero, 0, ',', '.') : 0;
}

function capitalize($string, $encoding = 'UTF-8')
{
    $word_splitters = [' ', '-', "O’", "L’", "D’", 'St.', 'Mc', "Dall'", "l’", "d’", "a’", "o’"];
    $lowercase_exceptions = ['the', 'van', 'den', 'von', 'und', 'der', 'da', 'de',  'of', 'and', "d’",
        'das', 'do', 'dos', 'e', 'el'];
    $uppercase_exceptions = ['II', 'III', 'XV', 'IV', 'VI', 'VII', 'VIII', 'IX', 'ME', 'EIRELI', 'EPP', 'S/A', 'S.A', 'LTDA'];
    $string = mb_strtolower($string, $encoding);
    $string = str_replace("'", "’", $string);
    foreach ($word_splitters as $delimiter)
    {
        $words = explode($delimiter, $string);
        $newwords = array();
        foreach ($words as $word)
        {
            if (in_array(mb_strtoupper($word, $encoding), $uppercase_exceptions))
                $word = mb_strtoupper($word, $encoding);
            else
                if (!in_array($word, $lowercase_exceptions))
                    $word = mb_strtoupper(mb_substr($word, 0, 1), $encoding)
                        .mb_substr($word, 1);
            $newwords[] = $word;
        }
        if (in_array(mb_strtolower($delimiter, $encoding), $lowercase_exceptions))
            $delimiter = mb_strtolower($delimiter, $encoding);
        $string = join($delimiter, $newwords);
    }
    return $string;
}

function getConfig()
{
    //cache()->flush('configuracoes');
    $config = cache('configuracoes');
    if(is_null($config)) {
        $results = \App\Models\Admin\Configuracao::all();
        foreach($results as $result) {
            $config[$result->slug] = $result;
        }

        cache(['configuracoes' => $config], 1440);
    }

    return $config;

}

function toUtf8(string $string)
{
    $original = $string;
    $new = html_entity_decode($string, ENT_QUOTES, 'UTF-8');

    return $original != $new ? $new : $original;
}