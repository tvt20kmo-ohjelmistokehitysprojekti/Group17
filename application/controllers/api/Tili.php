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
class Tili extends REST_Controller {

    function __construct()
    {
        //enable cors
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        // Construct the parent class
        parent::__construct();

        $this->load->model('Tili_model');
    }

    public function Saldo_get() // tässä voi käyttää aiempaa funktiota 
    {
        $this->load->model('Pankkikortti_model');
        $kortinNumero=$this->input->get('kortinID');
        $tilinumero=$this->Pankkikortti_model->get_Tilinumero($kortinNumero);// kutsutaan modelin funktiota
        $this->load->model('Tili_model'); // this input get request on pyyntö ja sisältää dataa this input get hakee requestista arvon joka on avaimella muista niin ei kulu aikaa
        $Saldo=$this->Tili_model->get_Saldo($tilinumero);  //asetetaan $Saldo tilin saldo
        
        echo json_encode($Saldo);
    }
    public function index_get()
    {
        // tili from a data store e.g. database  

        $id = $this->input->get('id');

        // If the id parameter doesn't exist return all tilit
        if ($id === NULL)
        {
            $tili=$this->Tili_model->get_tili(NULL);
            // Check if the tili data store contains tili (in case the database result returns NULL)
            if ($tili)
            {
                // Set the response and exit
                $this->response($tili, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No tili were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

         // Find and return a single record for a particular tili.
        else {
            // Validate the id.
            if ($id <= 0)
            {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the tili from the database, using the id as key for retrieval.
            $tili=$this->Tili_model->get_tili($id);
            if (!empty($tili))
            {
                $this->set_response($tili, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'tili could not be found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

    }

    public function index_post()
    {
        // Add a new tili
        $add_data=array(
          'Saldo'=>$this->post('Saldo'),
          'Tilintyyppi'=>$this->post('Tilintyyppi'),
          'Luottoraja'=>$this->post('Luottoraja')
        );
        $insert_id=$this->Tili_model->add_tili($add_data);
        if($insert_id)
        {
            $message = [
                'TilinumeroID' => $insert_id,
                'Saldo' => $this->post('Saldo'),
                'Tilintyyppi' => $this->post('Tilintyyppi'),
                'Luottoraja'=>$this->post('Luottoraja'),
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
        // Update the tili
        $id=$this->input->get('id');
        $update_data=array(
          'Saldo'=>$this->put('Saldo'),
          'Tilintyyppi'=>$this->put('Tilintyyppi'),
          'Luottoraja'=>$this->put('Luottoraja')
        );
        $result=$this->Tili_model->update_tili($id, $update_data);

        if($result)
        {
            $message = [
                'TilinumeroID' => $id,
                'Saldo' => $this->put('Saldo'),
                'Tilintyyppi'=>$this->put('Tilintyyppi'),
                'Luottoraja'=>$this->put('Luottoraja'),
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
        $result=$this->Tili_model->delete_tili($id);
        if ($result)
        {
          $message = [
              'TilinumeroID' => $id,
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