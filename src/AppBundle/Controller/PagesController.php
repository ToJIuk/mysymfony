<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Pages;
use AppBundle\Service\TolikService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PagesController extends Controller
{
    /**
     * @Route("/pages/new")
     */
    public function newAction()
    {
        $pages = new Pages();
        $pages->setName('some digit: '.rand(1, 100));
        $pages->setOld(rand(100, 999));
        $em = $this->getDoctrine()->getManager();
        $em->persist($pages);
        $em->flush();
        return new Response('<html><body>Запись добавлена!</body></html>');
    }

    /**
     * @Route("/pages")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $list = $em->getRepository('AppBundle:Pages')->findAll();

        return $this->render('pages/list.html.twig', [
            'pages' => $list
        ]);
    }
    /**
     * @Route("/pages/{page}", name="page_show")
     */
    public function showAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $pag = $em->getRepository('AppBundle:Pages')
            ->findOneBy(['name' => $page]);

        $myservice = new TolikService($this->get('markdown.parser'));
        $text = $myservice->myserv($pag->getName());
        /*$a = 'some *text* one';
        $cache = $this->get('doctrine_cache.providers.my_markdown_cache');
        $key = md5($a);
        if ($cache->contains($key)) {
            $a = $cache->fetch($key);
        }else {
            sleep(1); // fake how slow this could be
            $a = $this->get('markdown.parser')
                ->transform($a);
            $cache->save($key, $a);
        }*/
        return $this->render('pages/show.html.twig', [
            'show' => $page,
            'text' => $text,
            'pages' => $pag
        ]);
    }

    /**
     * @Route("/pages/{page}/notes", name = "pages_test")
     * @Method("GET")
     */
    public function getNotesAction()
    {
        $notes = [
          ['id' => 1, 'name' => 'Tolik'],
            ['id' => 2, 'name' => 'Vika'],
        ];
        $data = [
            'notes' => $notes,
        ];
        return new JsonResponse($data);
    }

    public function mytestformAction()
    {
        $form = $this->createForm('AppBundle\Form\TestForm');

        return $this->render('main/mytestform.html.twig', [
            'myform' => $form->createView()
        ]);
    }
}