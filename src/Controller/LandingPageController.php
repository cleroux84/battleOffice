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
use Symfony\Component\HttpClient\HttpClient;



class LandingPageController extends AbstractController
{
    public function apiOrder(Orders $order)
    {
  
        $orderArray = 
        [
        'order'=>
        [
            'id' => $order->getId(),
            'product' => $order->getProduct()->getName(),
            'payment_method'=> "stripe",
            'status' => 'WAITING',
            'client' => 
            [
                'firstname' => $order->getClient()->getPrenom(),
                'lastname' => $order->getClient()->getNom(),
                'email'=> $order->getClient()->getEmail()
            ],
            'addresses'=> 
            [
                'billing' => 
                [
                    'address_line1' => $order->getClient()->getAdresse(),
                    "address_line2"=> $order->getClient()->getAdresseComplement(),
                    "city"=> $order->getClient()->getVille(),
                    "zipcode"=> $order->getClient()->getCodePostal(),
                    "country"=> $order->getClient()->getPays(),
                    "phone"=> $order->getClient()->getTelephone()
                ],
                'shipping'=>
                [
                    "address_line1"=> '1, rue du test',
                    "address_line2"=> "3ème étage",
                    "city"=> "Lyon",
                    "zipcode"=> "69000",
                    "country"=> "France",
                    "phone"=> "string"
                ]
            ] 
        ]   
        ];
 

        $client = HttpClient::create();
        $response = $client->request('POST', 'https://api-commerce.simplon-roanne.com/order', [
            'headers' => [
                'Accept' => 'application/json', //format de ce qu'on envoit
                'Content-Type'=> 'application/json', //format retour de la reponse
                'Authorization' => 'Bearer mJxTXVXMfRzLg6ZdhUhM4F6Eutcm1ZiPk4fNmvBMxyNR4ciRsc8v0hOmlzA0vTaX'
            ],
            'body' => json_encode($orderArray)
        ]);
        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]
        /* dd($content); */

    } 

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
            $order->setClient($entity['client']);

            $productId = $request->get('order')["cart"]["cart_products"][0];
            $product = $entityManager->find(Product::class, $productId);
            $order->setProduct($product);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($order);
            $entityManager->flush(); 

            //Envoi vers l'api :
            $this->apiOrder($order);
            
            return $this->redirectToRoute('payment');
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
