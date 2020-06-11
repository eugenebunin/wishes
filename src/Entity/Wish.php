<?php
declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository")
 */
class Wish
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="string")
     */
    private string $id;

    /**
     * @ORM\Column(name="title", type="string")
     */
    private string $title;

    /**
     * @ORM\Column(name="price", type="string")
     */
    private string $price;

    /**
     * @ORM\Column(name="state", type="integer")
     */
    private int $state;

    /**
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private DateTime $updatedAt;

    public function __construct(string $id, string $title, string $price, int $state, DateTime $createdAt, DateTime $updatedAt)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->state = $state;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getState(): int
    {
        return $this->state;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setState(int $state): void
    {
        $this->state = $state;
    }
}
