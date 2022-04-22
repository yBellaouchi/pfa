<?php

namespace App\Controller;

use App\Entity\Consultation;
use App\Entity\Patient;
use App\Form\ConsultationSearchType;
use App\Form\ConsultationType;
use App\Repository\PatientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;



#[Route('/consultation')]
class ConsultationController extends AbstractController
{
    
 /**
     * @Route("/", name="list_consultations")
     *
     */
    public function index(Request $request,EntityManagerInterface $entityManager): Response
    {
        $consultation = new Consultation();
        $consultations = $entityManager->getRepository(Consultation::class)->findAll();
        $form = $this->createForm(ConsultationSearchType::class, $consultation);
        $form->handleRequest($request);
        
       
        if ($form->isSubmitted() && $form->isValid()) {
            $patient =new Patient();
            $patient = $form['Patient']->getData();
            
            $FullName=$patient->getFullName();
            $id=$patient->getId();
            
            
            $consultations = $entityManager->getRepository(Consultation::class)->findBy( ['Patient' => $patient]);
          
           
        }
        
      
        return $this->render('consultation/list.html.twig', [
            'consultations' => $consultations,
             'form'=>$form->createView()
            
        ]);
    }

     /**
     * @Route("/addConsultation ", name="add_consultation")
     *
     */
    public function new(Request $request,EntityManagerInterface $entityManager, PatientRepository $patientRepository): Response
    {
        $consultation = new Consultation();
        $form = $this->createForm(ConsultationType::class, $consultation);
        $form->handleRequest($request);
        // dd($form);
        if ($form->isSubmitted()&& $form->isValid()) {
            // dd($form);
            $entityManager->persist($consultation);
            $entityManager->flush();
         
            return $this->redirectToRoute('list_consultations', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('consultation/new.html.twig', [
            'consultation' => $consultation,
            'form' => $form,
        ]);
    }

  
     /**
     * @Route("/{id}", name="show_consultation")
     *
     */
    public function show(Consultation $consultation): Response
    {
        return $this->render('consultation/show.html.twig', [
            'consultation' => $consultation,
        ]);
    }

  
 
    /**
     * @Route("/editConsultation/{id}", name="edit_consultation")
     *
     */
   
    public function editConsultation($id,Request $request, EntityManagerInterface $entityManager):Response{
   
        $consultation = $entityManager->getRepository(Consultation::class)->find($id);


        $form = $this->createForm(ConsultationType::class, $consultation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ){
         
            $entityManager->persist($consultation);
        $entityManager->flush();
     
        
        
        return $this->redirect($this->generateUrl("list_consultations"));
            
      
        } 
        return $this->render('consultation/edit.html.twig', [
            'consultation' => $consultation,
            'form' => $form->createView()
        ]);
    }
       /**
     * @Route("/deleteConsultation/{id}", name="delete_consultation")
     *
     */
   
    public function deleteConsultation($id,EntityManagerInterface $entityManager):Response{
       
                $c = $entityManager->getRepository(Consultation::class)->find($id);
                $entityManager->remove($c);
                $entityManager->flush();
             
                
              return $this->redirect($this->generateUrl("list_consultations"));
            
            
            }
    
}
