<?php


class PageC extends BaseC
{
    public function index()
    {
        $starInfo = $this->page->getStar();
        $starBdayInfo = $this->page->getBdayInfo($starInfo['id']);
        $photoInfo = $this->page->getPhoto(getIp());
        $template = $this->twig->loadTemplate('mainContent.twig');
        $this->content = $template->render(['starInfo' => $starInfo, 'starBdayInfo' => $starBdayInfo , 'photoInfo' => $photoInfo]);
    }
}
