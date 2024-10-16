<?php

class NFE {
    private $idNfe;
    private $apelido;
    private $chaveAcesso;
    private $cnpj;
    private $razaoSocial;
    private $dataEmissao;
    private $valorTotal;

    public function setIdNfe($idNfe) {$this->idNfe = $idNfe;}
    public function setApelido($apelido) {$this->apelido = $apelido;}
    public function setChaveAcesso($chaveAcesso) {$this->chaveAcesso = $chaveAcesso;}
    public function setCnpj($cnpj) {$this->cnpj = $cnpj;}
    public function setRazaoSocial($razaoSocial) {$this->razaoSocial = $razaoSocial;}
    public function setDataEmissao($dataEmissao) {$this->dataEmissao = $dataEmissao;}
    public function setValorTotal($valorTotal) {$this->valorTotal = $valorTotal;}

    public function getIdNfe() {return $this->idNfe;}
    public function getApelido() {return $this->apelido;}
    public function getChaveAcesso() {return $this->chaveAcesso;}
    public function getCnpj() {return $this->cnpj;}
    public function getRazaoSocial() {return $this->razaoSocial;}
    public function getDataEmissao() {return $this->dataEmissao;}
    public function getValorTotal() {return $this->valorTotal;}
}