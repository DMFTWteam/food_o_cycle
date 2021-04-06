<?php
    require_once "../inc/db_connect.php";

    session_start();

if (isset($_SESSION['user'])) {
    $user_info = $_SESSION['user'];
    if ($user_info['u_is_admin'] == 1) {
        //header("Location: ../admin.php");
        echo "admin";
        exit();
    } else if ($user_info['u_is_standard'] == 1) {
        if ($_SESSION['business']['business_is_donor'] == 1) {
            //header("Location: ../donorhome.php");
            echo "donor";
            exit();
        } else {
            //header("Location: ../fbhome.php");
            echo "bank";
            print_r($_SESSION['business']['business_is_donor']);
            exit();
        }
        
    }
}
    $username = filter_input(INPUT_POST, 'InputEmail');
    $password = filter_input(INPUT_POST, 'InputPassword');
    $user_login = filter_input(INPUT_POST, 'login');
if (isset($user_login)) {  
    if (empty($username) || empty($password)) {  
        echo '<label>All fields are required</label>';  
    } else {
        // Get the userName and passWord
        $query = 'SELECT *
					  FROM users
					  WHERE u_email = :emailAddress';
        $statement = $db->prepare($query);
        $statement->bindValue(':emailAddress', $username);
        $statement->execute();
        $user_info= $statement->fetch();
        $user_count = $statement->rowCount();
        $statement->closeCursor();
                    
        if ($user_count > 0) {
                     
            $validPassword = password_verify($password, $user_info['u_password']);
            
            if ($validPassword) {
                $_SESSION['user'] = $user_info;
                if ($user_info['u_is_admin'] == 1) {
                    //Log_access($user_info['u_id'], 1);
                    header("Location: ../admin.php");
                    exit();
                } else if ($user_info['u_is_standard'] == 1) {
                    
                    //Log_access($user_info['u_id'], 1);
                    
                    $query2 = 'SELECT *
							  	FROM user_to_business, business
							 	WHERE user_to_business.u_id = :u_id
								AND user_to_business.business_id = business.business_id';
                    $statement2 = $db->prepare($query2);
                    $statement2->bindValue(':u_id', $user_info['u_id']);
                    $statement2->execute();
                    $bus_info = $statement2->fetchAll();
                    $business_count = $statement2->rowCount();
                    $statement2->closeCursor();
                    if ($business_count > 0) {
                         $_SESSION['business'] = $bus_info;
                        if ($_SESSION['business']['business_is_donor'] == 1) {
                            header("Location: ../donorhome.php");
                            exit();
                        } else {
                            header("Location: ../fbhome.php");
                            exit();
                        }
                    }
                }
            } else {
                //Log_access($user_info['u_id'], 0);
                echo '<label>Invalid Password.</label>'; 
            }
        } else {
            //Log_access($user_info['u_id'], 0);
            echo '<label>Invalid Username.</label>'; 
        }
    }
               
} else {
    header("Location: ../login.php");
    exit();
}

function Log_access($u_id, $auth) 
{
    include_once "../inc/db_connect.php";
    $date = new DateTime('NOW');
    $auth_query = 'INSERT INTO access_log
						(u_id, log_datetime, log_authsuccessful)
						VALUES
						(:u_id, :log_datetime, :log_authsuccessful)';
    $auth_statement = $db->prepare($auth_query);
    $auth_statement->bindValue(':log_datetime', $date->format(DateTimeInterface::RFC850));
    $auth_statement->bindValue(':u_id', $u_id);
    $auth_statement->bindValue(':log_authsuccessful', $auth);
    $auth_statement->execute();
    $auth_statement->closeCursor();
}
        
?>
