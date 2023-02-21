<?php

namespace App\Entity;

use App\Repository\WhateverRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WhateverRepository::class)]
class Whatever
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getWhatever() : void {}
}
