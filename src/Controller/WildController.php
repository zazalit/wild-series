<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Program;
use App\Entity\Category;

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

    /**
     * @Route("/category/{categoryName}", name="show_category")
     * @param string $categoryName
     * @return Response
     */
    public function showByCategory(string $categoryName) {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' =>($categoryName)]);

        $series = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(['category'=> $category], ['id'=>'DESC'], 3 );

        return $this->render('wild/category.html.twig',
            ['ListOfSeries' => $series]);
    }
}
