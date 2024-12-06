<?php


namespace App\Trait;

use App\Models\Task;
use App\Models\User;
use App\Repository\BaseRepo;
use Illuminate\Database\Eloquent\Collection;

trait BaseTrait
{
    public function getUsersByRole($role): Collection
    {
        return User::role('User')->get();
    }
    public function taskEfficiency(): float
    {
        $allTasks = (new BaseRepo())->all(new Task());
        $completedTasks = $this->getTasksByStatusId(COMPLETED_TASK)->toArray();
        return ((count($completedTasks)/count($allTasks)) * 100);
    }
    public function taskEfficiencyByUser($userId)
    {
        $allTaskCount = Task::where('assigned_user_id',$userId)->count();
        $completedTasksCount = Task::where('status_id',COMPLETED_TASK)->where('assigned_user_id',$userId)->count();
        if($allTaskCount > 0 )
        {
            return ['taskEfficiency' => (($completedTasksCount/$allTaskCount) * 100),'allTaskCount' => $allTaskCount ];
        }
        return ['taskEfficiency' => 0 , 'allTaskCount' => $allTaskCount ];
    }
    public function getTasksByStatusId($taskStatus): Collection
    {
        return Task::where('status_id',$taskStatus)->get();
    }
    // public function getTasksByUser($taskStatus): Collection
    // {
    //     return Task::where('assigned_user_id',$taskStatus)->get();
    // }

}
