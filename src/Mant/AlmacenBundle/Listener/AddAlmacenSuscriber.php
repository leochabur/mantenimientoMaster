<?php
namespace Mant\AlmacenBundle\Listener;
 
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;
use SMTC\MainBundle\Entity\Province;
 
class AddAlmacenSuscriber implements EventSubscriberInterface
{
    private $factory;
 
    public function __construct(FormFactoryInterface $factory)
    {
        $this->factory = $factory;
    }
 
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_BIND     => 'preBind'
        );
    }
 
    private function addCityForm($form, $province)
    {
        $form->add($this->factory->createNamed('city','entity', null, array(
            'class'         => 'MainBundle:City',
            'empty_value'   => 'Ciudad',
            'query_builder' => function (EntityRepository $repository) use ($province) {
                $qb = $repository->createQueryBuilder('city')
                    ->innerJoin('city.province', 'province');
                if ($province instanceof Province) {
                    $qb->where('city.province = :province')
                    ->setParameter('province', $province);
                } elseif (is_numeric($province)) {
                    $qb->where('province.id = :province')
                    ->setParameter('province', $province);
                } else {
                    $qb->where('province.name = :province')
                    ->setParameter('province', null);
                }
 
                return $qb;
            }
        )));
    }
 
    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
 
        if (null === $data) {
            return;
        }
 
        $province = ($data->city) ? $data->city->getProvince() : null ;
        $this->addCityForm($form, $province);
    }
 
    public function preBind(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
 
        if (null === $data) {
            return;
        }
 
        $province = array_key_exists('province', $data) ? $data['province'] : null;
        $this->addCityForm($form, $province);
    }
}