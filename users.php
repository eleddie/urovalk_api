<?php
require 'vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class UserResource {
    protected function validate($fields, $rules){
        $v = new Valitron\Validator($fields);
        $v->rules($rules);
        if (!$v->validate()){
            die(apiResponse(69, null));
        }
    }
    public function create($fields){
        $rules = [
                'required' => [
                    ['username'],
                    ['password']
                ],
                'lengthMin' => [
                    ['password', 6]
                ]
        ];
        $this->validate($fields, $rules);
        return Users::create([
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
        return Users::where("id", $id)->update($fields);
    }
    public function delete($id){
        $rules = ['required' => 'id'];
        $this->validate(['id' => $id], $rules);
        return Users::destroy($id);
    }
    public function index(){
        return Users::all();
    }
    public function show($id){
        $rules = ['required' => 'id'];
        $this->validate(['id' => $id], $rules);
        return Users::find($id);
    }
}
$method = $_SERVER['REQUEST_METHOD'];
$users = new UserResource();
switch($method){
    case "POST":
        $response = $users->create($_REQUEST);
        break; 
    case "GET";
        if (isset($_REQUEST['id']))
            $response = $users->show($_REQUEST['id']);
        else
            $response = $users->index();
        break;
    case "PUT";
        $response = $users->update($_REQUEST['id'], $_REQUEST);
        break;
    case "DELETE";
        $response = $users->delete($_REQUEST['id']);
        break;
    default:
        $response = null;
}
echo apiResponse(1, $response);
