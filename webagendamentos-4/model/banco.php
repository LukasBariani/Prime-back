<?php
// webagendamentos-4/banco.php
date_default_timezone_set('America/Sao_Paulo');

define('BD_SERVIDOR','localhost');
define('BD_USUARIO','root');
define('BD_SENHA','');
define('BD_BANCO','projetoweb');

class Banco {
    private $pdo;

    public function __construct(){
        $this->conexao();
    }

    private function conexao(){
        try {
            $dsn = "mysql:host=" . BD_SERVIDOR . ";dbname=" . BD_BANCO . ";charset=utf8mb4";
            $this->pdo = new PDO($dsn, BD_USUARIO, BD_SENHA, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            die("Erro conexão DB: " . $e->getMessage());
        }
    }

    // expõe conexão para models que usam PDO
    public function getConnection(){
        return $this->pdo;
    }

    /* --- Métodos legados que o sistema usava (opcionais mas úteis)
       você pode manter estes para compatibilidade com código que chama:
       setAgendamentos, getAgendamentos, setLicoes, getLicoes, update..., delete...
    */

    // Agendamentos
    public function setAgendamentos($nome,$telefone,$origem,$data_contato,$observacao){
        $sql = "INSERT INTO agendamentos (`nome`,`telefone`,`origem`,`data_contato`,`observacao`) VALUES (?,?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome,$telefone,$origem,$data_contato,$observacao]);
    }

    public function getAgendamentos($id = 0){
        if($id && $id > 0){
            $stmt = $this->pdo->prepare("SELECT * FROM agendamentos WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetchAll();
        }else{
            $stmt = $this->pdo->query("SELECT * FROM agendamentos");
            return $stmt->fetchAll();
        }
    }

    public function updateAgendamentos($id,$nome,$telefone,$origem,$data_contato,$observacao){
        $sql = "UPDATE agendamentos SET nome=?, telefone=?, origem=?, data_contato=?, observacao=? WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome,$telefone,$origem,$data_contato,$observacao,$id]);
    }

    public function deleteAgendamentos($id){
        $stmt = $this->pdo->prepare("DELETE FROM agendamentos WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Licoes
    public function setLicoes($titulo, $descricao, $tipo, $arquivo, $nivel){
        $sql = "INSERT INTO licoes (titulo, descricao, tipo, arquivo, nivel) VALUES (?,?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$titulo, $descricao, $tipo, $arquivo, $nivel]);
    }

    public function getLicoes($id = 0){
        if($id && $id > 0){
            $stmt = $this->pdo->prepare("SELECT * FROM licoes WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetchAll();
        }else{
            $stmt = $this->pdo->query("SELECT * FROM licoes");
            return $stmt->fetchAll();
        }
    }

    public function updateLicoes($id, $titulo, $descricao, $tipo, $arquivo, $nivel){
        $sql = "UPDATE licoes SET titulo=?, descricao=?, tipo=?, arquivo=?, nivel=? WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$titulo,$descricao,$tipo,$arquivo,$nivel,$id]);
    }

    public function deleteLicoes($id){
        $stmt = $this->pdo->prepare("DELETE FROM licoes WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
