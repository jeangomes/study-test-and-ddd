<?php

namespace App;
class Caixa
{
    /**
     * @var array
     */
    protected array $items = [];

    /**
     * Constrói a caixa com os items recebidos
     *
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * Verifica se um item específico está na caixa
     *
     * @param string $item
     * @return bool
     */
    public function contem(string $item): bool
    {
        return in_array($item, $this->items);
    }

    /**
     * Remove um item da caixa
     *
     * @return string|null
     */
    public function pegarUm(): string|null
    {
        return array_shift($this->items);
    }

    /**
     * Remove todos os itens que começam com uma determinada letra de dentro da caixa.
     *
     * @param string $letra
     * @return array
     */
    public function comecaCom(string $letra): array
    {
        return array_filter($this->items, function ($item) use ($letra) {
            return stripos($item, $letra) === 0;
        });
    }
}
