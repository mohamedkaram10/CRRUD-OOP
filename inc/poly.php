<?php 

interface Database {
  public function handel_errors();
  public function hashed_password($password);
  public function insert_user();
  public function handel_errors();
}