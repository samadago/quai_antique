<?php

namespace App\Controller\Admin;

use App\Entity\Plat;
use App\Entity\Category;
use App\Entity\Reservation;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AdminCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reservation::class;
    }


    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),

            MenuItem::section('Reservations'),
            MenuItem::linkToCrud('Reservations', 'fa fa-tags', Reservation::class),

            MenuItem::section('Menu'),
            MenuItem::linkToCrud('Plats', 'fa fa-comment', Plat::class),
            MenuItem::linkToCrud('Categories', 'fa fa-user', Category::class),
        ];
    }
}
