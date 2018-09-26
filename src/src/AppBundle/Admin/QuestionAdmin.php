<?php

namespace AppBundle\Admin;

use AppBundle\Type\QuestionType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sonata\AdminBundle\Show\ShowMapper;

class QuestionAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('questionText')
            ->add('questionType', 'doctrine_orm_string', [], 'choice', ['choices' => QuestionType::getChoices()])
            ->add('isRequired')
            ->add('description')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('questionText')
            ->add('questionType')
            ->add('isRequired')
            ->add('description')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('questionText')
            ->add('questionType', ChoiceType::class, [
                'choices' => QuestionType::getChoices()
            ])
            ->add('isRequired')
            ->add('description')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('questionText')
            ->add('questionType')
            ->add('isRequired')
            ->add('description')
        ;
    }
}
