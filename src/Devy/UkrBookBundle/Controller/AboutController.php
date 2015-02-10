<?php

namespace Devy\UkrBookBundle\Controller;

use Devy\UkrBookBundle\Entity\AboutPage;
use Devy\UkrBookBundle\Form\AboutPageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Parser;

/**
 * Class AboutController
 * @package Devy\UkrBookBundle\Controller
 */
class AboutController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function editAction(Request $request)
    {
        $yaml = new Parser();
        $path = $this->container->getParameter('about');
        try {
            $value = $yaml->parse(file_get_contents($path));
        } catch (ParseException $e) {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
        }
        if (!isset($value)) {
            throw new \UnexpectedValueException();
        }
        $entity = new AboutPage();
        $entity
            ->setTitle($value['title'])
            ->setAddress($value['address'])
            ->setContacts($value['contacts']);
        $form = $this->createForm(new AboutPageType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $value = [];
            $value['title'] = $entity->getTitle();
            $value['address'] = $entity->getAddress();
            $value['contacts'] = $entity->getContacts();
            $dumper = new Dumper();
            $yaml = $dumper->dump($value, 2);

            file_put_contents($path, $yaml);

            $this->get('session')->getFlashBag()->add('success', 'Changes saved!');
        }

        return $this->render('DevyUkrBookBundle:AboutPage:edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
