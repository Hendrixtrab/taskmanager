<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;

class TaskController extends ResourceController
{

    protected $modelName = TaskModel::class;
    protected $format = 'json';

    //Lista todas as tarefas 
    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    //Cria uma nova tarefa 
    public function create()
    {
        $dados = $this->request->getJSON(true);

        if (!$this->model->insert($dados)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated(['message' => 'Tarefa criada com sucesso.']);
    }

    //Visualiza uma tarefa específica
    public function show($id = null)
    {
        $tarefa = $this->model->find($id);

        if (!$tarefa) {
            return $this->failNotFound('Tarefa não encontrada.');
        }

        return $this->respond($tarefa);
    }

    //Atualiza uma tarefa existente
    public function update($id = null)
    {
        $dados = $this->request->getJSON(true);

        if (!$this->model->find($id)) {
            return $this->failNotFound('Tarefa não encontrada.');
        }
        if(!$this->model->update($id, $dados)){
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond(['message' => 'Tarefa atualizada com sucesso.']);
    }

    //Exclui uma tarefa existente
    public function delete($id = null)
    {
        if(!$this->model->find($id)){
            return $this->failNotFound('Tarefa não encontrada');
        }
        
        $this->model->delete($id);
        return $this->respondDeleted(['message' => 'Tarefa excluída com sucesso.']);
    }
}
