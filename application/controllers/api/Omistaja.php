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
class Omistaja extends REST_Controller {

    function __construct()
    {
        //enable cors
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        // Construct the parent class
        parent::__construct();

        $this->load->model('Omistaja_model');
    }

    public function index_get()
    {
        // Omistaja from a data store e.g. database  

        $id = $this->input->get('id');

        // If the id parameter doesn't exist return all omistajat
        if ($id === NULL)
        {
            $omistaja=$this->Omistaja_model->get_omistaja(NULL);
            // Check if the omistaja data store contains omistaja (in case the database result returns NULL)
            if ($omistaja)
            {
                // Set the response and exit
                $this->response($omistaja, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No omistaja were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

         // Find and return a single record for a particular omistaja.
        else {
            // Validate the id.
            if ($id <= 0)
            {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the omistaja from the database, using the id as key for retrieval.
            $omistaja=$this->Omistaja_model->get_omistaja($id);
            if (!empty($omistaja))
            {
                $this->set_response($omistaja, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'omistaja could not be found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

    }

    public function index_post()
    {
        // Add a new omistaja kommentoidaan jotain testiksi
        $add_data=array(
          'Etunimi'=>$this->post('Etunimi'),
          'Sukunimi'=>$this->post('Sukunimi'),
          'Osoite'=>$this->post('Osoite'),
          'Puhelinnumero'=>$this->post('Puhelinnumero')
        );
        $insert_id=$this->Omistaja_model->add_omistaja($add_data);
        if($insert_id)
        {
            $message = [
                'OmistajaID' => $insert_id,
                'Etunimi' => $this->post('Etunimi'),
                'Sukunimi' => $this->post('Sukunimi'),
                'Osoite'=>$this->post('Osoite'),
                'Puhelinnumero'=>$this->post('Puhelinnumero'),
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
        // Update the omistaja
        $id=$this->input->get('id');
        $update_data=array(
          'Etunimi'=>$this->put('Etunimi'),
          'Sukunimi'=>$this->put('Sukunimi'),
          'Osoite'=>$this->put('Osoite'),
          'Puhelinnumero'=>$this->put('Puhelinnumero')

        );
        $result=$this->Omistaja_model->update_omistaja($id, $update_data);

        if($result)
        {
            $message = [
                'OmistajaID' => $id,
                'Etunimi' => $this->put('Etunimi'),
                'Sukunimi'=>$this->put('Sukunimi'),
                'Osoite'=>$this->put('Osoite'),
                'Puhelinnumero'=>$this->put('Puhelinnumero'),
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
        $result=$this->Omistaja_model->delete_omistaja($id);
        if ($result)
        {
          $message = [
              'OmistajaID' => $id,
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