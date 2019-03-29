<?php

namespace App\Http\Controllers;

use App\Model\Todo;
use App\Services\TodoService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TodoController extends Controller
{
    private $todoService;

    public function __construct(TodoService $todoService) {
        $this->todoService = $todoService;
    }

    public function getTodo (Request $request, $todoId) {
        $userId = $request->input("userId", "");
        $result = $this->todoService->get($userId, $todoId);
        return response()->json(array(
            "data" => $result,
        ));
    }

    public function getTodos (Request $request) {
        $userId = $request->input("userId", "");

        $result = $this->todoService->getAll($userId);
        return response()->json(array(
            "data" => $result,
        ));
    }

    public function createTodo (Request $request) {
        $userId = $request->input("userId", "");
        $title = $request->input("title", "");
        $content = $request->input("content", "");
        $attachment = $request->input("attachment", "");

        $result = $this->todoService->create($userId, $title, $content, $attachment);
        return response()->json($result);
    }

    public function updateTodo (Request $request, $todoId) {
        $userId = $request->input("userId", "");
        $title = $request->input("title", "");
        $content = $request->input("content", "");
        $attachment = $request->input("attachment", "");
        $doneAt = $request->input("doneAt", 0);

        $result = $this->todoService->update($userId, $todoId, $title, $content, $attachment, $doneAt);
        return response()->json($result);
    }
}
