<?php
require 'vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ProductResource extends Resource {
    public function create($fields){
        $rules = [
                'required' => [
                    ['name'],
                    ['serial'],
                    ['stock'],
                    ['price'],
                    ['token']
                ]
        ];
        $this->validate($fields, $rules);
        $user = User::where("token", $fields['token'])->first();
        if(empty($user)){
            return ["code" => 2, "response" => "Invalid token"];
        }
        $record = Product::where('serial', $fields['serial'])->first();
        if(empty($record))
            return ['code' => 1, 'response' => Product::create($fields)];
        else
            $record->stock += $fields['stock'];
            return ['code' => 1, 'response' => $record->save()];
    }
    public function update($fields){
        $rules = [
                'required' => [
                    ['id'],
                    ['token']
                ]
        ];
        $this->validate($fields, $rules);
        return ["code" => 1, "response" => Product::where("id", $id)->update($fields)];
    }
    public function delete($fields){
        $rules = [
                'required' => [
                    ['id'],
                    ['token']
                ]
        ];
        $this->validate($fields, $rules);
        $user = User::where("token", $fields['token'])->first();
        if(empty($user)){
            return ["code" => 2, "response" => "Invalid token"];
        }
        return ["code" => 1, "response" => Product::destroy($fields['id'])];
    }
    public function index($fields){
        $rules = ['required' => 'token'];
        $this->validate($fields, $rules);
        $user = User::where("token", $fields['token'])->first();
        if(empty($user)){
            return ["code" => 2, "response" => "Invalid token"];
        }
        return ["code" => 1, "response" => Product::all()];
    }
    public function show($fields){
       $rules = [
                'required' => [
                    ['id'],
                    ['token']
                ]
       ];
        $this->validate($fields, $rules);
        return ["code" => 1, "response" => Product::find($id)];
    }
}
echo apiResponse(Resource::run(new ProductResource, $_SERVER['REQUEST_METHOD']));
