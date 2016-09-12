<?php
require 'vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ProductResource {
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
                    ['name'],
                    ['serial'],
                    ['stock'],
                    ['price']
                ]
        ];
        $this->validate($fields, $rules);
        $record = Products::where('serial', $fields['serial'])->first();
        if(empty($record))
            return Products::create($fields);
        else
            $record->stock += $fields['stock'];
            return $record->save();
    }
    public function update($id, $fields){
        $rules = [
                'required' => [
                    ['name'],
                    ['serial'],
                    ['stock'],
                    ['price'],
                    ['id']
                ]
        ];
        $this->validate(array_merge($fields, ['id' => $id]), $rules);
        return Products::where("id", $id)->update($fields);
    }
    public function delete($id){
        $rules = ['required' => 'id'];
        $this->validate(['id' => $id], $rules);
        return Products::destroy($id);
    }
    public function index(){
        return Products::all();
    }
    public function show($id){
        $rules = ['required' => 'id'];
        $this->validate(['id' => $id], $rules);
        return Products::find($id);
    }
}
$method = $_SERVER['REQUEST_METHOD'];
$products = new ProductResource();
switch($method){
    case "POST":
        $response = $products->create($_REQUEST);
        break; 
    case "GET";
        if (isset($_REQUEST['id']))
            $response = $products->show($_REQUEST['id']);
        else
            $response = $products->index();
        break;
    case "PUT";
        $response = $products->update($_REQUEST['id'], $_REQUEST);
        break;
    case "DELETE";
        $response = $products->delete($_REQUEST['id']);
        break;
    default:
        $response = null;
}
echo apiResponse(1, $response);
