<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Question;
use AppBundle\Entity\Respondent;
use AppBundle\Entity\RespondentAnswer;
use AppBundle\Entity\Survey;
use AppBundle\Form\SurveyFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/survey")
 *
 * Class SurveyController
 * @package AppBundle\Controller
 */
class SurveyController extends Controller
{
    /**
     * @Route("/{slug}", name="display_survey")
     *
     * @param Request $request
     * @param         $slug
     *
     * @return Response
     * @throws \Exception
     */
    public function displaySurveyAction(Request $request, $slug)
    {
        $surveyRepository = $this->getDoctrine()->getRepository(Survey::class);
        /**
         * @var Survey $survey
         */
        $survey = $surveyRepository->findOneBy(['slug' => $slug, 'isActive' => true]);

        if (!$survey) {
            throw $this->createNotFoundException('Not found');
        }

        if(!$survey->getQuestions()) {
            throw new \Exception('There is no any questions for this survey');
        }

        $respondent = new Respondent();

        /**
         * @var Question $question
         */
        foreach ($survey->getQuestions() as $question) {
            $answer = new RespondentAnswer();
            $answer->setQuestion($question);
            $respondent->addRespondentAnswer($answer);
        }

        $form = $this->createForm(SurveyFormType::class, $respondent);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($respondent);
            $entityManager->flush();
        }

        return $this->render('@App/Survey/form.html.twig', [
            'surveyForm' => $form->createView()
        ]);
    }
}