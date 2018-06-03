<?php
header("Content-Type: text/html;charset=utf-8");

$msg_info = array();
$status = 'Success';
$autor = $_GET["ba"];

if (!empty($_GET["ba"])) { // если запрос по книгам
    try {
        $dbh = new PDO('mysql: host=localhost; dbname=BookLibrary', 'root', '');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $autor="$autor%";
        $sth = $dbh->prepare('SELECT books.book_id, title FROM `books` join book_autor ON (book_autor.book_id=books.book_id) WHERE book_autor.autor_id=? ORDER BY title');//достаем книгу по id
        $sth->bindValue(1, $autor, PDO::PARAM_STR);
        $sth->execute();
        $msg_info = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $status = 'Fail: ' . $e->getMessage();
    }
    $data = array(
        'msg_info' => $msg_info,
        'status' => $status
        );
    echo json_encode($data);//отправляем назад
} else {
    $msg_info['err'] = array(
        'msg_info' => 'Нет значения');
    $data = array(
        'msg_info' => $msg_info,
        'status' => $status
        );
    echo json_encode($data);
        //echo 'нет значения';
} 