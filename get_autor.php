<?phpheader("Content-Type: text/html;charset=utf-8");$msg_info = array();$status = 'Success';$letter = $_GET["ge"];//     $host = '127.0.0.1';//     $db   = 'BookLibrary';// учше того что у меня используется, позже перепишу...//     $user = 'root';//     $pass = '';//     $charset = 'utf8';//     $dsn = "mysql:host=$host;dbname=$db;charset=$charset";//     $opt = [//         PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,//         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,//         PDO::ATTR_EMULATE_PREPARES   => false,//     ];//     $pdo = new PDO($dsn, $user, $pass, $opt);if (!empty($_GET["ge"])) { // если запрос по авторам    try {        $dbh = new PDO('mysql: host=localhost; dbname=BookLibrary', 'root', '');        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        $letter="$letter%";        $sth = $dbh->prepare('SELECT autors.autor_id, autors.name FROM autors WHERE autors.name LIKE ? ORDER BY name'); //достаем авторов по букве        $sth->bindValue(1, $letter, PDO::PARAM_STR);        $sth->execute();        $msg_info = $sth->fetchAll(PDO::FETCH_ASSOC);    } catch (PDOException $e) {        $status = 'Fail: ' . $e->getMessage();    }    $data = array(        'msg_info' => $msg_info,        'status' => $status        );    echo json_encode($data);// send back} else {    $msg_info['err'] = array(        'msg_info' => 'Нет значения');    $data = array(        'msg_info' => $msg_info,        'status' => $status        );    echo json_encode($data);        //echo 'нет значения';}