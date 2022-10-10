<?php

namespace Tests\Unit;

use App\Caixa;
use PHPUnit\Framework\TestCase;

class MeuPrimeiroTest extends TestCase
{
    public function testCaixaContemItem()
    {
        $caixa = new Caixa(['carro', 'mochila', 'garfo']);
        $this->assertTrue($caixa->contem('mochila'));
        $this->assertFalse($caixa->contem('cubo magico'));
    }

    public function testCaixaContemUmItem()
    {
        $caixa = new Caixa(['lençol']);
        $this->assertEquals('lençol', $caixa->pegarUm());
        // Null, agora a caixa está vazia
        $this->assertNull($caixa->pegarUm());
    }
}
