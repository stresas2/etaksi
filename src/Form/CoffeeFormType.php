<?php

namespace App\Form;

use App\Entity\CoffeOrder;
use App\Repository\CoffeOrderRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;

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
                'label' => 'Coffee Type',
                'required' => true
            ])
            ->add('CupSize', ChoiceType::class, [
                'choices' => [
                    '100 ml' => CoffeOrderRepository::OneHundred,
                    '200 ml' => CoffeOrderRepository::TwoHundred,
                    '300 ml' => CoffeOrderRepository::ThreeHundred,
                ],
                'constraints' => new Type('integer'),
                'required' => true
            ])
            ->add('Location', TextType::class, [
                'constraints' => [
                    new Type('string'),
                    new Length(
                        [
                            'min' => 8,
                            'max' => 20,
                            'minMessage' => 'Must be at least {{ limit }} characters long',
                            'maxMessage' => 'Cannot be longer than {{ limit }} characters',
                            'allowEmptyString' => false
                        ]),
                    new Regex("/^([-+]?)([\d]{1,2})(((\.)(\d+)(,)))(\s*)(([-+]?)([\d]{1,3})((\.)(\d+))?)$/")
                ],
                'attr' => [
                    'placeholder' => '54.63827, 23.94515',
                ],
                'label' => 'Coordinates, exp(54.63827, 23.94515)',
                'required' => true
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Order',
            ]);

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $data = $event->getData();
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