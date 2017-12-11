<?php

namespace Champ\Join;

class JoinStatusChangedCommand
{
    public $id;

    public $statusId;

    /**
     * Bcash statuses.
     *
     * @var array
     */
    protected $statuses = [
        'Em andamento' => 2,
        'Aprovada' => 3,
        'Concluída' => 4,
        'Disputa' => 5,
        'Devolvida' => 6,
        'Cancelada' => 7,
        'Chargeback' => 8,
    ];

    public function __construct($pedido, $status)
    {
        $this->id = $pedido;
        $this->statusId = $this->statuses[$status];
    }
}
