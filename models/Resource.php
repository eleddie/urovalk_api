<?php
class Resource {
   protected function validate($fields, $rules){
        $v = new Valitron\Validator($fields);
        $v->rules($rules);
        if (!$v->validate()){
            die(apiResponse(
                ['code'=>3, "response" => $v->errors()]
            ));
        }
    }

    public static function run($resource, $method){
        switch($method){
            case "POST":
                if ($resource instanceof ProductResource){
                    $response = $resource->create($_REQUEST);
                } else {
                    if (isset($_REQUEST['name']))
                        $response = $resource->create($_REQUEST);
                    else
                        $response = $resource->login($_REQUEST);
                }
                break; 
            case "GET";
                if (isset($_REQUEST['id']))
                    $response = $resource->show($_REQUEST);
                else
                    $response = $resource->index($_REQUEST);
                break;
            case "PUT";
                $response = $resource->update($_REQUEST);
                break;
            case "DELETE";
                $response = $resource->delete($_REQUEST);
                break;
            default:
                $response = null;
        }
        return $response;
    }
}