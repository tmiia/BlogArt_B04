<?php

require_once './connect/database.php';

function insert_user($pseudoUser, $passUser, $nomUser, $prenomUser, $eMailUser) {
    global $db;

    try {
        $db->beginTransaction();

        $query = 'INSERT INTO user (pseudoUser, passUser, nomUser, prenomUser, eMailUser) VALUES (?, ?, ?, ?, ?);'; //requete
        $request = $db->prepare($query); //prepare
        $request->execute([$pseudoUser, $passUser, $nomUser, $prenomUser, $eMailUser]); //execute
        $db->commit();
        $request->closeCursor();
    }
    catch (PDOException $e) {
        $db->rollBack();
        $request->closeCursor();
        die('Erreur insert user : ' . $e->getMessage());
    }
}

function connect_user($pseudoUser, $passUser) {
    global $db;

    $query = 'SELECT * FROM user WHERE pseudoUser = ? AND passUser = ?;';
    $result = $db->prepare($query);
    $result->execute([$pseudoUser, $passUser]);
    $user = $result->fetch();

    if($user) {
        setcookie('pseudoUser', $user['pseudoUser'], time() + 3000600, "/");
        setcookie('passUser', $user['passUser'], time() + 30003600, "/");
        header('Location: ' . ROOTFRONT . '/panneauAdmin.php');
    }
}


function get_user_name($eMailUser) {
    global $db;

    $query = 'SELECT * FROM user WHERE eMailUser = ?;';
    $result = $db->prepare($query);
    $result->execute([$eMailUser]);
    $user = $result->fetch();

    return $user['nomUser'];
}