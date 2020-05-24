<?php

namespace App\Form;

use App\Entity\FlowerOrder;
use App\Repository\FlowerOrderRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
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
                'required' => true,
                'label' => 'Flower name'
            ])
            ->add('Country', CountryType::class, [
                'constraints' => [
                    new Type('string'),
                    new Length(
                        [
                            'min' => 2,
                            'max' => 50,
                            'minMessage' => 'Must be at least {{ limit }} characters long',
                            'maxMessage' => 'Cannot be longer than {{ limit }} characters',
                            'allowEmptyString' => false
                        ]),
                ],
                'required' => true
            ])
            ->add('City', TextType::class, [
                'constraints' => [
                    new Type('string'),
                    new Length(
                        [
                            'min' => 4,
                            'max' => 50,
                            'minMessage' => 'Must be at least {{ limit }} characters long',
                            'maxMessage' => 'Cannot be longer than {{ limit }} characters',
                            'allowEmptyString' => false
                        ]),
                ],
                'required' => true
            ])
            ->add('street_address', TextType::class, [
                'constraints' => [
                    new Type('string'),
                    new Length(
                        [
                            'min' => 8,
                            'max' => 70,
                            'minMessage' => 'Must be at least {{ limit }} characters long',
                            'maxMessage' => 'Cannot be longer than {{ limit }} characters',
                            'allowEmptyString' => false
                        ]),
                ],
                'required' => true,
                'label' => 'Address exp(Vytauto g. 10-2)'
            ])
            ->add('deliver_on', DateTimeType::class, [
                'required' => true,
                'input' => 'datetime',
                'years' => range(date('Y'), date('Y')+3),
                'constraints' => new GreaterThan('now'),
                'attr' => ['class' => 'form-control form-inline h-100']
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