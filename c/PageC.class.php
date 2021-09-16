<?php


class PageC extends BaseC
{
    public function index()
    {
//        $popularGoods = $this->page->catalog('order_count', 'DESC', 20, true, true); //массив популярных товаров
//        $newGoods = $this->page->catalog('id', 'DESC', 12, true, true); //массив новых товаров
        $starInfo = $this->page->getStar();
        $starBdayInfo = $this->page->getBdayInfo($starInfo['id']);
        $photoInfo = $this->page->getPhoto();
        $template = $this->twig->loadTemplate('mainContent.twig');
//        $this->content = $template->render(['popularGoods' => $popularGoods, 'newGoods' => $newGoods]);
        $this->content = $template->render(['starInfo' => $starInfo, 'starBdayInfo' => $starBdayInfo , 'photoInfo' => $photoInfo]);
    }
}
