<?php

class MetodoPagamento
{
    private $idMetodo;
    private $apelido;
    private $titular;
    private $numero_cartao;
    private $ultimos_digitos;
    private $data_validade;
    private $cvv;
    private $idUsuario;

    public function getIdMetodo()
    {
        return $this->idMetodo;
    }

    public function setIdMetodo($idMetodo)
    {
        $this->idMetodo = $idMetodo;
    }

    public function getApelido()
    {
        return $this->apelido;
    }

    public function setApelido($apelido)
    {
        $this->apelido = $apelido;
    }

    public function getTitular()
    {
        return $this->titular;
    }

    public function setTitular($titular)
    {
        $this->titular = $titular;
    }

    public function getNumeroCartao()
    {
        return $this->numero_cartao;
    }

    public function setNumeroCartao($numero_cartao)
    {
        $this->numero_cartao = $numero_cartao;
    }

    public function getUltimosDigitos()
    {
        return $this->ultimos_digitos;
    }

    public function setUltimosDigitos($ultimos_digitos)
    {
        $this->ultimos_digitos = $ultimos_digitos;
    }

    public function getDataValidade()
    {
        return $this->data_validade;
    }

    public function setDataValidade($data_validade)
    {
        $this->data_validade = $data_validade;
    }

    public function getCvv()
    {
        return $this->cvv;
    }

    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }
}


?>