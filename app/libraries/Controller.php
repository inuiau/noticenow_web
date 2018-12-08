<?php
    /*
     * Base Controller
     * Loads the models and views
     */
    class Controller{
        //load model
        public function model($model){
            //require model files
            require_once '../app/models/'.$model.'.php';

            //instantiate model
            return new $model();
        }

        //load view
        public function view($view, $data = []){
            //check for view files
            if(file_exists('../app/views/'.$view.'.php')){
                require_once '../app/views/'.$view.'.php';
            }else{
                die('views gak ada');
            }

        }
    }