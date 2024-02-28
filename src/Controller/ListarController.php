<?php

namespace App\Controller;

use App\Entity\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListarController extends AbstractController
{
    private array $items;

    public function __construct()
    {
        $this->items = [
            new Item("1", "Artículo 100% real 1", "26/02/2024"),
            new Item("2", "Artículo 100% real 2", "27/02/2024"),
            new Item("3", "Artículo 100% real 3", "28/02/2024"),
        ];
    }

    #[Route('listar/{articuloId}', name: 'articulo', requirements: ['articuloId' => '^\d{1,2}$'])]
    public function listarArticulo(string $articuloId = "2"): Response
    {
        return $this->render('MisVistas/listarArticulos.html.twig', ['items' => $this->items, 'item' => $this->selectItem($articuloId)]);
    }

    private function selectItem(string $itemId): Item
    {
        $foundedItem = null;

        foreach ($this->items as &$item) {
            if ($item->getId() === $itemId) {
                $foundedItem = $item;
            }
        }

        return $foundedItem;

    }


}
