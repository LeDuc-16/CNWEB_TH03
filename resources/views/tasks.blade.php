@extends('layouts.app')


@section('content')
    <div class="container p-4">
        <div class="card mb-4">
            <p class="card-header lead fw-light">
                New Task
            </p>
            
            @include('common.errors')
            @include('common.success')

            <div class="card-body">
                <form action="{{ url('tasks') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="task" class="form-label fw-4 lead">Task</label>
                        <input type="text" class="form-control" id="task-name" name="name">
                    </div>

                    <!--add button-->

                    <button type="submit" class="btn btn-light text-dark fw-light lead">
                        <i class="bi bi-plus-square-fill me-3"></i> Add Task
                    </button>

                </form>
            </div>
        </div>

        <!--current task-->
        @if (count($tasks) > 0)
            <div class="card mb-4">
                <p class="card-header lead fw-light">
                    Current Tasks
                </p>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            </tr>
                        </thead>
                        <tbody>
                            <!--first task-->
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <!-- Task name -->
                                            <p class="lead mb-0">{{ $task->name }}</p>

                                            <div class="d-flex">
                                                <!-- Delete button -->
                                                <form action="{{ url('task/' . $task->id) }}" method="POST" class="mb-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger me-2">
                                                        <i class="bi bi-trash3-fill"></i> Delete
                                                    </button>
                                                </form>

                                                <!-- Read button -->
                                                <form action="{{ url('task/' . $task->id) }}" method="GET">
                                                    @csrf
                                                    <button class="btn btn-primary">
                                                        <i class="bi bi-eye-fill"></i> Detail
                                                    </button>
                                                </form>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    </div>
    @endif
@endsection
