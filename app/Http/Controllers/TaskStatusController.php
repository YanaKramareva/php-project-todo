<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TaskStatus::class, 'task_status');
    }

    public function index(): Factory|View|Application
    {
        $taskStatuses = TaskStatus::orderBy('id', 'asc')->paginate();
        return view('task_statuses.index', compact('taskStatuses'));
    }

    public function create()
    {
        $taskStatus = new TaskStatus();
        return view('task_statuses.create', compact('taskStatus'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $taskStatusInputData = $this->validate(
            $request,
            [
            'name' => 'required|in:done,not done|unique:task_statuses'
            ],
            $messages = [
            'in' => __('validation.The status name should be "done" or "not done"'),
                 'unique' => __('validation.The status name has already been taken')
            ]
        );
        $taskStatus = new TaskStatus();
        $taskStatus->fill($taskStatusInputData);
        $taskStatus->save();
        flash(__('taskStatuses.Status has been added successfully'))->success();
        return redirect()
            ->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus): Factory|View|Application
    {
        return view('task_statuses.edit', compact('taskStatus'));
    }

    public function update(Request $request, TaskStatus $taskStatus): \Illuminate\Http\RedirectResponse
    {
        $taskStatusInputData = $this->validate(
            $request,
            [
            'name' => 'required|in:done,not done|unique:task_statuses,name,' . $taskStatus->id
            ],
            $messages = [
            'unique' => __('validation.The status name has already been taken'),
            'max' => __('validation.The status name should be "done" or "not done"'),
            ]
        );
        $taskStatus->fill($taskStatusInputData);
        $taskStatus->save();
        flash(__('taskStatuses.Status has been updated successfully'))->success();
        return redirect()
            ->route('task_statuses.index');
    }

    public function destroy(TaskStatus $taskStatus): \Illuminate\Http\RedirectResponse
    {
        if ($taskStatus->tasks()->exists()) {
            flash(__('taskStatuses.Failed to delete status'))->error();
            return back();
        }
        $taskStatus->delete();
        flash(__('taskStatuses.Status has been deleted successfully'))->success();
        return redirect()
            ->route('task_statuses.index');
    }
}
