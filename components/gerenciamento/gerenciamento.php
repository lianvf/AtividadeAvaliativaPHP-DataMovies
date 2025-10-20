<?php
require_once __DIR__ . '/../../config/database.php';

try {
    $conn = getConnection();
    $atores = $conn->query("SELECT a.*, n.nome as nomeNacionalidade FROM ator a LEFT JOIN nacionalidade n ON a.nacionalidadeId = n.nacionalidadeId ORDER BY a.nome")->fetchAll(PDO::FETCH_ASSOC);
    $filmes = $conn->query("SELECT f.*, c.nome as nomeCategoria FROM filme f LEFT JOIN categoria c ON f.categoriaId = c.categoriaId ORDER BY f.título")->fetchAll(PDO::FETCH_ASSOC);
    $categorias = $conn->query("SELECT * FROM categoria ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
    $idiomas = $conn->query("SELECT * FROM idioma ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
    $nacionalidades = $conn->query("SELECT * FROM nacionalidade ORDER BY pais")->fetchAll(PDO::FETCH_ASSOC);
    $classificacoes = $conn->query("SELECT * FROM classificacaoindicativa ORDER BY descricao")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar dados: " . $e->getMessage());
}
?>
<link rel="stylesheet" href="/components/gerenciamento/gerenciamento.css">

<div class="gerenciamento-container">
    <h1>Gerenciamento</h1>
    <nav class="crud-nav">
        <button class="tab-button active" data-tab="gerenciar-ator">Atores</button>
        <button class="tab-button" data-tab="gerenciar-filme">Filmes</button>
        <button class="tab-button" data-tab="gerenciar-elenco">Elenco</button>
        <button class="tab-button" data-tab="gerenciar-categoria">Categorias</button>
        <button class="tab-button" data-tab="gerenciar-idioma">Idiomas</button>
        <button class="tab-button" data-tab="gerenciar-nacionalidade">Nacionalidades</button>
    </nav>

    <section id="gerenciar-ator" class="crud-section active">
        <div class="section-header">
            <h2>Atores Cadastrados</h2>
            <button class="btn btn-adicionar" id="btn-novo-ator">+ Adicionar Novo Ator</button>
        </div>
        <form id="form-ator" class="crud-form hidden" action="/controllers/ator_controller.php" method="POST">
            <input type="hidden" name="action" id="atorAction" value="create">
            <input type="hidden" name="idAtor" id="idAtor">
            <h3 id="form-ator-titulo">Adicionar Novo Ator</h3>
            <div class="form-grid">
                <div class="form-group"><label for="nome">Nome:</label><input type="text" id="nome" name="nome"
                        required></div>
                <div class="form-group"><label for="sobrenome">Sobrenome:</label><input type="text" id="sobrenome"
                        name="sobrenome" required></div>
                <div class="form-group"><label for="dataNasc">Data de Nascimento:</label><input type="date"
                        id="dataNasc" name="dataNasc"></div>
                <div class="form-group">
                    <label for="nacionalidadeId">Nacionalidade:</label>
                    <select id="nacionalidadeId" name="nacionalidadeId">
                        <?php foreach ($nacionalidades as $n): ?>
                            <option value="<?= $n['nacionalidadeId'] ?>"><?= htmlspecialchars($n['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Sexo:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="sexo" value="M"> M</label>
                        <label><input type="radio" name="sexo" value="F"> F</label>
                    </div>
                </div>
                <div class="form-group full-width"><label for="imagemUrl">URL da Imagem:</label><input type="text"
                        id="imagemUrl" name="imagemUrl"></div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-salvar">Salvar</button>
                <button type="button" class="btn btn-cancelar" id="btn-cancelar-ator">Cancelar</button>
            </div>
        </form>
        <div class="table-wrapper">
            <table class="crud-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome Completo</th>
                        <th>Nacionalidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($atores as $ator): ?>
                        <tr data-entidade='<?= json_encode($ator) ?>'>
                            <td><?= $ator['idAtor'] ?></td>
                            <td><?= htmlspecialchars($ator['nome'] . ' ' . $ator['sobrenome']) ?></td>
                            <td><?= htmlspecialchars($ator['nomeNacionalidade']) ?></td>
                            <td class="actions-cell">
                                <button class="btn btn-editar btn-editar-ator">Editar</button>
                                <form action="/controllers/ator_controller.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="idAtor" value="<?= $ator['idAtor'] ?>">
                                    <button type="submit" class="btn btn-excluir"
                                        onclick="return confirm('Tem certeza?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section id="gerenciar-filme" class="crud-section">
        <div class="section-header">
            <h2>Filmes Cadastrados</h2>
            <button class="btn btn-adicionar" id="btn-novo-filme">+ Adicionar Novo Filme</button>
        </div>
        <form id="form-filme" class="crud-form hidden" action="/controllers/filme_controller.php" method="POST">
            <input type="hidden" name="action" id="filmeAction" value="create">
            <input type="hidden" name="idFilme" id="idFilme">
            <h3 id="form-filme-titulo">Adicionar Novo Filme</h3>
            <div class="form-grid">
                <div class="form-group full-width"><label for="titulo">Título:</label><input type="text" id="titulo"
                        name="título" required></div>
                <div class="form-group"><label for="anoLancamento">Lançamento:</label><input type="date"
                        id="anoLancamento" name="anoLancamento"></div>
                <div class="form-group">
                    <label for="categoriaId">Categoria:</label>
                    <select id="categoriaId" name="categoriaId">
                        <?php foreach ($categorias as $c): ?>
                            <option value="<?= $c['categoriaId'] ?>"><?= htmlspecialchars($c['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="idiomaId">Idioma:</label>
                    <select id="idiomaId" name="idiomaId">
                        <?php foreach ($idiomas as $i): ?>
                            <option value="<?= $i['idiomaId'] ?>"><?= htmlspecialchars($i['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nacionalidadeIdFilme">Nacionalidade:</label>
                    <select id="nacionalidadeIdFilme" name="nacionalidadeId">
                        <option value="">N/A</option>
                        <?php foreach ($nacionalidades as $n): ?>
                            <option value="<?= $n['nacionalidadeId'] ?>"><?= htmlspecialchars($n['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="classificacaoIndicativaId">Classificação:</label>
                    <select id="classificacaoIndicativaId" name="classificacaoIndicativaId">
                        <?php foreach ($classificacoes as $cl): ?>
                            <option value="<?= $cl['classificacaoIndicativaId'] ?>">
                                <?= htmlspecialchars($cl['descricao']) ?></option><?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group full-width"><label for="imagemUrl">URL da Imagem:</label><input type="text"
                        id="imagemUrl" name="imagemUrl"></div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-salvar">Salvar</button>
                <button type="button" class="btn btn-cancelar" id="btn-cancelar-filme">Cancelar</button>
            </div>
        </form>
        <div class="table-wrapper">
            <table class="crud-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Categoria</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($filmes as $filme): ?>
                        <tr data-entidade='<?= json_encode($filme) ?>'>
                            <td><?= $filme['idFilme'] ?></td>
                            <td><?= htmlspecialchars($filme['título']) ?></td>
                            <td><?= htmlspecialchars($filme['nomeCategoria']) ?></td>
                            <td class="actions-cell">
                                <button class="btn btn-editar btn-editar-filme">Editar</button>
                                <form action="/controllers/filme_controller.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="idFilme" value="<?= $filme['idFilme'] ?>">
                                    <button type="submit" class="btn btn-excluir"
                                        onclick="return confirm('Tem certeza?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section id="gerenciar-elenco" class="crud-section">
        <div class="section-header">
            <h2>Gerenciar Elenco</h2>
        </div>

        <form class="crud-form" action="/controllers/ator_filme_controller.php" method="POST">
            <input type="hidden" name="action" value="add">
            <h3>Adicionar Ator a um Filme</h3>
            <div class="form-grid">
                <div class="form-group">
                    <label for="filmeSelect">Selecione o Filme:</label>
                    <select name="filmeId" id="filmeSelect" required>
                        <option value="" disabled selected>Escolha um filme...</option>
                        <?php foreach ($filmes as $filme): ?>
                            <option value="<?= $filme['idFilme'] ?>"><?= htmlspecialchars($filme['título']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="atorSelect">Selecione o Ator:</label>
                    <select name="atorId" id="atorSelect" required>
                        <option value="" disabled selected>Escolha um ator...</option>
                        <?php foreach ($atores as $ator): ?>
                            <option value="<?= $ator['idAtor'] ?>">
                                <?= htmlspecialchars($ator['nome'] . ' ' . $ator['sobrenome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-adicionar">Adicionar ao Elenco</button>
            </div>
        </form>

        <div class="elenco-lista-container">
            <h3>Elencos Atuais</h3>
            <?php foreach ($filmes as $filme): ?>
                <div class="elenco-filme-item">
                    <h4><?= htmlspecialchars($filme['título']) ?></h4>
                    <ul class="elenco-atores-lista">
                        <?php if (!empty($atoresPorFilme[$filme['idFilme']])): ?>
                            <?php foreach ($atoresPorFilme[$filme['idFilme']] as $ator): ?>
                                <li>
                                    <span><?= htmlspecialchars($ator['nome'] . ' ' . $ator['sobrenome']) ?></span>
                                    <form action="/controllers/ator_filme_controller.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="action" value="remove">
                                        <input type="hidden" name="filmeId" value="<?= $filme['idFilme'] ?>">

                                        <input type="hidden" name="atorId" value="<?= $ator['atorId'] ?>">

                                        <button type="submit" class="btn btn-excluir btn-micro">Remover</button>
                                    </form>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="sem-atores">Nenhum ator associado.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="gerenciar-categoria" class="crud-section">
        <div class="section-header">
            <h2>Categorias Cadastradas</h2>
            <button class="btn btn-adicionar" id="btn-nova-categoria">+ Adicionar Nova Categoria</button>
        </div>
        <form id="form-categoria" class="crud-form hidden" action="/controllers/categoria_controller.php" method="POST">
            <input type="hidden" name="action" id="categoriaAction" value="create">
            <input type="hidden" name="categoriaId" id="categoriaIdForm">
            <h3 id="form-categoria-titulo">Adicionar Nova Categoria</h3>
            <div class="form-group"><label for="nomeCategoria">Nome:</label><input type="text" id="nomeCategoria"
                    name="nome" required></div>
            <div class="form-actions">
                <button type="submit" class="btn btn-salvar">Salvar</button>
                <button type="button" class="btn btn-cancelar" id="btn-cancelar-categoria">Cancelar</button>
            </div>
        </form>
        <div class="table-wrapper">
            <table class="crud-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorias as $categoria): ?>
                        <tr data-entidade='<?= json_encode($categoria) ?>'>
                            <td><?= $categoria['categoriaId'] ?></td>
                            <td><?= htmlspecialchars($categoria['nome']) ?></td>
                            <td class="actions-cell">
                                <button class="btn btn-editar btn-editar-categoria">Editar</button>
                                <form action="/controllers/categoria_controller.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="categoriaId" value="<?= $categoria['categoriaId'] ?>">
                                    <button type="submit" class="btn btn-excluir"
                                        onclick="return confirm('Tem certeza?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section id="gerenciar-idioma" class="crud-section">
        <div class="section-header">
            <h2>Idiomas Cadastrados</h2>
            <button class="btn btn-adicionar" id="btn-novo-idioma">+ Adicionar Novo Idioma</button>
        </div>
        <form id="form-idioma" class="crud-form hidden" action="/controllers/idioma_controller.php" method="POST">
            <input type="hidden" name="action" id="idiomaAction" value="create">
            <input type="hidden" name="idiomaId" id="idiomaIdForm">
            <h3 id="form-idioma-titulo">Adicionar Novo Idioma</h3>
            <div class="form-group"><label for="nomeIdioma">Nome:</label><input type="text" id="nomeIdioma" name="nome"
                    required></div>
            <div class="form-actions">
                <button type="submit" class="btn btn-salvar">Salvar</button>
                <button type="button" class="btn btn-cancelar" id="btn-cancelar-idioma">Cancelar</button>
            </div>
        </form>
        <div class="table-wrapper">
            <table class="crud-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($idiomas as $idioma): ?>
                        <tr data-entidade='<?= json_encode($idioma) ?>'>
                            <td><?= $idioma['idiomaId'] ?></td>
                            <td><?= htmlspecialchars($idioma['nome']) ?></td>
                            <td class="actions-cell">
                                <button class="btn btn-editar btn-editar-idioma">Editar</button>
                                <form action="/controllers/idioma_controller.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="idiomaId" value="<?= $idioma['idiomaId'] ?>">
                                    <button type="submit" class="btn btn-excluir"
                                        onclick="return confirm('Tem certeza?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section id="gerenciar-nacionalidade" class="crud-section">
        <div class="section-header">
            <h2>Nacionalidades Cadastradas</h2>
            <button class="btn btn-adicionar" id="btn-nova-nacionalidade">+ Adicionar Nova Nacionalidade</button>
        </div>
        <form id="form-nacionalidade" class="crud-form hidden" action="/controllers/nacionalidade_controller.php"
            method="POST">
            <input type="hidden" name="action" id="nacionalidadeAction" value="create">
            <input type="hidden" name="nacionalidadeId" id="nacionalidadeIdForm">
            <h3 id="form-nacionalidade-titulo">Adicionar Nova Nacionalidade</h3>
            <div class="form-grid">
                <div class="form-group"><label for="pais">País:</label><input type="text" id="pais" name="pais"
                        required></div>
                <div class="form-group"><label for="nomeNacionalidade">Nome (ex: Brasileiro):</label><input type="text"
                        id="nomeNacionalidade" name="nome" required></div>
                <div class="form-group">
                    <label for="idiomaIdNacionalidade">Idioma Principal:</label>
                    <select id="idiomaIdNacionalidade" name="idiomaId" required>
                        <?php foreach ($idiomas as $idioma): ?>
                            <option value="<?= $idioma['idiomaId'] ?>"><?= htmlspecialchars($idioma['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-salvar">Salvar</button>
                <button type="button" class="btn btn-cancelar" id="btn-cancelar-nacionalidade">Cancelar</button>
            </div>
        </form>
        <div class="table-wrapper">
            <table class="crud-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>País</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($nacionalidades as $nacionalidade): ?>
                        <tr data-entidade='<?= json_encode($nacionalidade) ?>'>
                            <td><?= $nacionalidade['nacionalidadeId'] ?></td>
                            <td><?= htmlspecialchars($nacionalidade['pais']) ?></td>
                            <td><?= htmlspecialchars($nacionalidade['nome']) ?></td>
                            <td class="actions-cell">
                                <button class="btn btn-editar btn-editar-nacionalidade">Editar</button>
                                <form action="/controllers/nacionalidade_controller.php" method="POST"
                                    style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="nacionalidadeId"
                                        value="<?= $nacionalidade['nacionalidadeId'] ?>">
                                    <button type="submit" class="btn btn-excluir"
                                        onclick="return confirm('Tem certeza?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabButtons = document.querySelectorAll('.tab-button');
        const crudSections = document.querySelectorAll('.crud-section');
        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                tabButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                crudSections.forEach(section => section.classList.remove('active'));
                document.querySelector(button.dataset.tab.replace('gerenciar', '#gerenciar')).classList.add('active');
            });
        });

        const setupCrudForm = (config) => {
            const form = document.getElementById(config.formId);
            const btnNovo = document.getElementById(config.btnNovoId);
            const btnCancelar = document.getElementById(config.btnCancelarId);
            const formTitulo = document.getElementById(config.formTituloId);
            const actionInput = document.getElementById(config.actionInputId);

            btnNovo.addEventListener('click', () => {
                form.reset();
                formTitulo.textContent = config.tituloAdicionar;
                actionInput.value = 'create';
                form.querySelector(`input[name="${config.idField}"]`).value = '';
                form.classList.remove('hidden');
            });

            btnCancelar.addEventListener('click', () => {
                form.classList.add('hidden');
            });

            document.querySelectorAll(config.btnEditarClass).forEach(button => {
                button.addEventListener('click', function () {
                    const row = this.closest('tr');
                    const data = JSON.parse(row.dataset.entidade);

                    form.reset();
                    formTitulo.textContent = config.tituloEditar;
                    actionInput.value = 'update';

                    config.preencherForm(form, data);

                    form.classList.remove('hidden');
                    window.scrollTo({ top: form.offsetTop - 20, behavior: 'smooth' });
                });
            });
        };

        setupCrudForm({
            formId: 'form-ator', btnNovoId: 'btn-novo-ator', btnCancelarId: 'btn-cancelar-ator', formTituloId: 'form-ator-titulo', actionInputId: 'atorAction', idField: 'idAtor', btnEditarClass: '.btn-editar-ator', tituloAdicionar: 'Adicionar Novo Ator', tituloEditar: 'Editar Ator',
            preencherForm: (form, data) => {
                form.querySelector('#idAtor').value = data.idAtor;
                form.querySelector('#nome').value = data.nome;
                form.querySelector('#sobrenome').value = data.sobrenome;
                form.querySelector('#dataNasc').value = data.dataNasc ? data.dataNasc.split(' ')[0] : '';
                form.querySelector('#nacionalidadeId').value = data.nacionalidadeId;
                form.querySelector('#imagemUrl').value = data.imagemUrl;
                const sexoRadio = form.querySelector(`input[name="sexo"][value="${data.sexo}"]`);
                if (sexoRadio) sexoRadio.checked = true;
            }
        });

        setupCrudForm({
            formId: 'form-filme', btnNovoId: 'btn-novo-filme', btnCancelarId: 'btn-cancelar-filme', formTituloId: 'form-filme-titulo', actionInputId: 'filmeAction', idField: 'idFilme', btnEditarClass: '.btn-editar-filme', tituloAdicionar: 'Adicionar Novo Filme', tituloEditar: 'Editar Filme',
            preencherForm: (form, data) => {
                form.querySelector('#idFilme').value = data.idFilme;
                form.querySelector('#titulo').value = data.título;
                form.querySelector('#anoLancamento').value = data.anoLancamento ? data.anoLancamento.split(' ')[0] : '';
                form.querySelector('#categoriaId').value = data.categoriaId;
                form.querySelector('#idiomaId').value = data.idiomaId;
                form.querySelector('#nacionalidadeIdFilme').value = data.nacionalidadeId;
                form.querySelector('#classificacaoIndicativaId').value = data.classificacaoIndicativaId;
                form.querySelector('#imagemUrl').value = data.imagemUrl;
            }
        });

        setupCrudForm({
            formId: 'form-categoria', btnNovoId: 'btn-nova-categoria', btnCancelarId: 'btn-cancelar-categoria', formTituloId: 'form-categoria-titulo', actionInputId: 'categoriaAction', idField: 'categoriaId', btnEditarClass: '.btn-editar-categoria', tituloAdicionar: 'Adicionar Nova Categoria', tituloEditar: 'Editar Categoria',
            preencherForm: (form, data) => {
                form.querySelector('#categoriaIdForm').value = data.categoriaId;
                form.querySelector('#nomeCategoria').value = data.nome;
            }
        });

        setupCrudForm({
            formId: 'form-idioma', btnNovoId: 'btn-novo-idioma', btnCancelarId: 'btn-cancelar-idioma', formTituloId: 'form-idioma-titulo', actionInputId: 'idiomaAction', idField: 'idiomaId', btnEditarClass: '.btn-editar-idioma', tituloAdicionar: 'Adicionar Novo Idioma', tituloEditar: 'Editar Idioma',
            preencherForm: (form, data) => {
                form.querySelector('#idiomaIdForm').value = data.idiomaId;
                form.querySelector('#nomeIdioma').value = data.nome;
            }
        });

        setupCrudForm({
            formId: 'form-nacionalidade', btnNovoId: 'btn-nova-nacionalidade', btnCancelarId: 'btn-cancelar-nacionalidade', formTituloId: 'form-nacionalidade-titulo', actionInputId: 'nacionalidadeAction', idField: 'nacionalidadeId', btnEditarClass: '.btn-editar-nacionalidade', tituloAdicionar: 'Adicionar Nova Nacionalidade', tituloEditar: 'Editar Nacionalidade',
            preencherForm: (form, data) => {
                form.querySelector('#nacionalidadeIdForm').value = data.nacionalidadeId;
                form.querySelector('#pais').value = data.pais;
                form.querySelector('#nomeNacionalidade').value = data.nome;
                form.querySelector('#idiomaIdNacionalidade').value = data.idiomaId;
            }
        });
    });
</script>