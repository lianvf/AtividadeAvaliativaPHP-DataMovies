<link rel="stylesheet" href="/components/gerenciamento/gerenciamento.css">

<div class="gerenciamento-container">
    <h1>Gerenciamento</h1>

    <nav class="crud-nav">
        <button class="tab-button active" data-tab="gerenciar-ator">Gerenciar Atores</button>
        <button class="tab-button" data-tab="gerenciar-filme">Gerenciar Filmes</button>
    </nav>

    <section id="gerenciar-ator" class="crud-section active">
        <div class="section-header">
            <h2>Atores Cadastrados</h2>
            <button class="btn btn-adicionar" id="btn-novo-ator">+ Adicionar Novo Ator</button>
        </div>

        <form id="form-ator" class="crud-form hidden" action="backend/ator_salvar.php" method="POST">
            <input type="hidden" name="idAtor" id="idAtor">
            <h3>Adicionar / Editar Ator</h3>
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="sobrenome">Sobrenome:</label>
                    <input type="text" id="sobrenome" name="sobrenome" required>
                </div>
                <div class="form-group">
                    <label for="dataNasc">Data de Nascimento:</label>
                    <input type="date" id="dataNasc" name="dataNasc">
                </div>
                <div class="form-group">
                    <label for="nacionalidadeId">Nacionalidade:</label>
                    <select id="nacionalidadeId" name="nacionalidadeId">
                        <option value="1">Brasileiro</option>
                        <option value="2">Norte-Americano</option>
                        <option value="3">Britânico</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Sexo:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="sexo" value="M"> M</label>
                        <label><input type="radio" name="sexo" value="F"> F</label>
                    </div>
                </div>
                <div class="form-group full-width">
                    <label for="atorImagemURL">URL da Imagem:</label>
                    <input type="text" id="atorImagemURL" name="atorImagemURL">
                </div>
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
                        <th>Data de Nasc.</th>
                        <th>Nacionalidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Cillian Murphy</td>
                        <td>1976-05-25</td>
                        <td>Irlandês</td>
                        <td>
                            <button class="btn btn-editar">Editar</button>
                            <button class="btn btn-excluir">Excluir</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Wagner Moura</td>
                        <td>1976-06-27</td>
                        <td>Brasileiro</td>
                        <td>
                            <button class="btn btn-editar">Editar</button>
                            <button class="btn btn-excluir">Excluir</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section id="gerenciar-filme" class="crud-section">
        <div class="section-header">
            <h2>Filmes Cadastrados</h2>
            <button class="btn btn-adicionar" id="btn-novo-filme">+ Adicionar Novo Filme</button>
        </div>

        <form id="form-filme" class="crud-form hidden" action="backend/filme_salvar.php" method="POST">
             <h3>Adicionar / Editar Filme</h3>
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
                        <th>Ano</th>
                        <th>Categoria</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Oppenheimer</td>
                        <td>2023-07-21</td>
                        <td>Biografia</td>
                        <td>
                            <button class="btn btn-editar">Editar</button>
                            <button class="btn btn-excluir">Excluir</button>
                        </td>
                    </tr>
                     <tr>
                        <td>2</td>
                        <td>Tropa de Elite</td>
                        <td>2007-10-05</td>
                        <td>Ação/Policial</td>
                        <td>
                            <button class="btn btn-editar">Editar</button>
                            <button class="btn btn-excluir">Excluir</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const crudSections = document.querySelectorAll('.crud-section');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            tabButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            crudSections.forEach(section => {
                section.classList.remove('active');
                if (section.id === button.dataset.tab) {
                    section.classList.add('active');
                }
            });
        });
    });

    const setupFormToggle = (btnId, formId, cancelBtnId) => {
        const novoBtn = document.getElementById(btnId);
        const form = document.getElementById(formId);
        const cancelarBtn = document.getElementById(cancelBtnId);

        novoBtn.addEventListener('click', () => form.classList.remove('hidden'));
        cancelarBtn.addEventListener('click', () => form.classList.add('hidden'));
    };

    // Configura os botões e formulários de cada seção
    setupFormToggle('btn-novo-ator', 'form-ator', 'btn-cancelar-ator');
    setupFormToggle('btn-novo-filme', 'form-filme', 'btn-cancelar-filme');
});
</script>