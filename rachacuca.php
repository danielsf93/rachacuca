<?php
//rachacuca/rachacuca.php
        // Função para obter a temperatura de uma estação
        function getTemperature($url) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $html = curl_exec($ch);
            if ($html === false) {
                return 'Erro ao acessar a página';
            }
            curl_close($ch);

            $dom = new DOMDocument();
            @$dom->loadHTML($html);

            $xpath = new DOMXPath($dom);
            $element = $xpath->query('//td[strong="Atual:"]/following-sibling::td/span[@class="tempmedio"]')->item(0);

            return $element->textContent;
        }

        // Array com os nomes das estações e seus links correspondentes
        $estacoes = array(
            'Barragem Parelheiros' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=507',
            'Butantã' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=1000842',
            'Campo Limpo' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=1000854',
            'Capela do Socorro' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=1000857',
            'Capela do Socorro - Subprefeitura' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=846',
            'Cidade Ademar' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=592',
            'Freguesia do Ó' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=509',
            'Ipiranga' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=1000840',
            'Itaim Paulista' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=1000882',
            'Itaquera' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=1000864',
            'Jabaquara' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=634',
            'Lapa' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=1000848',
            'M Boi Mirim' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=1000850',
            'Marsilac' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=1000300',
            'Mauá - Paço Municipal' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=1000876',
            'Móoca' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=1000860',
            'Penha' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=1000887',
            'Perus' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=504',
            'Pirituba' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=515',
            'Pinheiros' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=1000635',
            'Riacho Grande' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=400',
            'Santana do Parnaíba' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=1000880',
            'Santana/Tucuruvi' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=510',
            'Santo Amaro' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=1000852',
            'São Mateus' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=1000844',
            'São Miguel Paulista' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=1000862',
            'Sé' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=503',
            'Tremembé' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=1000944',
            'Vila Formosa' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=1000859',
            'Vila Maria / Guilherme' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=540',
            'Vila Mariana' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=495',
            'Vila Prudente' => 'https://www.cgesp.org/v3/estacao.jsp?POSTO=524',
        );

        // Array para armazenar os resultados
        $resultados = array();

        // Preenche o array com os resultados
        foreach ($estacoes as $estacao => $url) {
            $temperatura = getTemperature($url);
            $resultados[$estacao] = $temperatura;
        }

        // Classifica o array em ordem decrescente com base nas temperaturas
        arsort($resultados);

        // Exibe a lista de estações e suas temperaturas organizadas
        echo '<ul>';
        foreach ($resultados as $estacao => $temperatura) {
            echo "<li>$estacao: $temperatura</li>";
        }
        echo '</ul>';
        ?>