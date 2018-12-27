<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class UserProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('crop_coords', HiddenType::class, [
                'data' => '0',
                'mapped' => false,
            ])
            ->add('uploadedFile', FileType::class, [
                'mapped' => false,
                'multiple' => false,
                'attr' => [
                    'style' => 'opacity:1',
                    'onchange' => 'previewLoadedFile()'
                ],
                'constraints' => [
                    new File([
                        'mimeTypes' => ['image/jpg', 'image/jpeg', 'image/png'],
                        'maxSize' => '1M',
                    ]),
                ]
            ])
            ->add('aboutMe', TextareaType::class, [
                'mapped' => true,
                'required' => true,
            ])
            ->add('Save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'required' => false,
            'data_class' => User::class,
            'validation_groups' => ['profile']
        ]);
    }
}
