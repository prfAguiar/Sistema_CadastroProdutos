<?php

    try{
        $host_config = 'mysql:host=localhost;port=3306;dbname=web2';
        $dbusername = 'root';
        $dbpassword = '';

        //instancia um objeto PDO, conectando no MySQL
        $pdo = new PDO($host_config, $dbusername, $dbpassword);

        //montar a consulta SQL para recuperar todos os produtos cadastrados
        $sql = "SELECT * FROM produto";

        //executa o comando sql e retorna para $consulta
        $consulta = $pdo->query($sql);

        //retorna os registros selecionados em forma de array associativo
        $lista_produtos = $consulta->fetchAll(PDO::FETCH_ASSOC);

        //fecha conexão
        $pdo = null;

    }catch(PDOException $e){
    print "Erro!: ". $e->getMessage()."<br>\n";
    }
?>

