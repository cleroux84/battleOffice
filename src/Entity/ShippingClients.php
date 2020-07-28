<?php

namespace App\Entity;

use App\Repository\ShippingClientsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShippingClientsRepository::class)
 */
class ShippingClients
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom_shipping;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom_shipping;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse_shipping;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse_complement_shipping;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville_shipping;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $code_postal_shipping;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pays_shipping;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $telephone_shipping;

    /**
     * @ORM\OneToOne(targetEntity=Clients::class, cascade={"persist", "remove"})
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenomShipping(): ?string
    {
        return $this->prenom_shipping;
    }

    public function setPrenomShipping(?string $prenom_shipping): self
    {
        $this->prenom_shipping = $prenom_shipping;

        return $this;
    }

    public function getNomShipping(): ?string
    {
        return $this->nom_shipping;
    }

    public function setNomShipping(?string $nom_shipping): self
    {
        $this->nom_shipping = $nom_shipping;

        return $this;
    }

    public function getAdresseShipping(): ?string
    {
        return $this->adresse_shipping;
    }

    public function setAdresseShipping(?string $adresse_shipping): self
    {
        $this->adresse_shipping = $adresse_shipping;

        return $this;
    }

    public function getAdresseComplementShipping(): ?string
    {
        return $this->adresse_complement_shipping;
    }

    public function setAdresseComplementShipping(?string $adresse_complement_shipping): self
    {
        $this->adresse_complement_shipping = $adresse_complement_shipping;

        return $this;
    }

    public function getVilleShipping(): ?string
    {
        return $this->ville_shipping;
    }

    public function setVilleShipping(?string $ville_shipping): self
    {
        $this->ville_shipping = $ville_shipping;

        return $this;
    }

    public function getCodePostalShipping(): ?int
    {
        return $this->code_postal_shipping;
    }

    public function setCodePostalShipping(?int $code_postal_shipping): self
    {
        $this->code_postal_shipping = $code_postal_shipping;

        return $this;
    }

    public function getPaysShipping(): ?string
    {
        return $this->pays_shipping;
    }

    public function setPaysShipping(?string $pays_shipping): self
    {
        $this->pays_shipping = $pays_shipping;

        return $this;
    }

    public function getTelephoneShipping(): ?int
    {
        return $this->telephone_shipping;
    }

    public function setTelephoneShipping(?int $telephone_shipping): self
    {
        $this->telephone_shipping = $telephone_shipping;

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
}
