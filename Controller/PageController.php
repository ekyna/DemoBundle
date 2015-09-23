<?php

namespace Ekyna\Bundle\DemoBundle\Controller;

use Ekyna\Bundle\CoreBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PageController
 * @package Ekyna\Bundle\DemoBundle\Controller
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class PageController extends Controller
{
    /**
     * Home action.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homeAction()
    {
        return $this->configureSharedCache(
            $this->render('EkynaDemoBundle:Page:home.html.twig')
        );
    }

    /**
     * Default action.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function defaultAction()
    {
        return $this->configureSharedCache(
            $this->render('EkynaDemoBundle:Page:default.html.twig')
        );
    }

    /**
     * Contact action.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactAction(Request $request)
    {
        $form =
            $this->createFormBuilder()
            ->add('email', 'email', [
                'label' => 'Votre adresse email',
            ])
            ->add('subject', 'text', [
                'label' => 'Sujet de votre demande',
            ])
            ->add('message', 'textarea', [
                'label' => 'Votre message'
            ])
            ->add('actions', 'form_actions', [
                'buttons' => [
                    'send' => [
                        'type' => 'submit', 'options' => [
                            'button_class' => 'primary',
                            'label' => 'ekyna_core.button.send',
                        ],
                    ],
                ]
            ])
            ->getForm()
        ;

        $form->handleRequest($request);
        if ($form->isValid()) {
            $settings = $this->container->get('ekyna_setting.manager');
            $fromEmail = $settings->getParameter('notification.from_email');
            $fromName = $settings->getParameter('notification.from_name');
            $toEmails = $settings->getParameter('notification.to_emails');

            /** @var \Swift_Mime_Message $message */
            $message = \Swift_Message::newInstance()
                ->setSubject($form->get('subject')->getData())
                ->setFrom($fromEmail, $fromName)
                ->setTo($toEmails)
                ->setBody($this->get('twig')->render(
                    'EkynaDemoBundle:Email:contact.html.twig', [
                        'from' => $form->get('email')->getData(),
                        'subject' => $form->get('subject')->getData(),
                        'message' => $form->get('message')->getData(),
                    ]
                ), 'text/html')
            ;
            if ($this->get('mailer')->send($message)) {
                $this->addFlash(
                    'Votre message a bien été envoyé. Nous vous répondrons dans les plus brefs délais.',
                    'success'
                );
                return $this->redirect($this->generateUrl('contact'));
            } else {
                $this->addFlash(
                    'Une error s\'est produite lors de l\'envoi de votre message. Veuillez réessayer utlérieurement.',
                    'error'
                );
            }
        }

        $response = $this->render('EkynaDemoBundle:Page:contact.html.twig', [
            'form' => $form->createView()
        ]);

        if ('GET' !== $request->getMethod()) {
            return $response->setPrivate();
        }

        return $this->configureSharedCache($response);
    }
}
