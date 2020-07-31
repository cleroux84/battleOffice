<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdersRepository::class)
 */
class Orders
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity=Clients::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=true)
     */
    private $client;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $api_id;

    public function getId(): ?int
    {
        return $this->id;
    }
  

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getClient(): ?Clients
    {
        return $this->client;
    }

    public function setClient(?Clients $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getApiId(): ?int
    {
        return $this->api_id;
    }

    public function setApiId(?int $api_id): self
    {
        $this->api_id = $api_id;

        return $this;
    }

}
