<?php

namespace App\Controller;

use App\Entity\Nurse;
use App\Form\NurseType;
use App\Form\NurseSearchType;
use App\Form\NursePlanningType;

use App\Repository\NurseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\Extension\Core\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


#[Route('/nurse')]
class NurseController extends AbstractController
{

    public function __construct( )
    {
        
    }
    
 /**
     * @Route("/", name="list_nurses")
     *
     */
    public function index(Request $request,EntityManagerInterface $entityManager): Response
    {
        $nurse = new Nurse();
        $nurses = $entityManager->getRepository(Nurse::class)->findAll();
        $form = $this->createForm(NurseSearchType::class, $nurse);
        $form->handleRequest($request);
        
       
        if ($form->isSubmitted() && $form->isValid()) {
            
            $firstName = $form['FirstName']->getData();
            $nurses = $entityManager->getRepository(Nurse::class)->findBy( ['FirstName' => $firstName]);
          
           
        }
        
      
        return $this->render('nurse/list.html.twig', [
            'nurses' => $nurses,
            'form'=>$form->createView()
            
        ]);
    }

     /**
     * @Route("/addNurse ", name="add_nurse")
     *
     */
    public function new(Request $request,EntityManagerInterface $entityManager): Response
    {
        $nurse = new Nurse();
        $form = $this->createForm(NurseType::class, $nurse);
        $form->handleRequest($request);
        // dd($form);
        if ($form->isSubmitted()&& $form->isValid()) {
            // dd($form);
            $entityManager->persist($nurse);
            $entityManager->flush();
         
            return $this->redirectToRoute('list_nurses', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nurse/new.html.twig', [
            'nurse' => $nurse,
            'form' => $form,
        ]);
    }

  
     /**
     * @Route("/{id}/showNurse", name="show_nurse")
     *
     */
    public function show(Nurse $nurse): Response
    {
        return $this->render('nurse/show.html.twig', [
            'nurse' => $nurse,
        ]);
    }

  
 
    /**
     * @Route("/editNurse/{id}", name="edit_nurse")
     *
     */
   
    public function editNurse($id,Request $request, EntityManagerInterface $entityManager):Response{
   
        $nurse = $entityManager->getRepository(Nurse::class)->find($id);


        $form = $this->createForm(NurseType::class, $nurse);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ){
         
            $entityManager->persist($nurse);
        $entityManager->flush();
     
        
        
        return $this->redirect($this->generateUrl("list_nurses"));
            
      
        } 
        return $this->render('nurse/edit.html.twig', [
            'nurse' => $nurse,
            'form' => $form->createView()
        ]);
    }
       /**
     * @Route("/deleteNurse/{id}", name="delete_nurse")
     *
     */
   
    public function deletePatient($id,EntityManagerInterface $entityManager):Response{
       
                $nurse = $entityManager->getRepository(Nurse::class)->find($id);
                $entityManager->remove($nurse);
                $entityManager->flush();
             
                
              return $this->redirect($this->generateUrl("list_nurses"));
            
            
            }
    
       
    
              /**
     * @Route("/planning", name="planning_nurse")
     *
     */

   
    public function planning(Request $request):Response{
     
        $form = $this->createForm(NursePlanningType::class);
        $form->handleRequest($request);
         
        $nursesMorning=new ArrayCollection();
        $nurses=new ArrayCollection();
        $nurse=new Nurse();
        if ($form->isSubmitted()&& $form->isValid()) {
             
           
           
             $group=$form['Group']->getData();
             $nurse= $form['FirstName']->getData();
            $firstName=$nurse->FirstName;
            
         if($group="mornig group"){
             $nurses[]=$firstName;
         }
         else if ($group="evening group"){
            $nurses[]=$firstName;
        }else {
            $nurses[]=$firstName;
        }
         
            return $this->redirectToRoute('planning_nurse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nurse/planning.htm.twig', [
             'nurses' => $nurses,
            'form' => $form,
        ]);
    
    }

}
