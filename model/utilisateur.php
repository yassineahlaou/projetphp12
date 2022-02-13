<?php
include_once("database.php");
class Utilisateur{
    protected $fullname;
    protected $email;
    protected $login;
    protected $password;
    protected $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function inscription($fullname, $email, $login, $password) {
        $this->db->query("INSERT INTO utilisateur (full_name,email,login,password) VALUES (:fullname, :email, :login, :password)");
        $this->db->bind('fullname', $fullname);
        $this->db->bind('email', $email);
        $this->db->bind('login', $login);
        $this->db->bind('password', $password);
        
        if($this->db->execute()){
            return true;
        }
        else
        {
            return false;
        }
    }

    public function reinitialisation_mot_de_passe($email, $password){
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $this->db->query("UPDATE utilisateur SET password=:password WHERE email=:email");
        $this->db->bind('password', $password);
        $this->db->bind('email', $email);
        if($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function find_user_by_email($login, $email){
        $this->db->query("SELECT * FROM utilisateur WHERE login=:login OR email=:email");
        $this->db->bind('login', $login);
        $this->db->bind('email', $email);

        $row = $this->db->single();
        
        if($this->db->rowCount() > 0)
        {
            return $row;
        }
        else
        {
            return false;
        }
    }

    public function login($username, $password) {
        $row = $this->find_user_by_email($username, $password);
        
        if($row == false)
        {
            return false;
        }

        $hashed_password = $row->password;
        if(password_verify($password, $hashed_password)) {
            return $row;
        }
        else
        {
            return false;
        }
    }

    public function is_verified($username) {
        $this->db->query("SELECT verified FROM utilisateur WHERE login=:login");
        $this->db->bind('login', $username);

        $row = $this->db->single();
        
        if($this->db->rowCount() > 0)
        {
            return $row->verified;
        }
        else
        {
            return false;
        }
    }

    public function verify($email){
        $this->db->query("UPDATE utilisateur SET verified=1 WHERE email=:email");
        $this->db->bind('email', $email);
        $this->db->execute();
        if($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
?>