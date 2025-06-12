<?php

    //bloqueia acesso direto
    defined('INTERNAL_ACCESS')or die('Acesso restrito');


    //valida o método aqui ao invés de validar no index
    //pois pode não ser necessário em outras requisições
    if(empty($requestMethod)){
        http_response_code(404);
        die(json_encode(['status'=>'Not found!']));
    }

    require_once('../cfig/conn.php');


    switch($requestMethod)
    {

        case 'POST':
              
            $response = [];
            
            $body = json_decode(@file_get_contents('php://input'));
            
            //os inputs são tratados no prepare do pdo
            //mas por pratica/costume adiciono sanitização também no recebimento
            $sku        = trim(strip_tags(addslashes(@$body->sku)));
            $nome       = trim(strip_tags(addslashes(@$body->nome)));
            $preco      = trim(strip_tags(addslashes(@$body->preco)));
            $quantidade = trim(strip_tags(addslashes(@$body->quantidade)));
            
            if(!empty($sku) && !empty($nome) && !empty($preco) && !empty($quantidade))
            {                
                $params = [$sku, $nome, $preco, $quantidade];
                $sql    = "INSERT INTO `produtos` (`cod_sku`, `nome`, `preco`, `quantidade`) ";
                $sql   .= "VALUES (?, ?, ?, ?)";

                $query = $conn->prepare($sql);
                $result = $query->execute($params);

                if($result)
                {
                    $response = [
                        "status"  => "success",
                        "message" => "As informações foram inseridas com sucesso."
                    ];
                }
                else 
                {
                    $response = [
                        "status"  => "error",
                        "message" => "Houve um erro ao inserir as informações."
                    ];
                }                
            }
            else {
                $response = [
                    "status"  => "error",
                    "message" => "Dados inválidos! Verifique as informações fornecidas."
                ];
            }

            echo json_encode($response);

        break;


       case 'GET':
           
            $result = [];

            //se for passado o id (codigo sku) retorna um produto específico
            //senão retorna uma lista sem filtro
            //foi utilizado o nome da variável id ao invés de sku diretamente
            //para ser gerérico e poder ser utilizado por outras rotas
            $filters = "";
            if(!empty($id)){
                $filters .= " AND `cod_sku` = '$id'";
            }      

            //neste caso o WHERE poderia ter sido adicionado junto ao filtro
            //mas como normalmente trabalhamos com vários filtros
            //utilizo WHERE 1 para não quebrar a query
            $sql = "SELECT * FROM `produtos` WHERE 1 $filters ORDER BY `nome` ASC";
            
            $query = $conn->prepare($sql);
            $query->execute();
            $list = $query->fetchAll(PDO::FETCH_OBJ);

            if(count($list) > 0)
            { 
                foreach($list as $item)
                {
                    $response[] = [
                        'sku'        => $item->cod_sku,
                        'nome'       => $item->nome,
                        'preco'      => $item->preco,
                        'quantidade' => $item->quantidade
                    ];
                }
            }
            else {
                $response = [
                    "status"  => "error", //talvez aqui não seja o caso de retorna erro, mas vou manter
                    "message" => "Esta consulta não encontrou resultados."
                ]; 
            }

            echo json_encode($response);

        break;


        case 'PATCH':

            $response = [];
            
            $body = json_decode(@file_get_contents('php://input'));

            $sku        = $id;
            $nome       = trim(strip_tags(addslashes(@$body->nome)));
            $preco      = trim(strip_tags(addslashes(@$body->preco)));
            $quantidade = trim(strip_tags(addslashes(@$body->quantidade))); 
            
            //se foi passado o id e um ou mais valores
            if(!empty($sku) && !empty($nome.$preco.$quantidade))
            {
                $params   = [];
                $updSet = '';
                $i = 0;
                if(!empty($sku)){
                    $params['cod_sku'] = $sku;                  
                }
                if(!empty($nome)){                    
                    $params['nome'] = $nome;
                    if($i>0){$updSet .= ", ";}$i++;
                    $updSet .= " `nome` = :nome";
                }
                if(!empty($preco)){                    
                    $params['preco'] = $preco;
                    if($i>0){$updSet .= ", ";}$i++;
                    $updSet .= " `preco` = :preco";
                }
                if(!empty($quantidade)){                    
                    $params['quantidade'] = $quantidade;
                    if($i>0){$updSet .= ", ";}$i++;
                    $updSet .= " `quantidade` = :quantidade";
                }

                $sql = "UPDATE `produtos` SET $updSet WHERE `cod_sku` = :cod_sku LIMIT 1";

                $query = $conn->prepare($sql);
                $result = $query->execute($params);

                if($result)
                {
                    $response = [
                        "status"  => "success",
                        "message" => "As informações foram alteradas com sucesso."
                    ];
                }
                else 
                {
                    $response = [
                        "status"  => "error",
                        "message" => "Houve um erro ao alterar as informações."
                    ];
                }
            }
            else {
                $response = [
                    "status"  => "error",
                    "message" => "Dados inválidos! Verifique as informações fornecidas."
                ];
            }

            echo json_encode($response);

        break;


    }
	