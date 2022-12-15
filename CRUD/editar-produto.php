<?php 
if(!isset($_SESSION))
    session_start();

    try{
        $host_config = 'mysql:host=localhost;port=3306;dbname=web2';
        $dbusername = 'root';
        $dbpassword = '';

        //instancia um objeto PDO, conectando no MySQL
        $pdo = new PDO($host_config, $dbusername, $dbpassword);

        //receber o id que será atualizado
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if($id != null){
            //comandos sql para buscar o registro específico
            $sql = "SELECT * FROM produto WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $registro = $stmt->execute(['id' => $id]);

            //retornar um registro em forma de array associativo
            $produto = $stmt->fetch(PDO::FETCH_ASSOC);

            //envia os dados do produto para sessão
            if($stmt->rowCount() > 0){
                $_SESSION['produto'] = $produto;
            }

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

