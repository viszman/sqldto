<?php

declare(strict_types=1);

namespace App\TransferObjects;


class ArraySqlDTO
{
    /**
     * @var \App\TransferObjects\SqlDTO[]
     */
    private $DTOs;

    public function __construct(
       array $DTOs
    ) {
        $this->DTOs = $DTOs;
    }

    /**
     * @return \App\TransferObjects\SqlDTO[]
     */
    public function getDTOs(): array
    {
        return $this->DTOs;
    }

    public function add(SqlDTO $sqlDTO)
    {
        $this->DTOs[] = $sqlDTO;
    }
}
