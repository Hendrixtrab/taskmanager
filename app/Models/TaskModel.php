<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table            = 'tasks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'description', 'status'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    //Casts -> Não utilizados, não há a necessidade de converter tipos
    /*
    protected array $casts = [];
    protected array $castHandlers = [];
    */

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';    -> Não utilizados, não há a presença de soft deletes no projeto

    // Validation
    protected $validationRules = [
        'title' => 'required|min_length[1]|max_length[255]',
        'description' => 'permit_empty|string',
        'status' => 'permit_empty|in_list[pendente,em andamento,concluída]',
    ];

    protected $validationMessages   = [
        'title' => [
            'required' => 'O título da tarefa é obrigatório.',
            'min_length' => 'O título deve possuir ao menos 1 caractere.',
            'max_length' => 'O título pode ter no máximo 255 caracteres.'
        ],
        'status' => [
            'in_list' => 'O status da tarefa deve ser: pendente, em andamento ou concluída.'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    protected $allowCallbacks = true;
    protected $beforeInsert   = ['definirStatusPadrao'];

    protected function definirStatusPadrao(array $data)
    {
        if (empty($data['data']['status'])) {
            $data['data']['status'] = 'pendente';
        }

        return $data;
    }

    // Callbacks não utilizados
    /*
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    */
}
