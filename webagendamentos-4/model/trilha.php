<?php
require_once(__DIR__ . "/banco.php");

class Trilha {
    // atributos...
    private $id;
    private $idUsuario;
    private $idTrilha;
    private $idAtividade;
    private $dataInicio;
    private $dataConclusao;
    private $pontuacao;
    private $status;

    // getters/setters (omiti por brevidade — mantenha os seus)

    public function listarAtividades($idTrilha){
        $db = new Banco();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM trilhas_atividades WHERE id_trilha = ? ORDER BY ordem");
        $stmt->execute([$idTrilha]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function iniciarAtividade(){
        try{
            $db = new Banco();
            $conn = $db->getConnection();
            $sql = "INSERT INTO trilhas_progresso (id_usuario, id_trilha, id_atividade, data_inicio, status) VALUES (?, ?, ?, ?, 'em_andamento')";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$this->idUsuario, $this->idTrilha, $this->idAtividade, $this->dataInicio]);
            return $stmt->rowCount();
        } catch(PDOException $e){
            error_log("Erro iniciarAtividade: " . $e->getMessage());
            return 0;
        }
    }

    public function concluirAtividade(){
        try{
            $db = new Banco();
            $conn = $db->getConnection();
            $sql = "UPDATE trilhas_progresso SET data_conclusao = ?, pontuacao = ?, status = 'concluido' WHERE id_usuario = ? AND id_atividade = ? AND status = 'em_andamento'";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$this->dataConclusao, $this->pontuacao, $this->idUsuario, $this->idAtividade]);
            return $stmt->rowCount();
        } catch(PDOException $e){
            error_log("Erro concluirAtividade: " . $e->getMessage());
            return 0;
        }
    }

    public function calcularProgresso($idUsuario, $idTrilha){
        try{
            $db = new Banco();
            $conn = $db->getConnection();

            $sqlTotal = "SELECT COUNT(*) as total FROM trilhas_atividades WHERE id_trilha = ?";
            $stmtTotal = $conn->prepare($sqlTotal);
            $stmtTotal->execute([$idTrilha]);
            $totalAtividades = (int)$stmtTotal->fetch()['total'];

            $sqlConcl = "SELECT COUNT(*) as concluidas FROM trilhas_progresso WHERE id_usuario = ? AND id_trilha = ? AND status = 'concluido'";
            $stmtConcl = $conn->prepare($sqlConcl);
            $stmtConcl->execute([$idUsuario, $idTrilha]);
            $concluidas = (int)$stmtConcl->fetch()['concluidas'];

            return $totalAtividades > 0 ? round(($concluidas / $totalAtividades) * 100) : 0;
        } catch(PDOException $e){
            error_log("Erro calcularProgresso: " . $e->getMessage());
            return 0;
        }
    }

    public function listarTrilhas($idUsuario = null){
        try{
            $db = new Banco();
            $conn = $db->getConnection();
            $sql = "SELECT * FROM trilhas ORDER BY ordem";
            $stmt = $conn->query($sql);
            $trilhas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $trilhas;
        } catch(PDOException $e){
            error_log("Erro listarTrilhas: " . $e->getMessage());
            return [];
        }
    }
}
?>
