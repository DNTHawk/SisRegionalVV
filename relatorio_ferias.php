<?php
error_reporting(0);

session_start();

require 'conexao.php';

require 'verifica_sessao.php'; 

$paramentroCargo = $_SESSION['paramentroCargo'];

try {
    $conexao = db_connect();
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
    table td, th{
        border: solid 1px #A4A4A4;
    }

    table{
        border-collapse: collapse;
    }
</style>
</head>
<body>
    <h2 style="text-align: center; width: 100%; ">Lista de Ferias</h2>
    
    <table style="width: 1100px" class="table table-bordered">
        <tr>
            <th>Nome</th>
            <th>Matricula</th>
            <th>Função</th>
            <th>Data Saida</th>
            <th>Data Volta</th>
            <th>Periodo</th>
            <th>Décimo Terceiro</th>
        </tr>
        <?php
        if($paramentroCargo){
            try {
                $stmt = $conexao->prepare("SELECT * FROM ferias, pessoa, funcao WHERE ferias.pessoaFerias = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and funcao.idFuncao like '$paramentroCargo%' order by dataSaida");
                if ($stmt->execute()) {
                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                        $array_data_saida = explode('-', $rs->dataSaida);
                        $data_formatada_saida = $array_data_saida[2] . '/' . $array_data_saida[1] . '/' . $array_data_saida[0];
                        $array_data_volta = explode('-', $rs->dataVolta);
                        $data_formatada_volta = $array_data_volta[2] . '/' . $array_data_volta[1] . '/' . $array_data_volta[0];
                        echo "<tr>";
                        echo "<td>".$rs->nome
                        ."</td><td style='text-align: center'>".$rs->matricula
                        ."</td><td style='text-align: center'>".$rs->nomeFuncao
                        ."</td><td style='text-align: center'>".$data_formatada_saida
                        ."</td><td style='text-align: center'>".$data_formatada_volta
                        ."</td><td style='text-align: center'>".$rs->periodo
                        ."</td><td style='text-align: center'>".$rs->decTerceiro;
                        echo "</tr>";
                    }
                } else {
                    echo "Erro: Não foi possível recuperar os dados do banco de dados";
                }
            }catch (PDOException $erro) {
                echo "Erro: ".$erro->getMessage();
            }  
        }else {
            try {
                $stmt = $conexao->prepare("SELECT * FROM ferias, pessoa, funcao WHERE ferias.pessoaFerias = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao order by dataSaida");
                if ($stmt->execute()) {
                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                        $array_data_saida = explode('-', $rs->dataSaida);
                        $data_formatada_saida = $array_data_saida[2] . '/' . $array_data_saida[1] . '/' . $array_data_saida[0];
                        $array_data_volta = explode('-', $rs->dataVolta);
                        $data_formatada_volta = $array_data_volta[2] . '/' . $array_data_volta[1] . '/' . $array_data_volta[0];
                        echo "<tr>";
                        echo "<td>".$rs->nome
                        ."</td><td style='text-align: center'>".$rs->matricula
                        ."</td><td style='text-align: center'>".$rs->nomeFuncao
                        ."</td><td style='text-align: center'>".$data_formatada_saida
                        ."</td><td style='text-align: center'>".$data_formatada_volta
                        ."</td><td style='text-align: center'>".$rs->periodo
                        ."</td><td style='text-align: center'>".$rs->decTerceiro;
                        echo "</tr>";
                    }
                } else {
                    echo "Erro: Não foi possível recuperar os dados do banco de dados";
                }
            }catch (PDOException $erro) {
                echo "Erro: ".$erro->getMessage();
            } 
        } 
        ?>
    </table>
    <br><br>
    <a style="margin-left: 10px" href="cad_ferias.php"><span>Voltar</span></a>

    <SCRIPT LANGUAGE="JavaScript">
        window.print();
    </SCRIPT>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

