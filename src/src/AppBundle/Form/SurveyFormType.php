<?php


namespace AppBundle\Form;


use AppBundle\Entity\Respondent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SurveyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, [
            'label'    => 'Name (Optional)',
            'required' => false
        ]);

        $builder->add('respondentAnswers', CollectionType::class, [
            'entry_type'    => AnswerFormType::class,
            'by_reference'  => false,
            'entry_options' => ['label' => false],
            'label'         => false
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Respondent::class]);
    }
}