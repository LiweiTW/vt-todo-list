<?php
namespace App\Services;


use App\Model\Todo;

class TodoService
{
    public function __construct() {
        //
    }

    public function create ($userId, $title, $content, $attachment) {
        $todo = new Todo();
        $todo->user_id = $userId;
        $todo->title = $title;
        $todo->content = $content;
        $todo->attachment = $attachment;
        $createStatus = $todo->save();
        return [
            "hasSuccess" => $createStatus,
            "data" => $todo,
        ];
    }

    public function update ($userId, $todoId, $title, $content, $attachment, $doneAt) {
        $result = array(
            "hasSuccess" => false,
            "data" => null,
        );


        $todo = self::get($userId, $todoId);

        if ($todo === null) {
            return $result;
        }

        $todo->title = $title;
        $todo->content = $content;
        $todo->attachment = $attachment;
        $todo->done_at =  $doneAt;

        $createStatus = $todo->save();
        return [
            "hasSuccess" => $createStatus,
            "data" => $todo,
        ];
    }

    public function getAll ($userId) {
        $todos = Todo::where("user_id", $userId)->get();
        return $todos;
    }

    public function get ($userId, $todoId) {
        $todo = Todo::where("user_id", $userId)->where("id", $todoId)->first();
        return $todo;
    }
}
