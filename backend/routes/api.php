<?php

use App\Member;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/projects', function (Request $request) {
    return Project::with('members')->get();
});

//http://localhost:8000/api/projectsby?user=Bob
Route::get('/projectsby', function (Request $request) {
    return Project::with(['members'=>function ($query) use ($request) {
        $query->where('name','like', '%'.$request['user'].'%');
    },"members.tasks"])->whereHas('members', function ($query) use ($request) {
        $query->where('name', 'like', '%' . $request['user'] . '%');
    })->get();
});

//http://localhost:8000/api/projectstasks?project=Alpha
Route::get('/projectstasks', function (Request $request) {
    return Project::where('name','like', '%'.$request['project'].'%')->with(['tasks',"tasks.member"])->get();
});

Route::get('/members', function (Request $request) {
    return Member::with('projects')->get();
});
