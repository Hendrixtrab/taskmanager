/* 
    Arquivo que contém a base do JavaScript utilizado no frontend,
    a view que utiliza esse arquivo está em app/Views/tasks/index.php
*/

document.addEventListener("DOMContentLoaded", () => {
    // Modais
    const modalTarefa = new bootstrap.Modal(document.getElementById("modalTarefa"));
    const modalConfirmarExclusao = new bootstrap.Modal(document.getElementById("confirmarExclusaoModal"));
    const feedbackModal = new bootstrap.Modal(document.getElementById("feedbackModal"));
    
    // Variável que armazena o ID da tarefa a ser excluída
    let tarefaIdParaExcluir = null;

    // Formulário de tarefa
    const form = document.getElementById("form-tarefa");

    // Função que mostra o feedback
    function mostrarFeedback(mensagem, tipo = 'success') {
        const modal = document.getElementById('feedbackModal');
        const header = modal.querySelector('.modal-header');
        const icon = modal.querySelector('.modal-body i');
        
        // Remove classes css
        header.className = 'modal-header';
        icon.className = 'bi';
        
        // Aplica classes baseadas no tipo
        if (tipo === 'success') {
            header.classList.add('bg-success', 'text-white');
            icon.classList.add('bi-check-circle', 'text-success');
        } else if (tipo === 'error') {
            header.classList.add('bg-danger', 'text-white');
            icon.classList.add('bi-x-circle', 'text-danger');
        } else if (tipo === 'warning') {
            header.classList.add('bg-warning', 'text-dark');
            icon.classList.add('bi-exclamation-triangle', 'text-warning');
        }
        
        icon.style.fontSize = '3rem';
        document.getElementById('feedbackModalMessage').textContent = mensagem;
        feedbackModal.show();
    }

    // Carrega a tabela via axios
    
    function carregarTarefas() {
        axios.get(API_LISTAR)
        // ATENÇÃO: API_LISTAR, API_CADASTRAR, API_VISUALIZAR, API_ATUALIZAR e API_EXCLUIR
        // são constantes passadas dentro da view app/Views/tasks/index.php
            .then(response => {
                const tarefas = response.data;
                const tbody = document.querySelector("#tabela-tarefas tbody");
                tbody.innerHTML = ""; 

                tarefas.forEach(tarefa => {
                    const tr = document.createElement("tr");
                    tr.innerHTML = `
                        <td>${tarefa.id}</td>
                        <td>${tarefa.title}</td>
                        <td>${tarefa.status}</td>
                        <td>${tarefa.description}</td>
                        <!-- Ícones que ficam na área "Ações" -->
                        <td class="text-center">
                            <button class="btn-action edit btn-editar" data-id="${tarefa.id}" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn-action delete btn-excluir" data-id="${tarefa.id}" title="Excluir">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });

                // Adiciona eventos aos botões de edição
                document.querySelectorAll('.btn-editar').forEach(btn => {
                    btn.addEventListener('click', editarTarefa);
                });

                // Adiciona eventos aos botões de exclusão
                document.querySelectorAll('.btn-excluir').forEach(btn => {
                    btn.addEventListener('click', abrirModalConfirmacaoExclusao);
                });
            })
            .catch(error => {
                console.error("Erro ao buscar tarefas:", error);
                mostrarFeedback("Erro ao carregar tarefas.", 'error');
            });
    }

    // Carrega as tarefas inicialmente
    carregarTarefas();

    // Botão de cancelar no modal de tarefa
    document.getElementById("cancelar-tarefa").addEventListener("click", () => {
        form.reset();
        limparErros();
        form.removeAttribute('data-id');
        document.getElementById('modalTarefaLabel').textContent = 'Adicionar Nova Tarefa';
        modalTarefa.hide();
    });

    // Submit do formulário de tarefa
    form.addEventListener("submit", function(e) {
        e.preventDefault();
        limparErros();

        const dados = {
            title: form.title.value.trim(),
            description: form.description.value.trim(),
            status: form.status.value
        };

        const tarefaId = form.getAttribute('data-id');
        
        if (tarefaId) {
            // Atualizar tarefa existente
            axios.put(`${API_ATUALIZAR}/${tarefaId}`, dados)
                .then(response => {
                    const res = response.data;
                    if (res.message === "Tarefa atualizada com sucesso.") {
                        mostrarFeedback("✅ " + res.message);
                        form.reset();
                        form.removeAttribute('data-id');
                        document.getElementById('modalTarefaLabel').textContent = 'Adicionar Nova Tarefa';
                        modalTarefa.hide();
                        carregarTarefas();
                    }
                })
                .catch(error => {
                    tratarErrosFormulario(error);
                });
        } else {
            // Criar nova tarefa
            axios.post(API_CADASTRAR, dados)
                .then(response => {
                    const res = response.data;
                    if (res.message === "Tarefa criada com sucesso.") {
                        mostrarFeedback("✅ " + res.message);
                        form.reset();
                        modalTarefa.hide();
                        carregarTarefas();
                    }
                })
                .catch(error => {
                    tratarErrosFormulario(error);
                });
        }
    });

    // Função para abrir o modal de confirmação de exclusão
    function abrirModalConfirmacaoExclusao(event) {
        tarefaIdParaExcluir = event.target.closest('button').getAttribute('data-id');
        modalConfirmarExclusao.show();
    }


    // Evento do botão de confirmar exclusão
    document.getElementById('confirmarExclusaoBtn').addEventListener('click', () => {
        if (tarefaIdParaExcluir) {
            axios.delete(`${API_EXCLUIR}/${tarefaIdParaExcluir}`)
                .then(response => {
                    const res = response.data;
                    if (res.message === "Tarefa excluída com sucesso.") {
                        modalConfirmarExclusao.hide();
                        mostrarFeedback("✅ " + res.message);
                        carregarTarefas();
                    }
                })
                .catch(error => {
                    console.error("Erro ao excluir tarefa:", error);
                    modalConfirmarExclusao.hide();
                    mostrarFeedback("Erro ao excluir tarefa.", 'error');
                });
        }
    });

    // Função para editar tarefa
    function editarTarefa(event) {
        const tarefaId = event.target.closest('button').getAttribute('data-id');
        
        axios.get(`${API_VISUALIZAR}/${tarefaId}`)
            .then(response => {
                const tarefa = response.data;
                
                // Preenche o formulário com os dados da tarefa
                form.title.value = tarefa.title;
                form.description.value = tarefa.description;
                form.status.value = tarefa.status;
                
                // Marca o formulário como edição
                form.setAttribute('data-id', tarefaId);
                
                // Altera o título do modal
                document.getElementById('modalTarefaLabel').textContent = 'Editar Tarefa';
                
                // Abre o modal
                modalTarefa.show();
            })
            .catch(error => {
                console.error("Erro ao buscar tarefa:", error);
                mostrarFeedback("Erro ao carregar tarefa para edição.", 'error');
            });
    }

    // Função para tratar erros do formulário
    function tratarErrosFormulario(error) {
        if (error.response && error.response.status === 400) {
            const erros = error.response.data.messages;
            if (erros.title) {
                form.title.classList.add("is-invalid");
                document.getElementById("erro-titulo").innerText = erros.title;
            }
            if (erros.description) {
                form.description.classList.add("is-invalid");
                document.getElementById("erro-descricao").innerText = erros.description;
            }
            if (erros.status) {
                form.status.classList.add("is-invalid");
                document.getElementById("erro-status").innerText = erros.status;
            }
        } else {
            mostrarFeedback("Erro ao salvar a tarefa.", 'error');
            console.error(error);
        }
    }

    function limparErros() {
        form.title.classList.remove("is-invalid");
        form.description.classList.remove("is-invalid");
        form.status.classList.remove("is-invalid");

        document.getElementById("erro-titulo").innerText = "";
        document.getElementById("erro-descricao").innerText = "";
        document.getElementById("erro-status").innerText = "";
    }
});