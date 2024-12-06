<?php //I certify that this submission is my own original work
require_once 'dblogin.php';

try
  {
    $pdo = new PDO($attr, $user, $pass, $opts);
  }
  catch (PDOException $e)
  {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
  }

 $query = " DROP TABLE IF EXISTS employees;
    CREATE TABLE IF NOT EXISTS employees (
    eid INT NOT NULL,
    firstname VARCHAR(32) NOT NULL,
    lastname VARCHAR(32) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(32) NOT NULL,
    department VARCHAR(32) NOT NULL,
    hiredate DATE NOT NULL,
    PRIMARY KEY (eid)
  )";

 $result = $pdo->exec($query);
 if($result==0) echo "Employees created successfully.";
  
 $query = "INSERT INTO employees VALUES(61522, 'Adam', 'Bloch', 'abloch@email.com', '917-346-2356', 'Finance', '2021-05-15')";
 $result = $pdo->exec($query);
 $query = "INSERT INTO employees VALUES(11523, 'John', 'Torres', 'jtorres@email.com', '646-521-4616', 'Advertising', '2021-12-23')";
 $result = $pdo->exec($query);
 $query = "INSERT INTO employees VALUES(52520, 'Miguel', 'Manicdao', 'mmanicdao@email.com', '718-465-3910', 'Advertising', '2022-04-30')";
 $result = $pdo->exec($query);
 $query = "INSERT INTO employees VALUES(78481, 'Emerson', 'Martinez', 'emartinez@email.com', '347-415-3561', 'Human Resources', '2024-05-25')";
 $result = $pdo->exec($query);
 if($result==0) echo "Employees filled with data successfully.";
 
 $query = " DROP TABLE IF EXISTS user;
    CREATE TABLE IF NOT EXISTS user (
    username VARCHAR(32) NOT NULL,
    email VARCHAR(32) NOT NULL,
    password VARCHAR(256) NOT NULL,
    PRIMARY KEY (username)
  )";
  
  $result = $pdo->exec($query);
  if($result==0) echo "User created successfully";
  
  ?>