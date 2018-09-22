<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Feedback;
use AppBundle\Form\FeedbackType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
//        return $this->render('default/index.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
//        ]);
//        return $this->render('@App/Default/index.html.twig');
    }

    /**
     * @Route("/mobile", name="mobile")
     * @Template()
     */
    public function mobileAction()
    {
        $products = [
            1 => 120393,
            120394
        ];
        return ['products' => $products];
    }

    /**
     * @Route("/{id}", name="mobile_item", requirements={"id": "[0-9]+"})
     */
    public function showAction($id)
    {
        $products = [
            1 => $id
        ];

        return $this->render('@App/Default/mobile.html.twig', ['products' => $products]);
    }

    /**
     * @Route("/feedback", name="feedback")
     * @Template()
     */
    public function feedbackAction(Request $request)
    {
        $feedback = new Feedback();
        $feedback->setIpAddress($request->getClientIp());
        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($feedback);
            $em->flush();

            $this->addFlash('success', 'Message sent.');
            return $this->redirectToRoute('feedback');
        }

        return ['feedback_form' => $form->createView()];
    }
}
