<?php

namespace App\Entity;

use App\Repository\EnigmaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnigmaRepository::class)]
class Enigma
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'enigmas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Type $type = null;

    #[ORM\Column(nullable: true)]
    private ?int $order_ = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $instruction = null;

    #[ORM\Column(length: 100)]
    private ?string $secretcode = null;

    /**
     * @var Collection<int, Thumbnail>
     */
    #[ORM\ManyToMany(targetEntity: Thumbnail::class, inversedBy: 'enigmas')]
    private Collection $thumbnail;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'enigmas')]
    private Collection $user;

    #[ORM\ManyToOne(inversedBy: 'enigma')]
    private ?Game $game = null;

    public function __construct()
    {
        $this->thumbnail = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getOrder(): ?int
    {
        return $this->order_;
    }

    public function setOrder(?int $order_): static
    {
        $this->order_ = $order_;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getInstruction(): ?string
    {
        return $this->instruction;
    }

    public function setInstruction(string $instruction): static
    {
        $this->instruction = $instruction;

        return $this;
    }

    public function getSecretcode(): ?string
    {
        return $this->secretcode;
    }

    public function setSecretcode(string $secretcode): static
    {
        $this->secretcode = $secretcode;

        return $this;
    }

    /**
     * @return Collection<int, Thumbnail>
     */
    public function getThumbnail(): Collection
    {
        return $this->thumbnail;
    }

    public function addThumbnail(Thumbnail $thumbnail): static
    {
        if (!$this->thumbnail->contains($thumbnail)) {
            $this->thumbnail->add($thumbnail);
        }

        return $this;
    }

    public function removeThumbnail(Thumbnail $thumbnail): static
    {
        $this->thumbnail->removeElement($thumbnail);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): static
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->user->removeElement($user);

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): static
    {
        $this->game = $game;

        return $this;
    }
}
