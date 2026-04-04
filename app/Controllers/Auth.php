<?php 

namespace App\Controllers;

use App\Models\User_model;

class Auth extends BaseController {

    public function index() {
        return view('login');
    }

    // --- GINDUNGANG NATON INI NGA LOGIN PROCESS ---
    public function loginProcess() {
        $session = session();
        $model = new User_model();
        
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        // I-check kon ang email ara sa users table
        $user = $model->where('email', $email)->first();

        if ($user) {
            // I-verify ang password (hashed)
            if (password_verify($password, $user['password'])) {
                $sessionData = [
                    'user_id' => $user['id'],
                    'name'    => $user['name'],
                    'email'   => $user['email'],
                    'role'    => $user['role'],
                    'logged_in' => TRUE
                ];
                $session->set($sessionData);
                
                // Redirect sa dashboard pagkatapos sang login
                return redirect()->to(base_url('dashboard'));
            } else {
                return redirect()->back()->with('msg', 'Wrong Password. Please try again.');
            }
        } else {
            return redirect()->back()->with('msg', 'Email not found.');
        }
    }

    public function register() {
        return view('register');
    }

    public function manage() {
        $session = session();
        
        if ($session->get('role') != 'admin') {
            return redirect()->to(base_url('dashboard'));
        }

        $model = model(User_model::class);
        
        // GIN-UPDATE: Staff lang ang magguwa sa listahan para limpyo
        $data['staff_members'] = $model->where('role', 'staff')->findAll();
        $data['title'] = "Staff Management";

        return view('auth/manage_staff', $data); 
    }

    public function store() {
        $model = model(User_model::class);
        $password = $this->request->getPost('password');
        
        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => $this->request->getPost('role') ?? 'staff'
        ];

        if ($model->insert($data)) {
            return redirect()->to(base_url('auth/manage'))->with('msg', 'Staff added successfully!');
        } else {
            return redirect()->back()->with('msg', 'Failed to add staff.');
        }
    }

    public function delete($id) {
        $model = model(User_model::class);
        
        if ($id == session()->get('user_id')) {
            return redirect()->back()->with('msg', 'You cannot delete yourself!');
        }

        if ($model->delete($id)) {
            return redirect()->to(base_url('auth/manage'))->with('msg', 'Staff deleted successfully!');
        } else {
            return redirect()->back()->with('msg', 'Failed to delete staff.');
        }
    }

    public function edit($id) {
        $model = model(User_model::class);
        $data['staff'] = $model->find($id);
        
        if (!$data['staff']) {
            return redirect()->to(base_url('auth/manage'))->with('msg', 'Staff not found!');
        }

        return view('auth/edit_staff', $data);
    }

    public function update($id) {
        $model = model(User_model::class);
        
        $data = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role'  => $this->request->getPost('role'),
        ];

        $model->update($id, $data);
        return redirect()->to(base_url('auth/manage'))->with('msg', 'Staff updated successfully!');
    }

    public function logout() {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}