<?php 
$config = include('./database/config.php');
try{
    $conn = new PDO(
        'mysql:host='.$config['db']['host'], 
        $config['db']['user'], 
        $config['db']['pass'], 
        $config['db']['options']);
    
    $sql = file_get_contents('database/migration.sql');
    $conn->exec($sql);
    echo 'Base de datos creada';
} catch(PDOException $error){
    echo $error->getMessage();
}
?>