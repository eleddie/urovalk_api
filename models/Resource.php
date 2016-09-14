<?php
class Resource {
   protected function validate($fields, $rules){
        $v = new Valitron\Validator($fields);
        $v->rules($rules);
        if (!$v->validate()){
            die(apiResponse(69, $v->errors()));
        }
    }

    public static function run($resource, $method){
        switch($method){
            case "POST":
                $response = $resource->create($_REQUEST);
                break; 
            case "GET";
                if (isset($_REQUEST['id']))
                    $response = $resource->show($_REQUEST['id']);
                else
                    $response = $resource->index();
                break;
            case "PUT";
                $response = $resource->update($_REQUEST['id'], $_REQUEST);
                break;
            case "DELETE";
                $response = $resource->delete($_REQUEST['id']);
                break;
            default:
                $response = null;
        }
        return $response;
    }
}