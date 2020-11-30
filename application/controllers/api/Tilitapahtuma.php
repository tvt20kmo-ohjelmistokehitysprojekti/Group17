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
class Tilitapahtuma extends REST_Controller {

    function __construct()
    {
        //enable cors
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        // Construct the parent class
        parent::__construct();

        $this->load->model('Tilitapahtuma_model');
    }

    public function index_get()
    {
        // tilitapahtuma from a data store e.g. database  

        $id = $this->input->get('id');

        // If the id parameter doesn't exist return all tilitapahtuma
        if ($id === NULL)
        {
            $tilitapahtuma=$this->Tilitapahtuma_model->get_tilitapahtuma(NULL);
            // Check if the tilitapahtuma data store contains tilitapahtuma (in case the database result returns NULL)
            if ($tilitapahtuma)
            {
                // Set the response and exit
                $this->response($tilitapahtuma, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No tilitapahtuma were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

         // Find and return a single record for a particular tilitapahtuma.
        else {
            // Validate the id.
            if ($id <= 0)
            {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the tilitapahtuma from the database, using the id as key for retrieval.
            $tilitapahtuma=$this->Tilitapahtuma_model->get_tilitapahtuma($id);
            if (!empty($tilitapahtuma))
            {
                $this->set_response($tilitapahtuma, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'tilitapahtuma could not be found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

    }

    public function index_post()
    {
        // Add a new tilitapahtuma
        $add_data=array(
          'Tapahtuma_tili'=>$this->post('Tapahtuma_tili'),
          'Tapahtumatyyppi'=>$this->post('Tapahtumatyyppi'),
          'Saldonmuutos'=>$this->post('Saldonmuutos')
        );
        $insert_id=$this->Tilitapahtuma_model->add_tilitapahtuma($add_data);
        if($insert_id)
        {
            $message = [
                'TapahtumaID' => $insert_id,
                'Tapahtuma_tili' => $this->post('Tapahtuma_tili'),
                'Tapahtumatyyppi' => $this->post('Tapahtumatyyppi'),
                'Saldonmuutos'=>$this->post('Saldonmuutos'),
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
        // Update the tilitapahtuma
        $id=$this->input->get('id');
        $update_data=array(
          'Tapahtuma_tili'=>$this->put('Tapahtuma_tili'),
          'Tapahtumatyyppi'=>$this->put('Tapahtumatyyppi'),
          'Saldonmuutos'=>$this->put('Saldonmuutos')
        );
        $result=$this->Tilitapahtuma_model->update_tilitapahtuma($id, $update_data);

        if($result)
        {
            $message = [
                'TapahtumaID' => $id,
                'Tapahtuma_tili' => $this->put('Tapahtuma_tili'),
                'Tapahtumatyyppi'=>$this->put('Tapahtumatyyppi'),
                'Saldonmuutos'=>$this->put('Saldonmuutos'),
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
        $result=$this->Tilitapahtuma_model->delete_tilitapahtuma($id);
        if ($result)
        {
          $message = [
              'TapahtumaID' => $id,
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