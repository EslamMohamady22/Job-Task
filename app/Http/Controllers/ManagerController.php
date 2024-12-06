<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Mail\TaskNotificationMail;
use App\Models\Priority;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use App\Repository\BaseRepo;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Trait\BaseTrait;
use Illuminate\Support\Facades\Mail;

class ManagerController extends Controller
{
    use BaseTrait;
    public $repoBase;
    public function __construct()
    {
        $this->repoBase = new BaseRepo();
    }
    public function createTask(): View
    {

        $priorities = $this->repoBase->all(new Priority());
        $users = $this->getUsersByRole('User');
        return view('manager.createTask',compact('priorities','users'));
    }
    public function storeTask(TaskRequest $request): RedirectResponse
    {
        $input = $request->except(['_token']);
        $input['created_by'] = Auth::id();
        $user = $this->repoBase->find(new User(), $input['assigned_user_id']);
        $this->repoBase->store(new Task(),$input);
        //send mail notification to user
        Mail::to($user->email)->send(new TaskNotificationMail($user, "New Task Is Assigned To you", route('user.myTasks')));
        return redirect()->back()->with('message','Task Added Successfully');
    }
    public function addedTasks()
    {
        $managerTasks = Task::where('created_by',Auth::id())->get();
        return view('manager.tasks',compact('managerTasks'));
    }
    public function editTask($taskId)
    {
        $task = $this->repoBase->find(new Task(), $taskId);
        $priorities = $this->repoBase->all(new Priority());
        $users = $this->getUsersByRole('User');
        $statuses = $this->repoBase->all(new Status());
        return view('manager.editTask',compact('task','priorities','users','statuses'));
    }
    public function updateTask(UpdateTaskRequest $request, $taskId): RedirectResponse
    {
        $inputs = $request->except(['_method','_token']);
        $inputs['created_by'] = Auth::id();
        $this->repoBase->update(new Task(), $taskId, $inputs);
        return redirect()->back()->with('message','Task Updated Successfully');

    }
    public function dashboard()
    {
        return view('manager.dashboard');
    }
    public function taskEfficiency()
    {
        return $this->taskEfficiency();
    }

}
