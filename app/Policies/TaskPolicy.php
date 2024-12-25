<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user can create tasks.
     */
    public function create(User $user)
    {
        return true; // Tất cả người dùng đều có thể tạo task
    }

    /**
     * Determine if the user can update the task.
     */
    public function update(User $user, Task $task)
    {
        return $user->id === $task->user_id; // Chỉ người dùng sở hữu task mới có thể chỉnh sửa
    }

    /**
     * Determine if the user can delete the task.
     */
    public function delete(User $user, Task $task)
    {
        return $user->id === $task->user_id; // Chỉ người dùng sở hữu task mới có thể xóa
    }
}
