<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationRequest;
use App\Models\Task;
use App\Models\User;
use App\Repository\BaseRepo;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Trait\BaseTrait;


class AdminController extends Controller
{
    use BaseTrait;
    public $repoBase;
    public function __construct()
    {
        $this->repoBase = new BaseRepo();
    }
    public function createManager(): View
    {
        return view('admin.add_manager');
    }
    public function createAdmin(): View
    {
        return view('admin.add_admin');
    }
    public function storeManager(ValidationRequest $request): RedirectResponse
    {
        $this->AdminStore($request, 'Manager');
        return redirect()->back();
    }
    public function storeAdmin(ValidationRequest $request): RedirectResponse
    {
        $this->AdminStore($request, 'Admin');
        return redirect()->back();
    }
    public function AdminStore($request, $role): RedirectResponse
    {
        $input = $request->except(['_token']);
        $user = $this->repoBase->store(new User(),$input);
        $user->assignRole($role);
        return redirect()->back();
    }
    public function allTasks(): View
    {
        $allTasks = $this->repoBase->all(new Task());
        return view('admin.tasks',compact('allTasks'));
    }

    public function dashboard(): View
    {
        $userCountByRole = User::with('roles')->get()->groupBy(function($user) {
            return $user->getRoleNames()->first();
        })->map(function($users) {
            return $users->count();
        });

        $taskCountByStatus = Task::with('status')->orderBy('status_id')->get()->groupBy('status.name')->map(function ($tasks) {
            return $tasks->count();
        })->toArray();


        $taskCountByPriority = Task::with('priority')->orderBy('priority_id')->get()->groupBy('priority.name')->map(function ($tasks) {
            return $tasks->count();
        })->toArray();

        $averageCompletionTime = Task::where('status_id',3) // Only completed tasks
        ->selectRaw('AVG(TIMESTAMPDIFF(SECOND, created_at, updated_at)) as avg_time')
        ->value('avg_time');

        $averageCompletionTimeFormatted = gmdate('H:i:s', $averageCompletionTime);

        $taskEfficiency = $this->taskEfficiency();

        return view('admin.dashboard',compact('userCountByRole','taskCountByStatus','taskCountByPriority','averageCompletionTimeFormatted','taskEfficiency'));
    }

    //getAllUsersWithTaskEfficiency
    public function allUsers()
    {
        // $users = $this->repoBase->all(new User());
        $allUsers = User::role('User')->with('tasks')->get();
        $allUsers = $allUsers->map(function($user){
            $task = $this->taskEfficiencyByUser($user->id);
            $user['taskEfficiency'] = $task['taskEfficiency'];
            $user['allTaskCount'] = $task['allTaskCount'];;
            return $user;
        });
        // dd($users);
        return view('admin.all_users',compact('allUsers'));
    }

}
