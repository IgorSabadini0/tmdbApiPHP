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
            <div>
                <h1>Filmes Populares</h1>
                <p class="subtitulo">Catálogo atualizado via API</p>
            </div>
            <span class="badge-total">
                <?= !empty($filmes) ? count($filmes) . ' títulos' : '0 títulos' ?>
            </span>
        </div>
    </header>

    <main class="container">
        <div id="filmes-container">
            <?php if (!empty($filmes)): ?>
                <?php foreach ($filmes as $index =>$f): 
                    $titulo = htmlspecialchars($f['titulo'], ENT_QUOTES, 'UTF-8');
                    $descricao = htmlspecialchars($f['descricao'] ?: 'Sem sinopse disponível.', ENT_QUOTES, 'UTF-8');
                    $poster = htmlspecialchars($f['poster'], ENT_QUOTES, 'UTF-8');
                ?>
                    <article 
                        class="filme" 
                        style="--i: <?= $index ?>;"
                        data-titulo="<?= $titulo ?>"
                        data-descricao="<?= $descricao ?>"
                        data-poster="<?= $poster ?>"
                        tabindex="0"
                    >
                        <div class="filme-poster">
                            <img src="<?= $poster ?>" alt="Pôster de <?= $titulo ?>" loading="lazy">
                            <div class="poster-overlay">
                                <span>Ver sinopse</span>
                            </div>
                        </div>
                        <div class="filme-info">
                            <h2><?= $titulo ?></h2>
                            <p><?= $descricao ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="vazio">Nenhum filme encontrado no momento.</p>
            <?php endif; ?>
        </div>
    </main>

    <!-- Modal de Detalhes -->
    <div id="modal-filme" class="modal-backdrop" aria-hidden="true">
        <div class="modal-card" role="dialog" aria-modal="true">
            <button class="modal-fechar" aria-label="Fechar">&times;</button>
            <div class="modal-poster">
                <img id="modal-img" src="" alt="">
            </div>
            <div class="modal-conteudo">
                <h2 id="modal-titulo"></h2>
                <p id="modal-descricao"></p>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('modal-filme');
        const modalImg = document.getElementById('modal-img');
        const modalTitulo = document.getElementById('modal-titulo');
        const modalDescricao = document.getElementById('modal-descricao');
        const btnFechar = document.querySelector('.modal-fechar');

        function abrirModal(card) {
            modalImg.src = card.dataset.poster;
            modalImg.alt = 'Pôster de ' + card.dataset.titulo;
            modalTitulo.textContent = card.dataset.titulo;
            modalDescricao.textContent = card.dataset.descricao;
            modal.classList.add('ativo');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        function fecharModal() {
            modal.classList.remove('ativo');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        document.querySelectorAll('.filme').forEach(card => {
            card.addEventListener('click', () => abrirModal(card));
            card.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    abrirModal(card);
                }
            });
        });

        btnFechar.addEventListener('click', fecharModal);
        modal.addEventListener('click', (e) => {
            if (e.target === modal) fecharModal();
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal.classList.contains('ativo')) fecharModal();
        });
    </script>

</body>
</html>