<?php
/**
 * Created by PhpStorm.
 * User: Толик
 * Date: 27.09.2017
 * Time: 16:34
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PagesController extends Controller
{
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