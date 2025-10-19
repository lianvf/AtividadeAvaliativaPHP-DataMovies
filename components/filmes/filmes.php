<?php
$filmes = [
    [
        'nome' => 'Dwayne "The Rock" Johnson',
        'imagem' => '/img/the_rock.jpg'
    ],
    [
        'nome' => 'Gal Gadot',
        'imagem' => 'https://upload.wikimedia.org/wikipedia/commons/3/38/Gal_Gadot_by_Gage_Skidmore_3.jpg'

    ],
    [
        'nome' => 'Ryan Reynolds',
        'imagem' => '/img/the_rock.jpg'

    ],
    [
        'nome' => 'Chris Hemsworth',
        'imagem' => 'https://upload.wikimedia.org/wikipedia/commons/6/69/Chris_Hemsworth_by_Gage_Skidmore_3.jpg'

    ],
    [
        'nome' => 'Scarlett Johansson',
        'imagem' => '/img/the_rock.jpg'

    ],
    [
        'nome' => 'Tom Holland',
        'imagem' => '/img/the_rock.jpg'

    ]
];
?>

<link rel="stylesheet" href="/components/filmes/filmes.css">
<link rel="stylesheet" href="/components/card/card.css">

<div class="filmes-container">
    <div class="filmes-titulo">
        <h1>FILMES</h1>
    </div>

    <div class="filmes-lista">
        <?php
        foreach ($filmes as $filme) {
   
            $nome = $filme['nome'];
            $imagem = $filme['imagem'];
            require __DIR__ . '/../card/card.php';
        }
        ?>
    </div>
</div>