<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Madatech Task Manager</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="icon" href="<?= base_url('icons/favicon.ico') ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?= base_url('icons/favicon.ico') ?>" type="image/x-icon">
</head>
<body>
    <nav class="navbar">
        <h1 class="title">Madatech Task Manager</h1>
    </nav>

    <div class="intro">
        <h2 class="title2">Gerenciador de Tarefas</h2>
        <img src="<?= base_url('images/question.png') ?>" class="question-img" data-bs-toggle="modal" data-bs-target="#helpModal" style="cursor: pointer;">
    </div>
    
    <!-- Modal de Ajuda -->
    <div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="helpModalLabel">Entendendo o Gerenciador de Tarefas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <p>Esse Gerenciador de Tarefas permite que você:</p>
                    <ul>
                        <li>Veja todas as tarefas que foram cadastradas</li>
                        <li>Adicione uma nova tarefa, ao clicar em "Adicionar Tarefa"</li>
                        <li>Edite uma tarefa que você já cadastrou anteriormente, clicando no ícone <i class="bi bi-pencil-square"></i></li>
                        <li>Exclua uma tarefa já cadastrada clicando no ícone <i class="bi bi-trash"></i></li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-close" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5" style="max-width: 1000px;">
        <!-- Botão Adicionar -->
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTarefa">
                <i class="bi bi-plus-circle me-1"></i> Adicionar Tarefa
            </button>
        </div>

        <!-- Modal de Tarefa -->
        <div class="modal fade" id="modalTarefa" tabindex="-1" aria-labelledby="modalTarefaLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="form-tarefa">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTarefaLabel">Adicionar Nova Tarefa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título da Tarefa</label>
                                <input type="text" class="form-control" id="titulo" name="title">
                                <div class="invalid-feedback" id="erro-titulo"></div>
                            </div>
                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição</label>
                                <textarea class="form-control" id="descricao" name="description" rows="3"></textarea>
                                <div class="invalid-feedback" id="erro-descricao"></div>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="">Selecione</option>
                                    <option value="pendente">Pendente</option>
                                    <option value="em andamento">Em andamento</option>
                                    <option value="concluída">Concluída</option>
                                </select>
                                <div class="invalid-feedback" id="erro-status"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="cancelar-tarefa">Cancelar</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Salvar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal de Confirmação de Exclusão -->
        <div class="modal fade" id="confirmarExclusaoModal" tabindex="-1" aria-labelledby="confirmarExclusaoModalLabel" data-bs-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title text-white">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            Confirmar Exclusão
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja excluir esta tarefa? Esta ação não pode ser desfeita.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirmarExclusaoBtn">
                            <i class="bi bi-trash me-1"></i> Excluir
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Feedback -->
        <div class="modal fade" id="feedbackModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title modal-success text-white">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            Sucesso
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body text-center py-4">
                        <i class="bi bi-check-circle text-success" style="font-size: 3rem;"></i>
                        <p class="mt-3 mb-0" id="feedbackModalMessage"></p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-success px-4" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <table class="table table-hover table-bordered table-striped" id="tabela-tarefas">
                <thead class="table-primary">
                    <tr>
                        <th style="width: 5%;">ID</th>
                        <th style="width: 20%;">Título</th>
                        <th style="width: 15%;">Status</th>
                        <th style="width: 40%;">Descrição</th>
                        <th style="width: 20%;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- preenchido via JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        const API_LISTAR = "<?= base_url('api/listar') ?>";
        const API_CADASTRAR = "<?= base_url('api/cadastrar') ?>";
        const API_VISUALIZAR = "<?= base_url('api/visualizar') ?>"; 
        const API_ATUALIZAR = "<?= base_url('api/editar') ?>";   
        const API_EXCLUIR = "<?= base_url('api/excluir') ?>";       
    </script>
    <script src="<?= base_url('js/tarefas.js') ?>"></script>
</body>
</html>