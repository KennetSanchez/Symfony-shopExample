<?php

namespace App\Controller;

use App\Entity\Item;
use Random\RandomException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListarController extends AbstractController
{
    private array $items;

    public function __construct()
    {
        $this->items = [
            new Item("art1", "Artículo 100% real 1", "26/02/2024"),
            new Item("art2", "Artículo 100% real 2", "27/02/2024"),
            new Item("art3", "Artículo 100% real 3", "28/02/2024"),
        ];
    }

    #[Route('listar/{articuloId}', name: 'articulo', requirements: ['articuloId' => '^\d{1,2}$'])]
    public function listarArticulo(string $articuloId = "art2"): Response
    {
        $articulo = $this->selectItem($articuloId);

        if ($articuloId === "art1") {
            return $this->redirectToRoute('articulo_articulo',
                [
                    'articuloId' => $articulo->getId(),
                    'articuloTitle' => $articulo->getTitle(),
                    'articuloCreated' => $articulo->getCreated()
                ]);

//            if( random_int(0, 100) % 2 === 0 ){
//                return $this->redirectToRoute('articulo_articulo', array('articulo' => $articulo));
//            }
//            // Not recommended. Looks like there's no similar to the forward from previous versions.
//                return $this->redirect($this->generateUrl('articulo_articulo', array('articulo' => $articulo)));
        }

        return $this->render('MisVistas/listarArticulos.html.twig', ['items' => $this->items]);
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
