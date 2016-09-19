<?php
require 'vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class UserResource extends Resource {
    public function __construct(){
        return $this;
    }
    public function login($fields){
        $rules = [
                'required' => [
                    ['username'],
                    ['password']
                ]
        ];
        $this->validate($fields, $rules);
        $user = User::where('username', $fields['username'])->where('password', hash('sha256', $fields['password']))->first();
        if (empty($user)){
            return ["code" => 2, "response" => "Username or password incorrect"];
        } else
            return ["code" => 1, "response" => $user];
    }
    public function create($fields){
        $rules = [
                'required' => [
                    ['name'],
                    ['lastname'],
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
        return ['code' => 1, "response" => User::create([
            'name' => $fields['name'],
            'lastname' => $fields['lastname'],
            'username' => $fields['username'],
            'password' => hash('sha256', $fields['password']),
            'token' => hash('sha256', $fields['username'])
        ])];
    }
    public function update($fields){
        $rules = [
                'required' => [
                    ['id'],
                    ['token']
                ],
                'lengthMin' => [
                    ['password', 6]
                ]
        ];
        $this->validate($fields, $rules);
        return ['code'=> 1, "response" => User::where("id", $id)->update($fields)];
    }
    public function delete($fields){
         $rules = [
                'required' => [
                    ['id'],
                    ['token']
                ]
         ];
        $this->validate(['id' => $id], $rules);
        return ['code' => 1, "response" => User::destroy($id)];
    }
    public function index($fields){
        $rules = ['required' => 'token'];
        $this->validate($fields, $rules);
        return ["code" => 1,"response" => User::all()];
    }
    public function show($fields){
        $rules = [
                'required' => [
                    ['id'],
                    ['token']
                ]
        ];
        $this->validate($fields, $rules);
        return ["code" => 1, "response" => User::find($id)];
    }
}
echo apiResponse(Resource::run(new UserResource, $_SERVER['REQUEST_METHOD']));