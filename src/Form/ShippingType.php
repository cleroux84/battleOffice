<?php

namespace App\Form;

use App\Entity\ShippingClients;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShippingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom_shipping')
            ->add('nom_shipping')
            ->add('adresse_shipping')
            ->add('adresse_complement_shipping')
            ->add('ville_shipping')
            ->add('code_postal_shipping')
            ->add('pays_shipping')
            ->add('telephone_shipping')
            ->add('client')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ShippingClients::class,
        ]);
    }
}
