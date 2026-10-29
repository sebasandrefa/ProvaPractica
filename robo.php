<?php
class Robo
{
    public $nome;
    public $modelo;
    public $energia;
    public $potencia;

    public function __construct($nome, $modelo)
    {
        $this->nome = $nome;
        $this->modelo = $modelo;

        if ($modelo == 'Explorador') {
            $this->energia = 100;
            $this->potencia = 20;
        } elseif ($modelo == 'Engenheiro') {
            $this->energia = 120;
            $this->potencia = 15;
        } else {
            $this->energia = 150;
            $this->potencia = 30;
        }
    }

    public function exibirStatus()
    {
        return "Energia: $this->energia | Pot�ncia: $this->potencia";
    }

    public function recarregar()
    {
        if ($this->energia >= 200) {
            return false;
        }
        $this->energia += 10;
        if ($this->energia > 200) {
            $this->energia = 200;
        }
        return true;
    }
}