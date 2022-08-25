<?php 
    require_once 'connexiondb.php';
    $success = false;
    $msg = 'Une erreur est survenue... (script PHP)';

    if(isset($_POST['pseudo']) && !empty($_POST['pseudo']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])){
        $pseudo = htmlspecialchars(strip_tags($_POST['pseudo']));
        $email = htmlspecialchars(strip_tags($_POST['email']));
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $today = date("Y-m-d H:i:s");
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            //ajout dans la db
            try{
                $sql = 'INSERT INTO user (username, password, email, created_at) VALUES (:username, :password, :email, :today)';
                $stmt = $connection->prepare($sql);
                $stmt->execute(
                    array(
                        ':username' => $pseudo,
                        ':password' => $password,
                        ':email' => $email,
                        ':today' => $today
                    )
                );

                $success = true;
                $msg = 'Utilisateur enregistré';
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }else{
            $msg = 'Adresse email incorrecte';
        }
    }else{
        $msg = 'Veuillez remplir les champs';
    }

    $res = [
        'msg' => $msg,
        'success' => $success
    ];

    echo json_encode($res);
?>