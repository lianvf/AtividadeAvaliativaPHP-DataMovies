<?php
$atores = [
    [
        'nome' => 'Dwayne "The Rock" Johnson',
        'imagem' => '/img/the_rock.jpg'
    ],
    [
        'nome' => 'Gal Gadot',
        'imagem' => '/img/the_rock.jpg'

    ],
    [
        'nome' => 'Ryan Reynolds',
        'imagem' => '/img/the_rock.jpg'

    ],
    [
        'nome' => 'Chris Hemsworth',
        'imagem' => '/img/the_rock.jpg'

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

<link rel="stylesheet" href="/components/atores/atores.css">
<link rel="stylesheet" href="/components/card/card.css">

<div class="atores-container">
    <div class="atores-titulo">
        <h1>ATORES</h1>
    </div>

    <div class="atores-lista">
        <?php
        foreach ($atores as $ator) {
   
            $nome = $ator['nome'];
            $imagem = $ator['imagem'];
            require __DIR__ . '/../card/card.php';
        }
        ?>
    </div>
</div>