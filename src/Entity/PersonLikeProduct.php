<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="person_like_product")
 * @UniqueEntity(
 *     fields={"person", "product"},
 *     errorPath="product",
 *     message="This product is already in use by this person."
 * )
 */
class PersonLikeProduct
{
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="categoryProducts")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $product;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="categoryProducts")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id", nullable=false)
     */
    private $person;

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct($product): void
    {
        $this->product = $product;
    }

    public function getPerson()
    {
        return $this->person;
    }

    public function setPerson($person): void
    {
        $this->person = $person;
    }





}
