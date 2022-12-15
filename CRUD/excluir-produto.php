<?php 
    try{
        $host_config = 'mysql:host=localhost;port=3306;dbname=web2';
        $dbusername = 'root';
        $dbpassword = '';

        //instancia um objeto PDO, conectando no MySQL
        $pdo = new PDO($host_config, $dbusername, $dbpassword);

        //recuperar o id que será excluído
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if($id != null){
            //comandos sql para deletar
            $sql = "DELETE FROM produto WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            header('Location: cadastro-produto.php');
        }else{
            echo "Dados são inválidos";
        }


        //fecha conexão
        $pdo = null;

    }catch(PDOException $e){
    print "Erro!: ". $e->getMessage()."<br>\n";
    }
?>

