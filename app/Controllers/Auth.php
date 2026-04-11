<?php 

namespace App\Controllers;

use App\Models\User_model;

class Auth extends BaseController {

    public function index() {
        return view('login');
    }

    // --- Diri ang FIX: Gindugang ang register() function ---
    public function register() {
        $session = session();
        if ($session->get('role') != 'admin') {
            return redirect()->to(base_url('dashboard'));
        }
        // Ini dapat mag-match sa ngalan sang imo PHP file sa views/auth/
        return view('auth/register'); 
    }

    public function loginProcess() {
        $session = session();
        $model = new User_model();
        
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        $user = $model->where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $sessionData = [
                    'user_id'   => $user['id'],
                    'name'      => $user['name'],
                    'email'     => $user['email'],
                    'role'      => $user['role'],
                    'logged_in' => TRUE
                ];
                $session->set($sessionData);
                
                $db = \Config\Database::connect();
                $builder = $db->table('staff_logs');
                
                $logData = [
                    'staff_name' => $user['name'],
                    'login_time' => date('Y-m-d H:i:s'),
                    'status'     => 'On Duty'
                ];
                $builder->insert($logData);
                
                $session->set('current_log_id', $db->insertID());
                
                return redirect()->to(base_url('dashboard'));
            } else {
                return redirect()->back()->with('msg', 'Wrong Password.');
            }
        } else {
            return redirect()->back()->with('msg', 'Email not found.');
        }
    }

    public function manage() {
        $session = session();
        if ($session->get('role') != 'admin') {
            return redirect()->to(base_url('dashboard'));
        }

        $model = model(User_model::class);
        $db = \Config\Database::connect();

        $data['staff_members'] = $model->where('role', 'staff')->findAll();
        
        $data['duty_logs'] = $db->table('staff_logs')
                                ->where('staff_name !=', 'Riverside Cafe') 
                                ->orderBy('login_time', 'DESC')
                                ->get()
                                ->getResultArray();

        return view('auth/manage_staff', $data); 
    }

    public function logout() {
        $session = session();
        $logId = $session->get('current_log_id');

        if ($logId) {
            $db = \Config\Database::connect();
            $builder = $db->table('staff_logs');
            $log = $builder->where('id', $logId)->get()->getRow();
            
            if ($log) {
                $loginTime = new \DateTime($log->login_time);
                $logoutTime = new \DateTime(date('Y-m-d H:i:s'));
                $interval = $loginTime->diff($logoutTime);
                $duration = $interval->format('%h hrs %i mins');

                $builder->where('id', $logId)->update([
                    'logout_time' => $logoutTime->format('Y-m-d H:i:s'),
                    'duration'    => $duration,
                    'status'      => 'Out'
                ]);
            }
        }

        $session->destroy();
        return redirect()->to(base_url('/'));
    }

    public function store() {
        $model = model(User_model::class);
        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => $this->request->getPost('role') ?? 'staff',
            'duty_day' => $this->request->getPost('duty_day') 
        ];
        $model->insert($data);
        return redirect()->to(base_url('auth/manage'))->with('msg', 'Staff added!');
    }

    public function edit($id) {
        $model = model(User_model::class);
        $data['staff'] = $model->find($id);
        return view('auth/edit_staff', $data);
    }

    public function update($id) {
        $model = model(User_model::class);
        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'role'     => $this->request->getPost('role'),
            'duty_day' => $this->request->getPost('duty_day')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('auth/manage'))->with('msg', 'Updated!');
    }

    public function delete($id) {
        $model = model(User_model::class);
        $model->delete($id);
        return redirect()->to(base_url('auth/manage'));
    }
}