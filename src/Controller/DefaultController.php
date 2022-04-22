<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\Doctor;
use App\Entity\User;
use App\Repository\AdminRepository;
use App\Repository\DoctorRepository;
use App\Repository\UserRepository;
// use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
#[Route('/default')]
class DefaultController extends AbstractController
{

    // /**
    //  * @var EntityManagerInterface
    //  */
    // private $entityManager;


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
        
    }
    #[Route('/default', name: 'app_default')]
    public function index(EntityManagerInterface $entityManager,DoctorRepository $doctorRepository): Response
    {
        $user=new Admin();
        // $user->setFirstName("bbnn");
        // $user->setLastName("bbnn");
        // $user->setTelelphone("020202635");
        $user->setLogin("hhhh");
        $user->setPassword("hdhd");
        $user->setCin("B21");
        $user->setRoles("nsns");
        
        $entityManager->persist($user);
        dd($user);
        $entityManager->flush();
        

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'doctor'=>$user
        ]);

    }

    #[Route('/list', name: 'list', methods: ['GET'])]
    public function indexx(EntityManagerInterface $entityManager,DoctorRepository $doctorRepository): Response
    {
        // $doctor=new Doctor();
        // $doctors = $entityManager->getRepository(Doctor::class)->findAll();
        // dd($doctors);


        return $this->render('default/index.html.twig', [
            'doctors' => $doctorRepository->findAll(),
        ]);
    }


    #[Route('/deletee/{id}', name: 'delete')]
    public function indexxx($id,Doctor $doctor,UserRepository $userRepository, EntityManagerInterface $entityManager,DoctorRepository $doctorRepository): Response
    {
        // $doctor=new Doctor();
        // $doctor = $entityManager->getRepository(Doctor::class)->find($id);
         dd($doctor);
        
                $entityManager->remove($doctor);
                $entityManager->flush();


        return $this->render('default/index.html.twig', [
             'doctors' => $doctorRepository->findAll(),
            'doctor'=>$doctor,
        ]);
    }

    #[Route('/afficher/{id}', name: 'delete')]
    public function indexxxx($id,Admin $doctor,UserRepository $userRepository, EntityManagerInterface $entityManager,AdminRepository $doctorRepository): Response
    {
        // $doctor=new Doctor();
        // $doctor = $entityManager->getRepository(Doctor::class)->find($id);
        //  dd($doctor);
        
                // $entityManager->remove($doctor);
                // $entityManager->flush();


        return $this->render('default/index.html.twig', [
             'doctors' => $doctorRepository->findAll(),
            'doctor'=>$doctor,
        ]);
    }


}
