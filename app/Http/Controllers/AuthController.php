<?php

namespace App\Http\Controllers;

use App\Http\Library\ApiHelpers;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    use ApiHelpers;

    // <---- Использование трейта apiHelpers

    public function cars(Request $request): JsonResponse
    {
        if ($this->isAdmin($request->user())) {
            $car = DB::table('cars')->get();
            return $this->onSuccess($car, 'Car Retrieved');
        }
        return $this->onError(401, 'Unauthorized Access');
    }

    public function singlePost(Request $request, $id): JsonResponse
    {
        $user = $request->user();
        if ($this->isAdmin($user) || $this->isWriter($user) || $this->isSubscriber($user)) {
            $post = DB::table('posts')->where('id', $id)->first();
            if (!empty($post)) {
                return $this->onSuccess($post, 'Post Retrieved');
            }
            return $this->onError(404, 'Post Not Found');
        }
        return $this->onError(401, 'Unauthorized Access');
    }

    public function createPost(Request $request): JsonResponse
    {
        $user = $request->user();
        if ($this->isAdmin($user) || $this->isWriter($user)) {
            $validator = Validator::make($request->all(), $this->postValidationRules());
            if ($validator->passes()) {
                $post = new Car();
                $post->title = $request->input('title');
                $post->slug = Str::slug($request->input('title'));
                $post->content = $request->input('content');
                $post->save();
                return $this->onSuccess($post, 'Post Created');
            }
            return $this->onError(400, $validator->errors());
        }
        return $this->onError(401, 'Unauthorized Access');
    }

    public function updatePost(Request $request, $id): JsonResponse
    {
        $user = $request->user();
        if ($this->isAdmin($user) || $this->isWriter($user)) {
            $validator = Validator::make($request->all(), $this->postValidationRules());
            if ($validator->passes()) {
                // Обновление сообщения
                $post = Car::all()->find($id);
                $post->title = $request->input('title');
                $post->content = $request->input('content');
                $post->save();
                return $this->onSuccess($post, 'Post Updated');
            }
            return $this->onError(400, $validator->errors());
        }
        return $this->onError(401, 'Unauthorized Access');
    }

    public function deletePost(Request $request, $id): JsonResponse
    {
        $user = $request->user();
        if ($this->isAdmin($user) || $this->isWriter($user)) {
            $post = Car::all()->find($id); // Найдем id сообщения
            $post->delete(); // Удаляем указанное сообщение
            if (!empty($post)) {
                return $this->onSuccess($post, 'Post Deleted');
            }
            return $this->onError(404, 'Post Not Found');
        }
        return $this->onError(401, 'Unauthorized Access');
    }

    public function deleteUser(Request $request, $id): JsonResponse
    {
        $user = $request->user();
        if ($this->isAdmin($user)) {
            $user = User::find($id); // Найдем id пользователя
            if ($user->role !== 1) {
                $user->delete(); // Удалим указанного пользователя
                if (!empty($user)) {
                    return $this->onSuccess('', 'User Deleted');
                }
                return $this->onError(404, 'User Not Found');
            }
        }
        return $this->onError(401, 'Unauthorized Access');
    }
}
