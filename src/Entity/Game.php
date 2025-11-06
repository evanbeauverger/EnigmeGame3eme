<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $welcome_msg = null;

    #[ORM\Column(length: 255)]
    private ?string $welcome_img = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Setting $setting = null;

    /**
     * @var Collection<int, Team>
     */
    #[ORM\OneToMany(targetEntity: Team::class, mappedBy: 'game')]
    private Collection $team;

    /**
     * @var Collection<int, Enigma>
     */
    #[ORM\OneToMany(targetEntity: Enigma::class, mappedBy: 'game')]
    private Collection $enigma;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'games')]
    private Collection $user;

    public function __construct()
    {
        $this->team = new ArrayCollection();
        $this->enigma = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getWelcomeMsg(): ?string
    {
        return $this->welcome_msg;
    }

    public function setWelcomeMsg(string $welcome_msg): static
    {
        $this->welcome_msg = $welcome_msg;

        return $this;
    }

    public function getWelcomeImg(): ?string
    {
        return $this->welcome_img;
    }

    public function setWelcomeImg(string $welcome_img): static
    {
        $this->welcome_img = $welcome_img;

        return $this;
    }

    public function getSetting(): ?Setting
    {
        return $this->setting;
    }

    public function setSetting(?Setting $setting): static
    {
        $this->setting = $setting;

        return $this;
    }

    /**
     * @return Collection<int, Team>
     */
    public function getTeam(): Collection
    {
        return $this->team;
    }

    public function addTeam(Team $team): static
    {
        if (!$this->team->contains($team)) {
            $this->team->add($team);
            $team->setGame($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): static
    {
        if ($this->team->removeElement($team)) {
            // set the owning side to null (unless already changed)
            if ($team->getGame() === $this) {
                $team->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Enigma>
     */
    public function getEnigma(): Collection
    {
        return $this->enigma;
    }

    public function addEnigma(Enigma $enigma): static
    {
        if (!$this->enigma->contains($enigma)) {
            $this->enigma->add($enigma);
            $enigma->setGame($this);
        }

        return $this;
    }

    public function removeEnigma(Enigma $enigma): static
    {
        if ($this->enigma->removeElement($enigma)) {
            // set the owning side to null (unless already changed)
            if ($enigma->getGame() === $this) {
                $enigma->setGame(null);
            }
        }

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
}
