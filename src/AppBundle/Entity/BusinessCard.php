<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Bafford\CSSColorValidatorBundle\Validator\Constraints as bAssert;

/**
 * BusinessCard
 *
 * @ORM\Table(name="business_card")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BusinessCardRepository")
 */
class BusinessCard
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 30,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     *
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 30,
     *      minMessage = "Your last name must be at least {{ limit }} characters long",
     *      maxMessage = "Your last name cannot be longer than {{ limit }} characters"
     * )
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your company name must be at least {{ limit }} characters long",
     *      maxMessage = "Your company name cannot be longer than {{ limit }} characters"
     * )
     *
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your position title must be at least {{ limit }} characters long",
     *      maxMessage = "Your position title cannot be longer than {{ limit }} characters"
     * )
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 6,
     *      max = 50,
     *      minMessage = "Your phone number must be at least {{ limit }} characters long",
     *      maxMessage = "Your phone number cannot be longer than {{ limit }} characters"
     * )
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     *
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="base_color", type="string", length=255)
     *
     * @bAssert\CSSColor()
     */
    private $baseColor;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\File(
     *     maxSize = "2048k",
     *     mimeTypes={"image/jpeg", "image/png", "image/gif"},
     *     mimeTypesMessage = "Please upload a valid picture"
     *     )
     */
    private $picture;

    /**
     * @return bool
     */
    public function storePicture()
    {
        $pictureFile = $this->getPicture();
        $pictureFileName = md5(uniqid()) . '.' . $pictureFile->guessExtension();

        $pictureFile->move(
            'pictures',
            $pictureFileName
        );

        $this->setPicture($pictureFileName);

        return true;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return BusinessCard
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return BusinessCard
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set company
     *
     * @param string $company
     *
     * @return BusinessCard
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set position
     *
     * @param string $position
     *
     * @return BusinessCard
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return BusinessCard
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return BusinessCard
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set baseColor
     *
     * @param string $baseColor
     *
     * @return BusinessCard
     */
    public function setBaseColor($baseColor)
    {
        $this->baseColor = $baseColor;

        return $this;
    }

    /**
     * Get baseColor
     *
     * @return string
     */
    public function getBaseColor()
    {
        return $this->baseColor;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return BusinessCard
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }
}

