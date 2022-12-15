<?php
    try{
        $host_config = 'mysql:host=localhost;port=3306;dbname=web2';
        $dbusername = 'root';
        $dbpassword = '';

        //instancia um objeto PDO, conectando no MySQL
        $pdo = new PDO($host_config, $dbusername, $dbpassword);

        //recuperar os dados do POST
        $id = isset($_POST['inputId']) ? $_POST['inputId'] : null;
        $descricao = isset($_POST['inputDescricao']) ? $_POST['inputDescricao'] : null;
        $preco = isset($_POST['inputPreco']) ? $_POST['inputPreco'] : null;
        $qt = isset($_POST['inputQt']) ? $_POST['inputQt'] : null;
        $bt = isset($_POST['btEnvio']) ? $_POST['btEnvio'] : null;

        if($bt === "Cadastrar"){
            //executar a inserção dos dados
            //testar se as variáveis não são nulas
            if($descricao != null && $preco != null && $qt != null){
                //insere no banco
                //comando sql para inserir, utilizando parâmetros values
                $sql = "INSERT INTO produto (descricao, preco, qt) VALUES (:descricao, :preco, :qt)";
                
                //pré-processa o sql
                $stmt = $pdo->prepare($sql);
                
                //montar os dados para inserção
                $data = [
                    'descricao' => $descricao,
                    'preco' => $preco,
                    'qt' => $qt
                ];
                
                //executa o comando
                $stmt->execute($data);

                header('Location: cadastro-produto.php');

            }else{
                echo "Dados nulos<br>\n";
            }
        } //fim if cadastrar
        else if($bt === "Atualizar"){
            //monta a consulta SQL para atualização
            $sql = "UPDATE produto SET descricao = :descricao, preco = :preco, qt = :qt WHERE id = :id";

            //prepara a consulta
            $stmt = $pdo->prepare($sql);

            //monta os dados para inserção
            $data = [
                'descricao' => $descricao,
                'preco' => $preco,
                'qt' => $qt,
                'id' => $id
            ];

            //executa o comando, passando os parâmetros que devem ser atualizados
            $stmt->execute($data);

            header('Location: cadastro-produto.php');

        }//fim else Atualizar
        
        //fecha conexão
        $pdo = null;

    }catch(PDOException $e){
    print "Erro!: ". $e->getMessage()."<br>\n";
    }
?>

