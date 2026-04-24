<?php
// =============================================
// BASE CONTROLLER
// =============================================
class Controller {

    protected function view($view, $data = []) {
        extract($data);
        $viewPath = "app/views/{$view}.php";

        ob_start();
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            echo "<p>View '{$view}' tidak ditemukan.</p>";
        }
        $content = ob_get_clean();

        require 'app/views/layouts/main.php';
    }

    protected function redirect($url) {
        header("Location: {$url}");
        exit;
    }

    protected function setFlash($type, $message) {
        $_SESSION['flash'] = ['type' => $type, 'message' => $message];
    }

    protected function getFlash() {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }
}
