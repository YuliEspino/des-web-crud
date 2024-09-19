<?php
class Estaciones extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Estacion_model');
        $this->load->helper('url_helper');
    }

    public function index() {
        $data['estaciones'] = $this->Estacion_model->get_estaciones();
        $this->load->view('estaciones/index', $data);
    }

    public function insert_estacion($data) {
        return $this->db->insert('ESTACIONES', $data);
    }
    
    public function create() {
        $this->load->view('estaciones/create');
    }

    public function store() {
        $last_id = $this->Estacion_model->get_last_id();
        $new_id = $last_id + 1;
        $data = array(
            'ID' => $new_id,
            'DESCRIPCION_ESTACION' => $this->input->post('descripcion_estacion'),
            'TARIFA' => $this->input->post('tarifa'),
            'NOMBRE_CLIENTE' => $this->input->post('nombre_cliente'),
            'TIEMPO_SOLICITADO' => $this->input->post('tiempo_solicitado'),
            'GAMERTAG' => $this->input->post('gamertag'),
            'ESTATUS_PAGO' => $this->input->post('estatus_pago'),
            'FECHA_UTILIZACION' => $this->input->post('fecha_utilizacion')
        );
        $this->Estacion_model->insert_estacion($data);
        redirect('estaciones');
    }    

    public function edit($id) {
        $data['estacion'] = $this->Estacion_model->get_estacion_by_id($id);
        $this->load->helper('form');
        $this->load->view('estaciones/edit', $data);
    }

    public function update($id) {
        $data = array(
            'DESCRIPCION_ESTACION' => $this->input->post('descripcion_estacion'),
            'TARIFA' => $this->input->post('tarifa'),
            'NOMBRE_CLIENTE' => $this->input->post('nombre_cliente'),
            'TIEMPO_SOLICITADO' => $this->input->post('tiempo_solicitado'),
            'GAMERTAG' => $this->input->post('gamertag'),
            'ESTATUS_PAGO' => $this->input->post('estatus_pago'),
            'FECHA_UTILIZACION' => $this->input->post('fecha_utilizacion')
        );
        $this->Estacion_model->update_estacion($id, $data);
        redirect('estaciones');
    }    

    public function delete($id) {
        $this->Estacion_model->delete_estacion($id);
        redirect('estaciones');
    }

    public function cobrar($id) {
        $data = array(
            'estatus_pago' => 'Pagado'
        );
        $this->load->model('Estacion_model');
        $this->Estacion_model->update_estacion($id, $data);
        redirect('estaciones');
    }

    /**
     * test de git
     */
    public function get_last_id(){
        $this->db->select_max('ID');
        $query = $this->db->get('ESTACIONES');
        return $query->row()->ID;
    }
}
