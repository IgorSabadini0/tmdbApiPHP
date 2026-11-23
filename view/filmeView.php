<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Filmes Populares</title>
</head>
<body>

    <header class="topo">
        <div class="topo-conteudo">
            <h1>Filmes Populares</h1>
            <p class="subtitulo">Catálogo atualizado via API</p>
        </div>
    </header>

    <main class="container">
        <div id="filmes-container">
            <?php if (!empty($filmes)): ?>
                <?php foreach ($filmes as $f): 
                    $titulo = htmlspecialchars($f['titulo'], ENT_QUOTES, 'UTF-8');
                    $descricao = htmlspecialchars($f['descricao'], ENT_QUOTES, 'UTF-8');
                    $poster = htmlspecialchars($f['poster'], ENT_QUOTES, 'UTF-8');
                ?>
                    <article class="filme">
                        <div class="filme-poster">
                            <img src="<?= $poster ?>" alt="Pôster de <?= $titulo ?>" loading="lazy">
                        </div>
                        <div class="filme-info">
                            <h2><?= $titulo ?></h2>
                            <p><?= $descricao ?: 'Sem sinopse disponível.' ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="vazio">Nenhum filme encontrado no momento.</p>
            <?php endif; ?>
        </div>
    </main>

</body>
</html>