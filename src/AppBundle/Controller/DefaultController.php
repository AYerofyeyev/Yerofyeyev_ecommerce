<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Feedback;
use AppBundle\Entity\Goods;
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
        $products = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Goods')
            ->findBy(['category' => 1])
        ;
        return ['products' => $products];
    }

    /**
     * @Route("/tablet", name="tablet")
     * @Template()
     */
    public function tabletAction()
    {
        $products = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Goods')
            ->findBy(['category' => 2])
        ;
        return ['products' => $products];
    }

    /**
     * @Route("/{id}", name="show_item", requirements={"id": "[0-9]+"})
     */
    public function showAction(Goods $goods)
    {
        $products = [1 => $goods];
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
            //Email message
            $message = (new \Swift_Message('Site Feedback'))
                ->setFrom(['a.yerofeyev@nlg.kiev.ua' => 'Feedback'])
                ->setTo('a.yerofeyev@nlg.kiev.ua')
                ->setBody( 'From: ' . $feedback->getEmail()
                    . PHP_EOL
                    . 'With IP address: ' . $feedback->getIpAddress()
                    . PHP_EOL
                    . 'Sent: ' . $feedback->getCreatedAt()->format('d/m/Y')
                    . PHP_EOL
                    . $feedback->getMessage());

            $result = $this->get('mailer')->send($message);

            $em = $this->getDoctrine()->getManager();

            $em->persist($feedback);
            $em->flush();

            $this->addFlash('success', $result . ' message(s) sent.');


            return $this->redirectToRoute('feedback');
        }

        return ['feedback_form' => $form->createView()];
    }
}
