<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 22/01/15
 * Time: 21:42
 */


namespace AppBundle\Form;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class UserToIdTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * Transforms an object (User) to a string (number).
     *
     * @param  User|null $user
     * @return string
     */
    public function transform($user)
    {
        if (null === $user) {
            return "";
        }

        //return $user;
        return $user->getId();
    }

    /**
     * Transforms a string (id) to an object (user).
     *
     * @param  string $id
     *
     * @return User|null
     *
     * @throws TransformationFailedException if object (user) is not found.
     */
    public function reverseTransform($id)
    {
        if (!$id) {
            return null;
        }

        $user = $this->om
            ->getRepository('AppBundle:User')
            ->findOneBy(array('id' => $id))
        ;

        if (null === $user) {
            throw new TransformationFailedException(sprintf(
                'An user with id "%s" does not exist!',
                $id
            ));
        }

        return $user;
    }
}