<?php declare(strict_types = 1);

namespace Application\Migrations;

use AppBundle\Entity\Question;
use AppBundle\Entity\Survey;
use AppBundle\Repository\QuestionRepository;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180426191908 extends AbstractMigration implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface $container
     */
    private $container;

    private $questionList = [
        [
            'questionText' => 'Please evaluate speaker communication skills, from 1 to 10',
            'questionType' => 'number',
            'isRequired' => true,
            'description' => ''
        ],
        [
            'questionText' => 'Please evaluate prepared materials, from 1 to 10',
            'questionType' => 'number',
            'isRequired' => true,
            'description' => ''
        ],
        [
            'questionText' => 'Have you found this workshop useful?',
            'questionType' => 'text',
            'isRequired' => true,
            'description' => ''
        ],
        [
            'questionText' => 'Provide additional comments or feedback about the workshop and how to improve it.',
            'questionType' => 'text',
            'isRequired' => false,
            'description' => ''
        ]
    ];

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function up(Schema $schema)
    {
        /**
         * @var QuestionRepository $questionRepository
         * @var EntityManager $em
         */
        $em = $this->container->get('doctrine.orm.entity_manager');

        $survey = new Survey();
        $survey->setSlug('workshop-feedback')
        ->setIsActive(true)
        ->setTitle('Workshop feedback');

        foreach ($this->questionList as $question) {
            $questionEntity = new Question();
            $questionEntity->setQuestionText($question['questionText'])
                ->setQuestionType($question['questionType'])
                ->setIsRequired($question['isRequired'])
                ->setDescription($question['description']);
            $survey->addQuestion($questionEntity);
            $em->persist($questionEntity);
        }
        $em->persist($survey);
        $em->flush();
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
