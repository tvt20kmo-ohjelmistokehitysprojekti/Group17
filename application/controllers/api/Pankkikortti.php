<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

/**
 * This is an example of a RestApi based on PHP and CodeIgniter 3.
 * 
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Pekka Alaluukas (edited the version made by Phil Sturgeon & Chris Kacerguis)
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Pankkikortti extends REST_Controller {

    function __construct()
    {
        //enable cors
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        // Construct the parent class
        parent::__construct();

        $this->load->model('Pankkikortti_model');
    }
   

    public function index_get()
    {
        // pankkikortti from a data store e.g. database  

        $id = $this->input->get('id');

        // If the id parameter doesn't exist return all pankkikortti
        if ($id === NULL)
        {
            $pankkikortti=$this->Pankkikortti_model->get_pankkikortti(NULL);
            // Check if the pankkikortti data store contains pankkikortti (in case the database result returns NULL)
            if ($pankkikortti)
            {
                // Set the response and exit
                $this->response($pankkikortti, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No pankkikortti were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

         // Find and return a single record for a particular pankkikortti.
        else {
            // Validate the id.
            if ($id <= 0)
            {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the pankkikortti from the database, using the id as key for retrieval.
            $pankkikortti=$this->Pankkikortti_model->get_pankkikortti($id);
            if (!empty($pankkikortti))
            {
                $this->set_response($pankkikortti, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'pankkikortti could not be found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

    }

    public function index_post()
    {
        // Add a new pankkikortti
        $add_data=array(
          'Omistaja'=>$this->post('Omistaja'),
          'Tunnusluku'=>$this->post('Tunnusluku'),
          'Tili'=>$this->post('Tili')
        );
        $insert_id=$this->Pankkikortti_model->add_pankkikortti($add_data);
        if($insert_id)
        {
            $message = [
                'KortinID' => $insert_id,
                'Omistaja' => $this->post('Omistaja'),
                'Tunnusluku' => $this->post('Tunnusluku'),
                'Tili'=>$this->post('Tili'),
                'message' => 'Added a resource'
            ];
            $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
        }
        else
        {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'Can not add data'
            ], REST_Controller::HTTP_CONFLICT); // CAN NOT CREATE (409) being the HTTP response code
        }

    }
    public function index_put()
    {
        // Update the pankkikortti
        $id=$this->input->get('id');
        $update_data=array(
          'Omistaja'=>$this->put('Omistaja'),
          'Tunnusluku'=>$this->put('Tunnusluku'),
          'Tili'=>$this->put('Tili')
        );
        $result=$this->Pankkikortti_model->update_pankkikortti($id, $update_data);

        if($result)
        {
            $message = [
                'KortinID' => $id,
                'Omistaja' => $this->put('Omistaja'),
                'Tunnusluku'=>$this->put('Tunnusluku'),
                'Tili'=>$this->put('Tili'),
                'message' => 'Updates a resource'
            ];

            $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
        }
        else 
        {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'Can not update data'
            ], REST_Controller::HTTP_CONFLICT); // CAN NOT CREATE (409) being the HTTP response code
        }
    }

    public function index_delete()
    {
        $id = $this->input->get('id');

        // Validate the id.
        if ($id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
        $result=$this->Pankkikortti_model->delete_pankkikortti($id);
        if ($result)
        {
          $message = [
              'KortinID' => $id,
              'message' => 'Deleted the resource'
          ];
          $this->set_response($message, REST_Controller::HTTP_OK);
        }
        else
        {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'Can not delete data'
            ], REST_Controller::HTTP_CONFLICT); // CAN NOT CREATE (409) being the HTTP response code
        }
    }



}