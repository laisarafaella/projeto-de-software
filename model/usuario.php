<?php

class Usuario
{
    // atributos privados que armazenam informações sobre o usuário
    private $id;
    private $nome;
    private $sobrenome;
    private $email;
    private $senha;
    private $data_nascimento;
    private $recuperar_senha;
    private $cpf;
    private $cep;
    private $telefone;
    private $pontos;
    private $numCupons;
    private $idPlano;
    private $expiracao;

    // cada setter recebe um valor como parâmetro e o atribui ao atributo correspondente da instância da classe
    public function setId($id) {$this->id = $id; return $this;}
    public function setNome($nome){$this->nome = $nome;}
    public function setSobrenome($sobrenome){$this->sobrenome = $sobrenome;}
    public function setEmail($email){$this->email = $email;}
    public function setSenha($senha){$this->senha = $senha;}
    public function setDataNascimento($data_nascimento){$this->data_nascimento = $data_nascimento;}
    public function setRecuperarSenha($recuperar_senha){$this->recuperar_senha = $recuperar_senha;}
    public function setCpf($cpf){$this->cpf = $cpf;}
    public function setCep($cep){$this->cep = $cep;}
    public function setTelefone($telefone){$this->telefone = $telefone;}
    public function setPontos($pontos){$this->pontos = $pontos;}
    public function setNumCupons($numCupons){$this->numCupons = $numCupons;}
    public function setIdPlano($idPlano){$this->idPlano = $idPlano;}
    public function setExpiracao($expiracao){$this->expiracao = $expiracao;}


    // getters permite recuperar o valor de um atributo privado
    public function getId() {return $this->id;}
    public function getNome(){return $this->nome;}
    public function getSobrenome(){return $this->sobrenome;}
    public function getEmail(){return $this->email;}
    public function getSenha(){return $this->senha;}
    public function getDataNascimento(){return $this->data_nascimento;}
    public function getRecuperarSenha(){return $this->recuperar_senha;}
    public function getCpf(){return $this->cpf;}
    public function getCep(){return $this->cep;}
    public function getTelefone(){return $this->telefone;}
    public function getPontos(){return $this->pontos;}
    public function getNumCupons(){return $this->numCupons;}
    public function getIdPlano(){return $this->idPlano;}
    public function getExpiracao(){return $this->expiracao;}
}
