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

    // Metodo para manejar el bloqueo y la verificacion del PIN
    
    class GameSessions extends CI_Controller {
    
        public function start_session($user_id) {
            // Iniciar sesión, generar un PIN y bloquear la sesión al inicio
            $pin = rand(1000, 9999); // Genera un PIN aleatorio
            $data = array(
                'user_id' => $user_id,
                'start_time' => date('Y-m-d H:i:s'),
                'is_locked' => TRUE, // Sesión bloqueada
                'pin' => password_hash($pin, PASSWORD_BCRYPT) // Hashear el PIN por seguridad
            );
            $this->db->insert('game_sessions', $data);
            $session_id = $this->db->insert_id();
    
            // Enviar el PIN al administrador o guardarlo para posterior uso
            echo "Session started. PIN: " . $pin;
        }
    
        public function pause_session($session_id) {
            // Verificar si la sesión está bloqueada antes de pausar
            $session = $this->db->get_where('game_sessions', ['id' => $session_id])->row();
            if ($session->is_locked) {
                echo "This session is locked. Enter PIN to pause or reset.";
            } else {
                // Lógica para pausar la sesión
                echo "Session paused.";
            }
        }
    
        public function unlock_session($session_id) {
            // Desbloquear la sesión solicitando el PIN
            $pin_input = $this->input->post('pin');
            $session = $this->db->get_where('game_sessions', ['id' => $session_id])->row();
    
            if (password_verify($pin_input, $session->pin)) {
                // Desbloquear la sesión
                $this->db->update('game_sessions', ['is_locked' => FALSE], ['id' => $session_id]);
                echo "Session unlocked. Now you can pause or reset.";
            } else {
                echo "Incorrect PIN.";
            }
        }
    }
    
}
