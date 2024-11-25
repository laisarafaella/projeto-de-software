<?php

class NFE {
    // atributos privados que representam as informações de uma Nota Fiscal
    private $idNfe;
    private $apelido;
    private $chaveAcesso;
    private $cnpj;
    private $razaoSocial;
    private $dataEmissao;
    private $valorTotal;

    // setters- definir valores desses atributos. cada método recebe um parâmetro e atribui esse valor ao atributo correspondente usando a palavra-chave this
    public function setIdNfe($idNfe) {$this->idNfe = $idNfe;}
    public function setApelido($apelido) {$this->apelido = $apelido;}
    public function setChaveAcesso($chaveAcesso) {$this->chaveAcesso = $chaveAcesso;}
    public function setCnpj($cnpj) {$this->cnpj = $cnpj;}
    public function setRazaoSocial($razaoSocial) {$this->razaoSocial = $razaoSocial;}
    public function setDataEmissao($dataEmissao) {$this->dataEmissao = $dataEmissao;}
    public function setValorTotal($valorTotal) {$this->valorTotal = $valorTotal;}

    // getters são usados para recuperar os valores dos atributos
    public function getIdNfe() {return $this->idNfe;}
    public function getApelido() {return $this->apelido;}
    public function getChaveAcesso() {return $this->chaveAcesso;}
    public function getCnpj() {return $this->cnpj;}
    public function getRazaoSocial() {return $this->razaoSocial;}
    public function getDataEmissao() {return $this->dataEmissao;}
    public function getValorTotal() {return $this->valorTotal;}
}