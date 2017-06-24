<?php

namespace AppBundle\Controller;

use Doctrine\ORM\EntityManager;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * @RouteResource("users")
 */
class UsersController extends FOSRestController
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {

        $this->entityManager = $entityManager;
    }

    /**
     * Get the list of articles.
     *
     *
     * @return array data
     * @Rest\Route("/users")
     * @View()
     */
    public function fetchAllAction()
    {
        return $this->entityManager->getRepository('AppBundle:User')->findAll();
    }

    /**
     * Get the list of articles.
     *
     * @param int $id
     *
     * @return array data
     * @Rest\Get("/users/{id}", requirements={"id" = "\d+"})
     * @View()
     */
    public function fetchAction($id)
    {
        $user = $this->entityManager->getRepository('AppBundle:User')->find($id);
        if (!$user) {
            throw new HttpException(Response::HTTP_NOT_ACCEPTABLE, 'User does not found');
        }
        return $user;
    }
}
