<?php

namespace App\Entity;

use App\Repository\SettingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SettingRepository::class)]
class Setting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $game = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGame(): ?int
    {
        return $this->game;
    }

    public function setGame(int $game): static
    {
        $this->game = $game;

        return $this;
    }
}
