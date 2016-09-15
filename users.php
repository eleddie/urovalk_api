<?php
require 'vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class UserResource extends Resource {
    public function __construct(){
        return $this;
    }
    public function login(){
        $rules = [
                'required' => [
                    ['username'],
                    ['token']
                ]
        ];
        $this->validate($fields, $rules);
        $user = User::where('username', $fields['username'])->where('password', hash('sha256', $fields['token']))->first();
        if (empty($user))
            return apiResponse(1, "LoggedIn");
        else
            return apiResponse(9, "User not found");
    }
    public function create($fields){
        $rules = [
                'required' => [
                    ['username'],
                    ['password']
                ],
                'lengthMin' => [
                    ['password', 6]
                ],
                'notIn' => [
                    ['username', User::lists('username') ]
                ]
        ];
        $this->validate($fields, $rules);
        return User::create([
            'username' => $fields['username'],
            'password' => hash('sha256', $fields['password'])
        ]);
    }
    public function update($id, $fields){
        $rules = [
                'required' => [
                    ['username'],
                    ['password'],
                    ['id']
                ],
                'lengthMin' => [
                    ['password', 6]
                ]
        ];
        $this->validate(array_merge($fields, ['id' => $id]), $rules);
        return User::where("id", $id)->update($fields);
    }
    public function delete($id){
        $rules = ['required' => 'id'];
        $this->validate(['id' => $id], $rules);
        return User::destroy($id);
    }
    public function index(){
        return User::all();
    }
    public function show($id){
        $rules = ['required' => 'id'];
        $this->validate(['id' => $id], $rules);
        return User::find($id);
    }
}
echo apiResponse(1, Resource::run(new UserResource, $_SERVER['REQUEST_METHOD']));