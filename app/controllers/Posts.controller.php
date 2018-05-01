<?php
use App\Classes\Helper;

class Posts extends Controller {
   private $post_model;
   private $request;

   public function __construct($request) {
      if ($_SERVER['REQUEST_METHOD'] == 'GET' && !Session::isLoggedIn()) {
         Helper::redirect('users/login');
      }
      $this->request = $request;
      $this->post_model = $this->model("Post");
      $this->setAjax($this->request->get('ajax'));
   }

   public function index() {
      echo "Posts/index";
   }

   public function all() {
      // if direct access redirect to main page
      if ($_SERVER["REQUEST_METHOD"] != "POST") Helper::redirect("");
      // init response
      $response = [
         'status' => OK,
         "data"   => ""
      ];
      // sanitize data from post request
      $post_data = [
         "level"   => filter_var($this->request->get('level'), FILTER_SANITIZE_NUMBER_INT),
         "section" => filter_var($this->request->get("section"), FILTER_SANITIZE_NUMBER_INT),
         "group"   => filter_var($this->request->get('group'), FILTER_SANITIZE_NUMBER_INT),
      ];
      // check the response from model
      if (!$this->post_model->getAllPosts($post_data)) {
         $response["status"] = 300;
      } else {
         $response["data"] = $this->post_model->getAllPosts($post_data);
      }
      $this->view("api/json", $response);
   }

   public function get($id_post = "") {
      //init response
      $response = [
         'page_title' => __CLASS__,
         'status'     => OK,
         "data"       => ""
      ];
      // get the id from the url
      $id_post = filter_var($id_post, FILTER_SANITIZE_NUMBER_INT);
      $id_student = Session::get('user_id');
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
         // change
         $id_post = filter_var($this->request->get('id_post'), FILTER_SANITIZE_NUMBER_INT);
      }
      if (!$this->post_model->getPost($id_post, $id_student)) {
         $response["status"] = 300;
         $this->view("", $response);
         return;
      }
      $response["data"] = $this->post_model->getPost($id_post, $id_student);
      $this->view("pages/post", $response);
   }

   // for professor
   public function myposts() {
      // if direct access redirect to main page
      if ($_SERVER["REQUEST_METHOD"] != "POST") Helper::redirect("");
      // init response
      $response = [
         'page_title' => "Mes Publication",
         'status'     => OK,
         "data"       => ""
      ];
      // sanitize data from post request
      $id_professor = filter_var($this->request->get("id_professor"), FILTER_VALIDATE_INT);
      // check the response from model
      if ($id_professor === false) {
         $id_professor = Session::get("user_id");
         if (empty($id_professor)) die("invalid id");
      }
      $response['data'] = $this->post_model->getAllPostsProf($id_professor);
      $this->view("api/json", $response);
   }

   public function addPost() {
      $response = [
         'page_title' => "Mes Publication",
         'status'     => OK,
         "data"       => ""
      ];
      $data = [
         'id_professor' => filter_var($this->request->get('id_professor'), FILTER_VALIDATE_INT),
         'id_subject'   => filter_var($this->request->get('id_subject'), FILTER_VALIDATE_INT),
         'level'        => filter_var($this->request->get('level'), FILTER_VALIDATE_INT),
         'section'      => filter_var($this->request->get('section'), FILTER_VALIDATE_INT),
         'group'        => filter_var($this->request->get('group'), FILTER_VALIDATE_INT),
         //         'post_text'    => $_POST['post_text'],
         'type'         => filter_var($this->request->get('type'), FILTER_VALIDATE_INT),
         'file_path'    => "",
      ];
      foreach ($data as $d) {
         if ($d === false) die("invalid " . array_search($d, $data));
      }
   }

   public function profInfo() {
//      if ($_SERVER["REQUEST_METHOD"] != "POST") Helper::redirect("");
      $response = [
         'page_title' => "Mes Publication",
         'status'     => OK,
         "data"       => ""
      ];
      $id_professor = filter_var($this->request->get('id_professor'), FILTER_VALIDATE_INT);
//      if ($id_professor === false) die("invalid id");
      $response['data'] = $this->post_model->getprofInfo(1);
      $response['data'] = Helper::arrangePInfo(Helper::obj_arr($response['data']));
      $this->view('api/json', $response);
   }
}