<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
$link = mysqli_connect('localhost', 'mybox', 'P@ssw0rd', 'project-mybox');
mysqli_set_charset($link, 'utf8');

$sql2 = "SELECT * FROM users";
$result2 = mysqli_query($link, $sql2);
$rowcount = mysqli_num_rows($result2);
if ($rowcount < 1) {
    echo "ยังไม่มีข้อมูล";
    exit;
} else {
    echo '<table border="1">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>E-mail</th>';
    echo '<th>รหัสผ่าน</th>';
    echo '<th>ชื่อ</th>';
    echo '<th>นามสกุล</th>';
    echo '<th>เบอร์โทร</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while ($r = mysqli_fetch_array($result2)) {
        echo '<tr>';
        echo '<td>'.$r['email'].'</td>';
        echo '<td>'.$r['password'].'</td>';
        echo '<td>'.$r['name'].'</td>';
        echo '<td>'.$r['lastname'].'</td>';
        echo '<td>'.$r['tel'].'</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
}


mysqli_close($link);