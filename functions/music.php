<?php

require_once '../db/conn.php';

function viewMusics(){
    global $pdo;

    try{
    $sql = 'SELECT * FROM music';

    $stmt = $pdo->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        die($e->getMessage());
    }
}

function viewMusic($id){
    global $pdo;

    try{
        $sql = 'SELECT * FROM music WHERE id = :id';

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        die($e->getMessage());
    }
}

function insertMusic($music){
    global $pdo;

    try{
    $sql = 'INSERT INTO music (musicName, singer) VALUES (:musicName, :singer)';

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':musicName', $music->getName(), PDO::PARAM_STR);
    $stmt->bindValue(':singer', $music->getSinger(), PDO::PARAM_STR);

    $stmt->execute();
    } catch(PDOException $e){
        die($e->getMessage());
    }
}

function deleteMusic($id){
    global $pdo;

    try{
        $sql = 'DELETE FROM music WHERE id = :id';

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
    } catch(PDOException $e){
        die($e->getMessage());
    }
}

function updateMusic($music){
    global $pdo;

    try{
        $sql = 'UPDATE music SET musicName = :musicName, singer = :singer WHERE id = :id';

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':id', $music->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':musicName', $music->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':singer', $music->getSinger(), PDO::PARAM_STR);

        $stmt->execute();
    } catch(PDOException $e){
        die($e->getMessage());
    }
}