<?php 

namespace App\Models;
use CodeIgniter\Model;

class User_model extends Model {
    protected $table      = 'users';
    protected $primaryKey = 'id';

    // Diri naton idugang ang 'username' kay amo na ang gamiton sa login
    // Kag 'role' para mabal-an naton kon Admin ukon Staff
    protected $allowedFields = ['name', 'username', 'email', 'password', 'role', 'created_at'];

    // Para automatic nga mabal-an kon san-o gin-create ang account
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Ginagamit ini para mag-fetch sang staff list lang (para sa Dashboard)
     */
    public function getStaffMembers() {
        return $this->where('role', 'staff')
                    ->orderBy('name', 'ASC')
                    ->findAll();
    }

    /**
     * Check kon existing na ang username (Security validation)
     */
    public function checkUsername($username) {
        return $this->where('username', $username)->first();
    }
}