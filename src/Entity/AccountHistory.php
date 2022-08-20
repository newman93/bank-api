<?php

namespace App\Entity;

use App\Repository\AccountHistoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AccountHistoryRepository::class)
 */
class AccountHistory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $operation;

    /**
     * @ORM\Column(type="float")
     */
    private $cash;

    /**
     * @ORM\Column(type="date")
     */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity=Account::class, inversedBy="accountHistories")
     */
    private $account;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOperation(): ?int
    {
        return $this->operation;
    }

    public function setOperation(int $operation): self
    {
        $this->operation = $operation;

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

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(?Account $account): self
    {
        $this->account = $account;

        return $this;
    }
}
