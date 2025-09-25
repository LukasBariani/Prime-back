<?php
require_once __DIR__ . "/../model/trilha.php";


class ControllerTrilhas {
    private $trilhaModel;

    public function __construct(){
        $this->trilhaModel = new Trilha();

        // se for chamada via GET para executar ação
        if(isset($_GET['funcao'])){
            $func = $_GET['funcao'];
            if($func == 'iniciar' && $_SERVER['REQUEST_METHOD'] == 'POST'){
                $this->iniciar();
            } else if($func == 'concluir' && $_SERVER['REQUEST_METHOD'] == 'POST'){
                $this->concluir();
            } else if($func == 'listar' && isset($_GET['format']) && $_GET['format']=='json'){
                $this->listarJson();
            }
        }
    }

    public function listarAtividades($idTrilha){
    return $this->trilhaModel->listarAtividades($idTrilha);
}


    // wrapper para uso via include nas pages
    public function listarTrilhas($idUsuario = null){
        return $this->trilhaModel->listarTrilhas($idUsuario);
    }

    // ações chamadas por formulário (POST)
    private function iniciar(){
        $this->trilhaModel->setIdUsuario($_POST['id_usuario']);
        $this->trilhaModel->setIdTrilha($_POST['id_trilha']);
        $this->trilhaModel->setIdAtividade($_POST['id_atividade']);
        $this->trilhaModel->setDataInicio($_POST['data_inicio']);
        $rows = $this->trilhaModel->iniciarAtividade();
        header("Location: ../pages/user-pages/trilhas.php");
        exit;
    }

    private function concluir(){
        $this->trilhaModel->setIdUsuario($_POST['id_usuario']);
        $this->trilhaModel->setIdAtividade($_POST['id_atividade']);
        $this->trilhaModel->setDataConclusao($_POST['data_conclusao']);
        $this->trilhaModel->setPontuacao($_POST['pontuacao']);
        $rows = $this->trilhaModel->concluirAtividade();
        header("Location: ../pages/user-pages/trilhas.php");
        exit;
    }

    private function listarJson(){
        $user = isset($_GET['user']) ? $_GET['user'] : null;
        $list = $this->trilhaModel->listarTrilhas($user);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($list, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

// $controller = new ControllerTrilhas();
?>
