<?php

namespace App\Http\Controllers;

use App\Mail\TaskNotificationMail;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repository\BaseRepo;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public $baseRepo;

    public function __construct(BaseRepo $baseRepo) {
        $this->baseRepo = $baseRepo;
    }
    public function myTasks()
    {
        // $myTasks = Auth::user()->tasks()->get();
        $statuses = $this->baseRepo->all(new Status());
        $myTasks = Auth::user()->tasks()->with(['status', 'priority'])->get();

        return view('user.tasks',compact('myTasks','statuses'));
    }
    public function updateTaskStatus($taskId, $statusId)
    {
        $task = $this->baseRepo->find(new Task(),$taskId);
        $taskCreator = $this->baseRepo->find(new User(),$task->created_by);
        $task->status_id = $statusId;
        $task->save();
        //send mail notification to manager
        Mail::to($taskCreator->email)->send(new TaskNotificationMail($taskCreator, "New Task Is Assigned To you", route('manager.addedTasks')));
        return response()->json(['status'=>'success']);
    }
    public function dashboard()
    {
        return view('user.dashboard');
    }
}
