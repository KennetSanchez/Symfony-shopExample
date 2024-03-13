<?php

namespace App\Controller;

use App\Entity\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('articulo/', name: 'articulo_')]
class ArticuloController extends AbstractController
{
    private string $imageName = "";
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

    #[Route('{idArticulo}', name: 'articulo')]
    public function showItem(string $idArticulo): Response
    {
        $itemToShow = $this->selectItemProvisional($idArticulo);
        return $this->render('articulo/mostrar_articulo.html.twig', ['articulo' => $itemToShow]);
    }

    private function selectItemProvisional(string $itemId) : Item{

        $foundedItem = null;

        foreach ($this->items as $item) {
            if( $item->getId() === $itemId ){
                $foundedItem = $item;
            }
        }

        return $foundedItem;
    }
}
