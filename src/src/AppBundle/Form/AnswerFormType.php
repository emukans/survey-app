<?php


namespace AppBundle\Form;


use AppBundle\Entity\Question;
use AppBundle\Entity\RespondentAnswer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnswerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            /**
             * @var Question $question
             */
            $question = $event->getData()->getQuestion();
            $event->getForm()->add('answer', $question->getQuestionType(), [
                'label'    => $question->getQuestionText(),
                'required' => $question->getIsRequired()
            ])
            ;
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => RespondentAnswer::class]);
    }
}