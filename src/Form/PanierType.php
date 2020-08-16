<?php

namespace App\Form;

use App\Entity\Achat;
use App\Entity\Annonces;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PanierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('acheteur')
            ->add('annonce', EntityType::class,['class' =>Annonces::class ,'choice_label'=>'title'])
            ->add('startdate',DateType::class,[
                'widget'=>'single_text'
            ])
            ->add('endDate',DateType::class,[
                'widget'=>'single_text'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Achat::class,
        ]);
    }
}
