<?php

namespace App\Form;

use App\Entity\CoffeOrder;
use App\Repository\CoffeOrderRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\VarDumper\VarDumper;

class CoffeeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Milk', ChoiceType::class, [
                'choices' => [
                    'Yes' => CoffeOrderRepository::WithMilk,
                    'No' => CoffeOrderRepository::WithoutMilk,
                ],
                'constraints' => new Type('integer'),
                'required' => true
            ])
            ->add('MilkType', ChoiceType::class, [
                'choices' => [
                    'Cappuccino' => CoffeOrderRepository::Cappuccino,
                    'Latte' => CoffeOrderRepository::Latte,
                    'Macchiato' => CoffeOrderRepository::Macchiato,
                ],
                'constraints' => new Type('integer'),
                'required' => true
            ])
            ->add('CupSize', ChoiceType::class, [
                'choices' => [
                    '100 ml' => 0,
                    '200 ml' => 1,
                    '300 ml' => 2,
                ],
                'constraints' => new Type('integer'),
                'required' => true
            ])
            ->add('Location', TextType::class, [
                'constraints' => [
                    new Type('string'),
                    new Length(1)
                ],
                'required' => true
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Save',
            ]);

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $data = $event->getData();
//            $data['CreatedAt'] = new \DateTime('now');
            if ($data['Milk'] === strval(CoffeOrderRepository::WithoutMilk)) {
                $data['MilkType'] = null;
            };

            $event->setData($data);

        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CoffeOrder::class,
        ]);
    }
}