<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RespondentAnswer
 *
 * @ORM\Table(name="respondent_answer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RespondentAnswerRepository")
 */
class RespondentAnswer
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
     * @var Respondent
     *
     * @ORM\ManyToOne(targetEntity="Respondent", inversedBy="respondentAnswers", cascade={"persist"})
     */
    private $respondent;

    /**
     * @var Question
     *
     * @ORM\ManyToOne(targetEntity="Question")
     */
    private $question;

    /**
     * @var string|null
     *
     * @ORM\Column(name="answer", type="string", length=255, nullable=true)
     */
    private $answer;


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
     * Set respondent.
     *
     * @param Respondent $respondent
     *
     * @return RespondentAnswer
     */
    public function setRespondent(Respondent $respondent)
    {
        $this->respondent = $respondent;

        return $this;
    }

    /**
     * Get respondent.
     *
     * @return Respondent
     */
    public function getRespondent()
    {
        return $this->respondent;
    }

    /**
     * Set question.
     *
     * @param Question $question
     *
     * @return RespondentAnswer
     */
    public function setQuestion(Question $question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question.
     *
     * @return Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set answer.
     *
     * @param string|null $answer
     *
     * @return RespondentAnswer
     */
    public function setAnswer($answer = null)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer.
     *
     * @return string|null
     */
    public function getAnswer()
    {
        return $this->answer;
    }
}
