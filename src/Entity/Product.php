<?php
declare(strict_types=1);

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private string $name;

    /**
     *
     * @ORM\Column(name="info", type="text", length=65535, nullable=false, options={"comment"="opis html"})
     */
    private string $info;

    /**
     *
     * @ORM\Column(name="public_date", type="date", nullable=false, options={"comment"="w sprzedazy od"})
     */
    private DateTime $publicDate;


    /**
     * @ORM\OneToMany(targetEntity="PersonLikeProduct", mappedBy="product")
     */
    private $personLikeProducts;

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(string $info): self
    {
        $this->info = $info;

        return $this;
    }

    public function getPublicDate(): ?DateTimeInterface
    {
        return $this->publicDate;
    }

    public function setPublicDate(DateTimeInterface $publicDate): self
    {
        $this->publicDate = $publicDate;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }

}
