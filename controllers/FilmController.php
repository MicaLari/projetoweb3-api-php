<?php
class FilmController{
    function create(){
        Router::allowedMethod('POST');
        
        $data = Input::getData();
        $nome = $data['nome'];
        $img = $data['img'];
        $genero = $data['genero'];
        $min = $data['min'];

        //TODO validar os campos

        $user = new Film(null, $nome, $img, $genero, $min);
        $id = $user->create();

        $result["success"]["message"] = "Film created successfully!";
        $result["film"] = $data;
        $result["film"]["id"] = $id;
        Output::response($result);
    }

    function list(){
        Router::allowedMethod('GET');

        $film = new Film(null, null, null, null, null);
        $listFilms = $film->list();

        $result["success"]["message"] = "Film list has been successfully listed!";
        $result["data"] = $listFilms;
        Output::response($result);
    }

    function byId(){
        Router::allowedMethod('GET');

        if(isset($_GET['id'])){
            $id = $_GET['id'];
        } else {
            $result['error']['message'] = "Id parameter required!";
            Output::response($result, 406);
        }
        
        $user = new Film($id, null, null, null, null);
        $userData = $user->getById();

        if($userData){
            $result["success"]["message"] = "User successfully selected!";
            $result["data"] = $userData;
            Output::response($result);
        } else {
            $result["error"]["message"] = "User not found!";
            Output::response($result, 404);
        }
    }

    function delete(){
        Router::allowedMethod('DELETE');
        $data = Input::getData();

        if(isset($data['id'])){
            $id = $data['id'];
        } else {
            $result['error']['message'] = "Id parameter required!";
            Output::response($result, 406);
        }

        $user = new Film($id, null, null, null, null);
        $deleted = $user->delete();

        if($deleted){
            $result["success"]["message"] = "User $id deleted successfully!";
            Output::response($result);
        } else {
            $result["error"]["message"] = "User $id not found to be deleted!";
            Output::response($result, 404);
        }
    }

    function update(){
        Router::allowedMethod('PUT');
        
        $data = Input::getData();
        $id = $data['id'];
        $nome = $data['nome'];
        $img = $data['img'];
        $genero = $data['ganero'];
        $min = $data['min'];

        
        
        $user = new Film($id, $nome, $img ,$genero, $min);
        $updated = $film->update();

        if($updated){
            $result["success"]["message"] = "Film updated successfully!";
            $result["film"] = $data;
            Output::response($result);
        } else {
            $result["error"]["message"] = "Film $id not found to be updated!";
            Output::response($result, 404);
        }
    }

}
?> 