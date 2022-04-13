<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\ApproveTaskRequest;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\IndexTasksRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends ApiController
{
    private TaskService $taskService;

    public function __construct() {
        $this->taskService = new TaskService();
    }

    public function index(IndexTasksRequest $request)
    {
        $params = $request->validated();
        return $this->result($this->taskService->index($this->authUser(), $params));
    }

    public function create(CreateTaskRequest $request)
    {
        $data = $request->validated();
        return $this->result($this->taskService->create($data));
    }

    public function update($id, UpdateTaskRequest $request)
    {
        $data = $request->validated();
        return $this->result($this->taskService->update($id, $data));
    }

    public function delete($id)
    {
        return $this->result($this->taskService->delete($id));
    }

    public function approve($id, ApproveTaskRequest $request)
    {
        $request->validated();
        return $this->result($this->taskService->approve($id));
    }
}
