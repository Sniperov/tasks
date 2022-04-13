<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository
{
    public function store(array $data) : Task
    {
        return Task::create($data);
    }

    public function update(Task $task, array $data) : void
    {
        $task->update($data);
    }

    public function delete(Task $task) : void
    {
        $task->delete();
    }

    public function approve(Task $task) : void
    {
        $task->update(['is_approved' => true]);
    }

    public function index(array $params) : Collection
    {
        $query = Task::with('user');
        $query = $this->queryApplyFilter($query, $params);
        $query = $this->queryApplyPagination($query, $params);
        $query = $this->queryApplyOrderBy($query, $params);

        return $query->get();
    }

    protected function queryApplyFilter($query, $params)
    {
        if (!empty($params['filter'])) {
            $query->where(function ($subQuery) use ($params) {
                $subQuery->where('title', 'like', '%' . $params['filter'] . '%')
                    ->orWhere('description', 'like', '%' . $params['filter'] . '%');
            });
        }

        if (!empty($params['is_approved'])) {
            $query->where('is_approved', $params['is_approved']);
        }

        if (!isset($params['with_deleted'])) {
            $query->withTrashed();
        }

        return $query;
    }

    protected function queryApplyPagination($query, $params)
    {
        if (isset($params['startRow'])) {
            $query->offset($params['startRow']);
        }
        if (isset($params['rowsPerPage'])) {
            $query->limit($params['rowsPerPage']);
        } else {
            $query->limit(100);
        }
        return $query;
    }

    protected function queryApplyOrderBy($query, $params)
    {
        $desc = 'asc';
        if (isset($params['descending']) && $params['descending'] == 'true') {
            $desc = 'desc';
        }

        if (isset($params['sortBy'])) {
            $query->orderBy($params['sortBy'], $desc);
        }
        return $query;
    }
}