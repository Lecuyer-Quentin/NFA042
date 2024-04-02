<?php

function get_session_server() {
    if (isset($_SESSION['server_response'])) {
        $server_response = $_SESSION['server_response'];
        unset($_SESSION['server_response']);
        return $server_response;
    }
    return null;
}
