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
                    ['price']
                ]
        ];
        $this->validate($fields, $rules);
        $record = Product::where('serial', $fields['serial'])->first();
        if(empty($record))
            return Product::create($fields);
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
        return Product::where("id", $id)->update($fields);
    }
    public function delete($id){
        $rules = ['required' => 'id'];
        $this->validate(['id' => $id], $rules);
        return Product::destroy($id);
    }
    public function index(){
        return Product::all();
    }
    public function show($id){
        $rules = ['required' => 'id'];
        $this->validate(['id' => $id], $rules);
        return Product::find($id);
    }
}
echo apiResponse(1, Resource::run(new ProductResource, $_SERVER['REQUEST_METHOD']));
