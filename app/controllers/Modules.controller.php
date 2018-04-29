<?php
use App\Classes\Helper;
use App\Classes\Module;

class Modules extends Controller {
   private $modulesModel;
   private $_module;
   private $request;

   public function __construct($request) {
      if ($_SERVER['REQUEST_METHOD'] == 'GET' && !Session::isLoggedIn()) {
         Helper::redirect('users/login');
      }
      $this->modulesModel = $this->model("Module");
      $this->_module = new Module($this->modulesModel);
      $this->request = $request;
      $this->setAjax($this->request->get('ajax'));
   }

   public function index() {
      $response = [
         "page_title" => __CLASS__,
         'status'     => OK,
         'data'       => null,
      ];
      if (Session::isProf()) {
         $object = $this->modulesModel->getProfModules(Session::get("user_id"));
         $response['data'] = $object;
      } else {
         $object = $this->modulesModel->getModules($_SESSION['user_level'], $_SESSION['user_section'], $_SESSION['user_group']);
         $this->_module->setModule($object);
         $response['data'] = $this->_module->arrange_rows();
      }
      $this->view("modules/index", $response);
   }


   public function all($level = "", $section = "", $group = "") {
      $response = [
         "page_title" => __CLASS__,
         'status'     => OK,
         'data'       => null,
      ];
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_NUMBER_INT);
         $level = isset($_POST['level']) ? $_POST['level'] : "";
         $section = isset($_POST['section']) ? $_POST['section'] : "";
         $group = isset($_POST['group']) ? $_POST['group'] : "";
         $object = $this->modulesModel->getModules($level, $section, $group);
         $this->_module->setModule($object);
         if ($object) {
            $response['data'] = $this->_module->arrange_rows();
         } else {
            $response['status'] = ERR_EMAIL;
         }
         $this->view('api/json', $response);
         return;
      } else {
         die("request specified with {$level}/{$section}/{$group}");
      }
   }

   public function profModules() {
      if ($_SERVER['REQUEST_METHOD'] != 'POST') Helper::redirect("");
      $response = [
         "page_title" => __CLASS__,
         'status'     => OK,
         'data'       => "",
      ];
      $id_professor = filter_var($this->request->get('id_professor'),FILTER_VALIDATE_INT);
      if ($id_professor === false) die('invalid  id');
      $response['data'] = $this->modulesModel->getProfModules($id_professor);
      $this->view('api/json', $response['data']);
   }
}