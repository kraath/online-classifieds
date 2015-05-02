<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * @Khadim Raath
 */

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $method = $this->router->method;
        $auth_methods = array("my_ads", "me", "edit_me", "logout", "settings", "change_password");
        if (in_array($method, $auth_methods)) {
            if (!is_logged_in()) {
                show_404();
            }
        }
    }

    public function my_ads() {
        $data['title'] = "My ADs";
        $data['user'] = $this->session->userdata("user");
        $this->load->view('user/my_ads', $data);
    }

    public function me() {
        $data['title'] = "Khadim-Raath";
        $data['user'] = $this->session->userdata("user");
        $this->load->view('user/me', $data);
    }

    public function edit_me() {
        if ($this->input->server('REQUEST_METHOD') != 'POST') {
            $data['title'] = "Edit Me";
            $data['user'] = $this->session->userdata("user");
            $this->load->view('user/edit', $data);
        } else {
            $this->load->model('User_model');
            $result = $this->User_model->edit_me();
            if ($result)
                redirect('user/me');
            else {
                redirect('user/edit_me');
            }
        }
    }

    public function login() {
        if ($this->input->is_ajax_request()) {
            $this->load->model('User_model');
            $result = $this->User_model->user_login();
            echo json_encode($result);
        } else {
            $data['title'] = "Login";
            $this->load->model('Advertisement_model');
            $data['ads'] = $this->Advertisement_model->get_all_custom_where(array("status" => 1));
            $this->load->view('advertisement/index', $data);
        }
    }

    public function register() {
        if ($this->input->is_ajax_request()) {
            $this->load->model('User_model');
            $result = $this->User_model->create_user();
            echo json_encode($result);
        } else {
            $data['title'] = "Register";
            $this->load->model('Advertisement_model');
            $data['ads'] = $this->Advertisement_model->get_all_custom_where(array("status" => 1));
            $this->load->view('advertisement/index', $data);
        }
    }

    public function verify_registration($token) {
        $this->load->model('User_model');
        if ($this->User_model->activate($token)) {
            redirect('user/login');
        } else {
            show_404();
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('advertisement/index');
    }

    public function settings() {
        $data['title'] = "Settings";
        $this->load->view('user/settings', $data);
    }

    public function change_password() {
        $data['title'] = "Change Password";
        $this->load->view('user/change_pwd', $data);
    }

}
