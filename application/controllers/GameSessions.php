<?php

//Para Manejar el bloqueo

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
