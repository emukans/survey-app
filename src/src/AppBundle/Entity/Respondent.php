<?php

namespace AppBundle\Entity;

use AppBundle\Entity\RespondentAnswer;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Respondent
 *
 * @ORM\Table(name="respondent")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RespondentRepository")
 */
class Respondent
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="RespondentAnswer", mappedBy="respondent", cascade={"persist"})
     */
    private $respondentAnswers;


    public function __construct()
    {
        $this->respondentAnswers = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name|null
     *
     * @return Respondent
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Add respondentAnswer.
     *
     * @param RespondentAnswer $respondentAnswer
     *
     * @return Respondent
     */
    public function addRespondentAnswer(RespondentAnswer $respondentAnswer)
    {
        $this->respondentAnswers->add($respondentAnswer);
        $respondentAnswer->setRespondent($this);

        return $this;
    }

    /**
     * Remove respondentAnswer.
     *
     * @param RespondentAnswer $respondentAnswer
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeRespondentAnswer(RespondentAnswer $respondentAnswer)
    {
        return $this->respondentAnswers->removeElement($respondentAnswer);
    }

    /**
     * Get respondentAnswers.
     *
     * @return Collection
     */
    public function getRespondentAnswers()
    {
        return $this->respondentAnswers;
    }
}
