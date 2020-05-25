<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/wild", name="wild_")
 */

class WildController extends AbstractController
{
    /**
     * @Route("/show/{slug}",
     * requirements={"slug"="[a-z-0-9\-]+"}, name="show")
     *
     * */
    public function show(string $slug =''): Response
    {
        if ($slug == '')
        {
            $name = 'Aucune série selectionnée, veuillez choisir une série';
        }
        else
        {
            $name = ucwords(str_replace('-', ' ', $slug));
        }

        return $this->render('wild/show.html.twig', ['name' => $name]);
    }


}
