<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Form\PatientType;
use App\Form\PatientSearchType;
use App\Repository\PatientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;



#[Route('/patient')]
class PatientController extends AbstractController
{
    
 /**
     * @Route("/", name="list_patients")
     *
     */
    public function index(Request $request,EntityManagerInterface $entityManager): Response
    {
        $patient = new Patient();
        $patients = $entityManager->getRepository(Patient::class)->findAll();
        $form = $this->createForm(PatientSearchType::class, $patient);
        $form->handleRequest($request);
        
       
        if ($form->isSubmitted() && $form->isValid()) {
            
            $FullName = $form['FullName']->getData();
            $patients = $entityManager->getRepository(Patient::class)->findBy( ['FullName' => $FullName]);
          
           
        }
        
      
        return $this->render('patient/list.html.twig', [
            'patients' => $patients,
            'form'=>$form->createView()
            
        ]);
    }

     /**
     * @Route("/addPatient ", name="add_patient")
     *
     */
    public function new(Request $request,EntityManagerInterface $entityManager, PatientRepository $patientRepository): Response
    {
        $patient = new Patient();
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);
        // dd($form);
        if ($form->isSubmitted()&& $form->isValid()) {
            // dd($form);
            $entityManager->persist($patient);
            $entityManager->flush();
         
            return $this->redirectToRoute('list_patients', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('patient/new.html.twig', [
            'patient' => $patient,
            'form' => $form,
        ]);
    }

  
     /**
     * @Route("/{id}", name="show_patient")
     *
     */
    public function show(Patient $patient): Response
    {
        return $this->render('patient/show.html.twig', [
            'patient' => $patient,
        ]);
    }

  
 
    /**
     * @Route("/editPatient/{id}", name="edit_patient")
     *
     */
   
    public function editPatient($id,Request $request, EntityManagerInterface $entityManager):Response{
   
        $patient = $entityManager->getRepository(Patient::class)->find($id);


        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ){
         
            $entityManager->persist($patient);
        $entityManager->flush();
     
        
        
        return $this->redirect($this->generateUrl("list_patients"));
            
      
        } 
        return $this->render('patient/edit.html.twig', [
            'patient' => $patient,
            'form' => $form->createView()
        ]);
    }
       /**
     * @Route("/deletePatient/{id}", name="delete_patient")
     *
     */
   
    public function deletePatient($id,EntityManagerInterface $entityManager):Response{
       
                $c = $entityManager->getRepository(Patient::class)->find($id);
                $entityManager->remove($c);
                $entityManager->flush();
             
                
              return $this->redirect($this->generateUrl("list_patients"));
            
            
            }
    
}
