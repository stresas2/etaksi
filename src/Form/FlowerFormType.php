<?php

namespace App\Form;

use App\Entity\CoffeOrder;
use App\Entity\FlowerOrder;
use App\Repository\CoffeOrderRepository;
use App\Repository\FlowerOrderRepository;
use PhpParser\Node\Expr\BinaryOp\Greater;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\LocaleType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;

class FlowerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name', ChoiceType::class, [
                'choices' => [
                    'Rose' => FlowerOrderRepository::Rose,
                    'Tulip' => FlowerOrderRepository::Tulip,
                    'Lily' => FlowerOrderRepository::Lily,
                    'Bluebell' => FlowerOrderRepository::Bluebell,
                ],
                'constraints' => new Type('integer'),
                'required' => true
            ])
            ->add('Country', LocaleType::class, [
                'constraints' => new Type('string'),
                'required' => true
            ])
            ->add('City', TextType::class, [
                'constraints' => new Type('string'),
                'required' => true
            ])
            ->add('street_address', TextType::class, [
                'constraints' => new Type('string'),
                'required' => true
            ])
            ->add('deliver_on', DateTimeType::class, [
                'required' => true,
                'input' => 'datetime',
                'years' => range(date('Y'), date('Y')+3),
                'constraints' => new GreaterThan('now'),
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Order',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FlowerOrder::class,
        ]);
    }
}