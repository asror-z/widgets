<?php

namespace widgets\inptest;


use zetsoft\system\kernels\ZWidget;


class ZStarratingWidget extends ZWidget
{

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars = array_replace($view->vars, [
            'stars' => $options['stars']
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'attr' => [
                'class' => 'rating',
            ],
            'scale' => 1,
            'stars' => 5,
        ]);
    }

    public function getParent()
    {
        return NumberType::class;
    }

    public function getName()
    {
        return 'rating';
    }
}
