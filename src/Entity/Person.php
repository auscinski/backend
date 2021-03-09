<?php
declare(strict_types=1);

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 *
 * @ORM\Table(name="person")
 * @ORM\Entity
 */
class Person
{
    const STATUSES = [
        'aktywny' => 1,
        'banned' => 2,
        'usunięty' => 3,
    ];

    /**
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     *
     * @ORM\Column(name="login", type="string", length=10, nullable=false)
     */
    private string $login;

    /**
     *
     * @ORM\Column(name="l_name", type="string", length=100, nullable=false, options={"comment"="last name"})
     */
    private string $lName;

    /**
     *
     * @ORM\Column(name="f_name", type="string", length=100, nullable=false, options={"comment"="first name"})
     */
    private string $fName;

    /**
     *
     * @ORM\Column(name="state", type="smallint", nullable=false, options={"unsigned"=true,"comment"="1 - active, 2- banned, 3 - deleted"})
     */
    private int $state;

    /**
     * @ORM\OneToMany(targetEntity="PersonLikeProduct", mappedBy="person")
     */
    private $personLikeProducts;

    private string $stateName;


    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getLName(): ?string
    {
        return $this->lName;
    }

    public function setLName(string $lName): self
    {
        $this->lName = $lName;

        return $this;
    }

    public function getFName(): ?string
    {
        return $this->fName;
    }

    public function setFName(string $fName): self
    {
        $this->fName = $fName;

        return $this;
    }

    public function getState(): ?int
    {
        return $this->state;
    }

    public function setState(int $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getStateName(): ?string
    {
        return $this->stateName;
    }

    /**
     * @param string $stateName
     */
    public function setStateName(string $stateName): void
    {
        $this->stateName = $stateName;
    }

    public function __toString(): string
    {
        return $this->getFName() . " " . $this->getLName();
    }

}
