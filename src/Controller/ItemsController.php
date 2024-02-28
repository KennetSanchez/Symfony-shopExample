<?php

namespace App\Controller;

use App\Entity\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/items', name: 'items_')]
class ItemsController extends AbstractController
{

    private array $items;

    public function __construct()
    {
        $this->items = [
            new Item("art1","Artículo 100% real 1", "26/02/2024"),
            new Item("art2","Artículo 100% real 2", "27/02/2024"),
            new Item("art3","Artículo 100% real 3", "28/02/2024"),
        ];
    }

    #[Route('', name: 'all')]
    public function showAll(): Response
    {
        return $this->render('items/items.html.twig', ['items' => $this->items]);
    }

    #[Route('/{itemId}', name: 'item')]
    public function showItem(string $itemId): Response
    {
        return $this->render('items/item.html.twig', ['itemId' => $itemId]);
    }
}
