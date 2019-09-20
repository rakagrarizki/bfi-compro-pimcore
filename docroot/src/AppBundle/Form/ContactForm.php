<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactForm extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('name', TextType::class, [
                'label'       => 'Name',
                'required'    => true,

            ])
            ->add('handphone', TextType::class, [
                'label'    => 'Handphone',
                'required' => true,

            ])
            ->add('email', EmailType::class, [
                'label'    => 'E-Mail ',
                'required' => true,

            ])
            ->add('phone2', TextType::class, [
                'label'       => 'Phone Number',

            ])

            ->add('trxType', ChoiceType::class, [
                'placeholder' => "Transaction Type",
                'required' => true,
                'choices'  => [

                    'Informasi Produk' => "informasi-produk",
                    'Layanan Purna Jual' => "layanan-purna-jual",
                    'Keluhan' => "keluhan",
                    "Registrasi E-Biling" => "registrasi"
                ],

            ])
            ->add('comment', TextareaType::class, [
                'label'    => 'Description',

            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit'
            ]);
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
    }
}
