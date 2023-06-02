<?php

class ConnectDB implements Database
{
  private $server_name = "localhost";
  private $user_name = "root";
  private $password = "";
  private $dbname = "crud_php_opp";
  private $conn;

  public function __construct()
  {
    $this->conn = mysqli_connect($this->server_name, $this->user_name, $this->password, $this->dbname);
    if (!$this->conn) $this->handel_errors();
  }

  // Function For Errors
  public function handel_errors() {
    die("Error :" . mysqli_error($this->conn));
  }

  // For Hashing Password
  public function hashed_password($password)
  {
    return password_hash($password, PASSWORD_DEFAULT);
  }

  // Start CRUD Operations

  // Create New User In Database
  public function insert_user($sql)
  {
    if (mysqli_query($this->conn, $sql)) {
      return "Added Success";
    }
    $this->handel_errors();
  }


  // Read User From Database
  public function read_user($table)
  {
    $sql = "SELECT * FROM $table";
    $result = mysqli_query($this->conn, $sql);
    $data = [];

    if ($result) {
      if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
          $data[] = $row;
        }
        return $data;
      }
    }
    $this->handel_errors();
  }

  // Find Info For User
  public function find_user($table, $id) {
    $sql = "SELECT * FROM $table WHERE id = '$id'";
    $result = mysqli_query($this->conn, $sql);

    if ($result) {
      if (mysqli_num_rows($result)) {
        return mysqli_fetch_assoc($result);
      }
      return false;
    }
    $this->handel_errors();
}


  // Update Info For User
public function update_user($sql) {
      if (mysqli_query($this->conn, $sql)) {
      return "Updated Success";
  }
    $this->handel_errors();
}


// Delete Info For User
public function delete_user($table, $id) {
  $sql = "DELETE FROM $table WHERE id = '$id'";
  if (mysqli_query($this->conn, $sql)) {
    return "Deleted Success";
  }
  $this->handel_errors();
}


















}



