<?php
class Estacion_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_estaciones() {
        $query = $this->db->get('ESTACIONES');
        return $query->result_array();
    }

    public function insert_estacion($data) {
        return $this->db->insert('ESTACIONES', $data);
    }

    public function get_estacion_by_id($id) {
        $query = $this->db->get_where('ESTACIONES', array('ID' => $id));
        return $query->row_array();
    }

    public function update_estacion($id, $data) {
        $this->db->where('ID', $id);
        return $this->db->update('ESTACIONES', $data);
    }

    public function delete_estacion($id) {
        $this->db->where('ID', $id);
        return $this->db->delete('ESTACIONES');
    }

    // Método para obtener el último ID
    public function get_last_id() {
        $this->db->select_max('ID');
        $query = $this->db->get('ESTACIONES');
        return $query->row()->ID;
    }
}
