namespace App\Controller;

use App\Entity\Event;
use App\Entity\Camp;
use App\Entity\InterestGroup;
use App\Form\EventType;
use App\Form\CampType;
use App\Form\InterestGroupType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends AbstractController
{
    public function createEvent(Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($event);
            $entityManager->flush();
            $this->addFlash('success', 'Event byl úspěšně vytvořen.');
            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin/create_event.html.twig', ['form' => $form->createView()]);
    }

    public function createCamp(Request $request, EntityManagerInterface $entityManager): Response
    {
        $camp = new Camp();
        $form = $this->createForm(CampType::class, $camp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($camp);
            $entityManager->flush();
            $this->addFlash('success', 'Tábor byl úspěšně vytvořen.');
            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin/create_camp.html.twig', ['form' => $form->createView()]);
    }

    public function createInterestGroup(Request $request, EntityManagerInterface $entityManager): Response
    {
        $group = new InterestGroup();
        $form = $this->createForm(InterestGroupType::class, $group);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($group);
            $entityManager->flush();
            $this->addFlash('success', 'Zájmový útvar byl úspěšně vytvořen.');
            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin/create_interest_group.html.twig', ['form' => $form->createView()]);
    }
}
