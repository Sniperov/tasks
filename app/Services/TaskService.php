<?php

namespace App\Services;

use App\Models\Task;
use App\Models\User;
use App\Presenters\v1\TaskPresenter;
use App\Repositories\TaskRepository;

class TaskService extends BaseService
{
    private TaskRepository $taskRepository;

    public function __construct() {
        $this->taskRepository = new TaskRepository();
    }

    public function index(User $user, array $params)
    {
        if ($user->role === User::ROLE_CAPGUY || $user->role === User::ROLE_BANDANAGUY) {
            $params['is_approved'] = true;
        }
        else {
            $params['with_deleted'] = true;
        }
        $tasks = $this->taskRepository->index($params);
        return $this->resultCollections($tasks, TaskPresenter::class, 'list');
    }

    public function create(array $data)
    {
        $data['user_id'] = auth('api')->id();

        $task = $this->taskRepository->store($data);

        return $this->ok('Задача создана');
    }

    public function update(int $id, array $data)
    {
        $task = Task::find($id);
        if (!$task) {
            return $this->errNotFound('Задача не найдена');
        }

        $this->taskRepository->update($task, $data);

        return $this->ok('Задача обновлена');
    }

    public function delete(int $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return $this->errNotFound('Задача не найдена');
        }

        $this->taskRepository->delete($task);

        return $this->ok('Задача удалена');
    }

    public function approve(int $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return $this->errNotFound('Задача не найдена');
        }

        $this->taskRepository->approve($task);

        return $this->ok();
    }
}