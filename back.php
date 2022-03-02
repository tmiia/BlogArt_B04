<?php

require_once __DIR__ . '../CONNECT/database.php';

function insert_user($pseudoUser, $passUser, $nomUser, $prenomUser, $eMailUser) {
    global $db;

    try {
        $db->beginTransaction();

        $query = 'INSERT INTO USER (pseudoUser, passUser, nomUser, prenomUser, eMailUser) VALUES (?, ?, ?, ?, ?);'; //requete
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

    $query = 'SELECT * FROM USER WHERE eMailUser = ? AND passUser = ?;';
    $result = $db->prepare($query);
    $result->execute([$pseudoUser, $passUser]);
    $user = $result->fetch();

    if($user) {
        setcookie('user', $user['eMailUser, passUser']);
        header('Location: index.php');
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