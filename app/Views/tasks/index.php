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
</head>
<body>
    <nav class="navbar">
        <h1 class="title">Madatech Task Manager</h1>
    </nav>

    <div class="container">
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
                    Instruções de Uso
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-close" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <table class="table table-hover table-bordered table-striped" id="tabela-tarefas">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Status</th>
                    <th>Data de Criação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- preenchido via JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- Axios que lista as tarefas pelo banco de dados -->
    <!--
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            axios.get("<?= base_url('api/tarefas') ?>")
                .then(response => {
                    const tarefas = response.data;
                    const tbody = document.querySelector("#tabela-tarefas tbody");

                    tarefas.forEach(tarefa => {
                        const tr = document.createElement("tr");

                        tr.innerHTML = `
                            <td>${tarefa.id}</td>
                            <td>${tarefa.titulo}</td>
                            <td>${tarefa.status}</td>
                            <td>${tarefa.created_at}</td>
                            <td>
                                <button class="btn btn-sm btn-primary">Editar</button>
                                <button class="btn btn-sm btn-danger">Excluir</button>
                            </td>
                        `;

                        tbody.appendChild(tr);
                    });
                })
                .catch(error => {
                    console.error("Erro ao buscar tarefas:", error);
                    alert("Erro ao carregar tarefas.");
                });
        });
    </script>
    -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>
</html>