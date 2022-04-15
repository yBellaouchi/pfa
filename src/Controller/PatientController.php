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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


#[Route('/patient')]
class PatientController extends AbstractController
{
    #[Route('/', name: 'app_patient_index')]
    public function index(Request $request,EntityManagerInterface $entityManager): Response
    {
        $patient = new Patient();
        $patients = $entityManager->getRepository(Patient::class)->findAll();
        $form = $this->createForm(PatientSearchType::class, $patient);
        $form->handleRequest($request);
        
       
        if ($form->isSubmitted() && $form->isValid()) {
            
            $firstName = $form['FirstName']->getData();
            $patients = $entityManager->getRepository(Patient::class)->findBy( ['FirstName' => $firstName]);
          
           
        }
        
      
        return $this->render('patient/index.html.twig', [
            'patients' => $patients,
            'form'=>$form->createView()
            
        ]);
    }

    #[Route('/new', name: 'app_patient_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PatientRepository $patientRepository): Response
    {
        $patient = new Patient();
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $patientRepository->add($patient);
            return $this->redirectToRoute('app_patient_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('patient/new.html.twig', [
            'patient' => $patient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_patient_show', methods: ['GET'])]
    public function show(Patient $patient): Response
    {
        return $this->render('patient/show.html.twig', [
            'patient' => $patient,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_patient_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Patient $patient, PatientRepository $patientRepository): Response
    {
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $patientRepository->add($patient);
            return $this->redirectToRoute('app_patient_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('patient/edit.html.twig', [
            'patient' => $patient,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/editPatient/{id}", name="editPatient")
     *
     */
   
    public function editPatient($id,Request $request, EntityManagerInterface $entityManager):Response{
   
        $patient = $entityManager->getRepository(Patient::class)->find($id);


        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ){
         
            $entityManager->persist($patient);
        $entityManager->flush();
     
        
        
        return $this->redirect($this->generateUrl("app_patient_index"));
            
      
        } 
        return $this->render('patient/edit.html.twig', [
            'patient' => $patient,
            'form' => $form->createView()
        ]);
    }
       /**
     * @Route("/deletePatient/{id}", name="deletePatient")
     *
     */
   
    public function deletePatient($id,EntityManagerInterface $entityManager):Response{
       
                $c = $entityManager->getRepository(Patient::class)->find($id);
                $entityManager->remove($c);
                $entityManager->flush();
             
                
              return $this->redirect($this->generateUrl("app_patient_index"));
            
            
            }
    #[Route('/{id}', name: 'app_patient_delete', methods: ['POST'])]
    public function delete(Request $request, $id, Patient $patient,EntityManagerInterface $entityManager, PatientRepository $patientRepository): Response
    {
        $patient = $entityManager->getRepository(produit::class)->find($id);
        $entityManager->remove($patient);
        $patientRepository->remove($patient);

        if ($this->isCsrfTokenValid('delete'.$patient->getId(), $request->request->get('_token'))) {
            $patientRepository->remove($patient);
        }

        return $this->redirectToRoute('app_patient_index', [], Response::HTTP_SEE_OTHER);
    }
    
}
