<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Pages;
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
        $em = $this->getDoctrine()->getManager();
        $em->persist($pages);
        $em->flush();
        return new Response('<html><body>Запись добавлена!</body></html>');
    }

    /**
     * @Route("/pages/{page}")
     */
    public function showAction($page)
    {
        $a = 'some *text* one';
        $cache = $this->get('doctrine_cache.providers.my_markdown_cache');
        $key = md5($a);
        if ($cache->contains($key)) {
            $a = $cache->fetch($key);
        }else {
            sleep(1); // fake how slow this could be
            $a = $this->get('markdown.parser')
                ->transform($a);
            $cache->save($key, $a);
        }
        return $this->render('pages/show.html.twig', [
            'show' => $page,
            'a' => $a
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
}