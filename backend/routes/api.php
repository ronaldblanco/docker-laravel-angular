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

//http://localhost:8000/api/projects?offset=0&limit=100&member=bob
Route::get('/projects', function (Request $request) {
    $result = Project::with(["tasks", "tasks.member"]);
    if($request['member'] == null) return $result->with(['members', "members.tasks"])->skip($request['offset']?$request['offset']:0)->take($request['limit']?$request['limit']:100)->get();
    else return $result->with(['members'=>function ($query) use ($request) {
        $query->where('name','like', '%'.$request['member'].'%');
    },"members.tasks"])->whereHas('members', function ($query) use ($request) {
        $query->where('name', 'like', '%' . $request['member'] . '%');
    })->with(['members', "members.tasks"])->skip($request['offset']?$request['offset']:0)->take($request['limit']?$request['limit']:100)->get();
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

//http://localhost:8000/api/members
Route::get('/members', function (Request $request) {
    return Member::with('projects')->get();
});
