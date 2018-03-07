<?php

/*
 * Base Controller
 * Load Models & Views
*/

class Controller {

    // Load model
    public function model($model) {
        // Require Model file
        require_once '../app/models/' . $model . '.model.php';
        return new $model();
    }

    // Load View
    public function view($view, $data = []) {
        // check if file(view) exist
        if (file_exists('../app/views/' . $view . '.view.php')) {
            // Require View File
            require_once '../app/views/' . $view . '.view.php';
        } else {
            // view doesn't exist more;
            die('view doesn\'t exist more');
        }
    }
}