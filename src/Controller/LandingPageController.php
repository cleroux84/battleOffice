<?php

namespace App\Controller;

use App\Entity\Clients;
use App\Entity\Orders;
use App\Entity\Product;
use App\Entity\ShippingClients;
use App\Form\ClientType;
use App\Form\OrderType;
use App\Form\ShippingType;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LandingPageController extends AbstractController
{
    /**
     * @Route("/", name="landing_page")
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $produits = $this->getDoctrine()
        ->getRepository(Product::class)
        ->findAll();
     /*    foreach($produits as $produit){
        dd($produit->getInitialPrice());} */
        //Formulaire    
         $entity=[
            'client' => new Clients(),
            'livraison' => new ShippingClients(), 
            'product' => new Product()]; 
            
            $form = $this->createFormBuilder($entity)
            ->add('client', ClientType::class)
            ->add('livraison', ShippingType::class)
            ->add('product', ProductType::class)
            ->getForm();
            $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
             /* dd($request->request); */ 
            $entityManager->persist($entity['client']);
            $entityManager->flush();

            $entity["livraison"]->setClient($entity['client']);
            $entityManager->persist($entity['livraison']);
            $entityManager->flush();
            
            $order = new Orders();
            /* $formOrder = $this->createForm(OrderType::class, $order); */
            $order->setClient($entity['client']);

            $productId = $request->get('order')["cart"]["cart_products"][0];
            $product = $entityManager->find(Product::class, $productId);
            $order->setProduct($product);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($order);
            $entityManager->flush(); 

            return $this->redirectToRoute('landing_page');
        } 
  
        return $this->render('landing_page/index_new.html.twig', [
            'produits' => $produits,
            'form' => $form->createView(),
            'entity' => [
                'client' => new Clients(),
                'shipping' => new ShippingClients(), 
                'product' => new Product()],
                
        ]);
    }
    /**
     * @Route("/confirmation", name="confirmation")
     */
    public function confirmation()
    {
        return $this->render('landing_page/confirmation.html.twig', [

        ]);
    }
}
