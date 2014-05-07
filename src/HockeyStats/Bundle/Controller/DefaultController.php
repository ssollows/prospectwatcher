<?php

namespace HockeyStats\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use HockeyStats\Bundle\Entity\Prospect;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {

      $em = $this->getDoctrine()->getManager();
      $entities = $em->getRepository('HockeyStatsBundle:Prospect')->findAll();

      $form = $this->createFormBuilder()
        ->add('name', 'text')
        ->add('search', 'submit')
        ->getForm();

      $form->handleRequest($request);

      if ($form->isValid()) {
        $name = $form["name"]->getData();

        return $this->redirect($this->generateUrl('search_prospects', array('name' => $name)));
      }

      return $this->render('HockeyStatsBundle:Default:index.html.twig', array('form' => $form->createView(),
        'prospects' => $entities ));
    }

    public function searchProspectsAction(Request $request){
      $name = urlencode($request->query->get('name'));
      $results = file_get_contents('http://api.eliteprospects.com/v1/players?q='.$name);
      return $this->render('HockeyStatsBundle:Default:results.html.twig', array('results' => json_decode($results)
      ));
    }

    public function watchProspectAction($prospectId, $prospectName) {
      $entity = new Prospect();
      $entity->setProspectID($prospectId);
      $entity->setName($prospectName);

      $em = $this->getDoctrine()->getManager();
      $em->persist($entity);
      $em->flush();
      exit("Player added to watch list successfully");
    }

    public function removeProspectAction($id) {
      $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('HockeyStatsBundle:Prospect')->find($id);

      if (!$entity) {
          throw $this->createNotFoundException('Unable to find Player entity.');
      }

      $em->remove($entity);
      $em->flush();
      exit("stopped watching prospect successfully");
    }
}
