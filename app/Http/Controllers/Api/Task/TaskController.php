<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Task\TaskStoreRequest;
use App\Models\Note;
use App\Models\Task;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function getTasks(Request $request): JsonResponse
    {
        try {
            $filter = $request->all()['filter'] ?? [];

            $status = $filter['status'] ?? Config::get('constants.task_status');
            $priority = $filter['priority'] ?? Config::get('constants.task_priority');

            $due_date = $filter['due_date'] ?? null;
            $notes = $filter['notes'] ?? null;

            $tasks = Task::with('notes')->withCount('notes');

            if ($notes) {
                $tasks->has('notes');
            }

            if ($due_date) {
                $tasks->whereDate('due_date', $due_date);
            }

            $tasks->priority($priority)->status($status);

            $tasks = $tasks->orderByRaw("FIELD(priority, 'High', 'Medium', 'Low')")->orderBy('notes_count','asc')->paginate(10);

            if ($tasks->count()) {
                return apiResponse(true, 'Task fetched successfully', $tasks, 200);
            }
            return apiResponse(true, 'No tasks found', '', 206);
        } catch (Exception $e) {
            return apiResponse(false, 'Something Went Wrong', $e->getMessage(), 500);
        }
    }

    public function storeTask(TaskStoreRequest $request): JsonResponse
    {
        try {
            $requestData = $request->validated();
            
            $task = Task::create($requestData);
            
            if (isset($requestData['notes'])) {
                
                $notesData = collect($requestData['notes']);
                
                $notesData = $notesData->map(function ($item) use ($task) {
                    $files = $this->storeFiles($item['attachment'], $task->id);
                    $item['attachment'] = json_encode($files);
                    $item['task_id'] = $task->id;
                    return $item;
                });

                Note::insert($notesData->all());
            }
            if ($task) {
                return apiResponse(true, 'Task stored successfully', $task, 200);
            }
            return apiResponse(true, 'Task Store Failed.', '', 400);
        } catch (Exception $e) {
            return apiResponse(false, 'Something Went Wrong', $e->getMessage(), 500);
        }
    }


    private function storeFiles(array $files, $task_id): array
    {
        $filesPath = [];
        foreach ($files as $file) {

            $file = $file['file'];
            $filename = $file->getClientOriginalName(); // no unique name for now !

            Storage::putFileAs('public/' . $task_id, $file, $filename);

            $filePath = 'storage/' . $task_id .'/'. $filename;

            $filesPath[] = $filePath;
        }
        return $filesPath;
    }
}
