

<form method="POST" action="<?= site_url('GameSessions/unlock_session/' . $session_id) ?>">
    <label for="pin">Enter PIN:</label>
    <input type="password" name="pin" required>
    <button type="submit">Unlock</button>
</form>
