<?php

namespace App\Entity;

use App\Repository\AccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AccountRepository::class)
 */
class Account
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=26, unique=true)
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $pin;

    /**
     * @ORM\Column(type="date")
     */
    private $created;

    /**
     * @ORM\Column(type="float")
     */
    private $cash;

    /**
     * @ORM\OneToMany(targetEntity=AccountHistory::class, mappedBy="account")
     */
    private $accountHistories;

    public function __construct()
    {
        $this->accountHistories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getPin(): ?string
    {
        return $this->pin;
    }

    public function setPin(string $pin): self
    {
        $this->pin = $pin;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getCash(): ?float
    {
        return $this->cash;
    }

    public function setCash(float $cash): self
    {
        $this->cash = $cash;

        return $this;
    }

    /**
     * @return Collection<int, AccountHistory>
     */
    public function getAccountHistories(): Collection
    {
        return $this->accountHistories;
    }

    public function addAccountHistory(AccountHistory $accountHistory): self
    {
        if (!$this->accountHistories->contains($accountHistory)) {
            $this->accountHistories[] = $accountHistory;
            $accountHistory->setAccount($this);
        }

        return $this;
    }

    public function removeAccountHistory(AccountHistory $accountHistory): self
    {
        if ($this->accountHistories->removeElement($accountHistory)) {
            // set the owning side to null (unless already changed)
            if ($accountHistory->getAccount() === $this) {
                $accountHistory->setAccount(null);
            }
        }

        return $this;
    }
}
