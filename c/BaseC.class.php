<?php


abstract class BaseC extends Controller
{
    /**
     * @var Twig_Environment $twig Модель шаблонизатора Twig
     * @var PageM $page Модель страницы
     * @var string $title Заголовок страницы
     * @var string $content Содержание страницы
     * @var string $message вывод сообщения на страницу
     */
    protected $title;
    protected $loader;
    protected $twig;
    protected $content;
    protected $message;
    protected $page;

    public function before()
    {
        $this->title = 'TEST';
        $this->loader = new Twig_Loader_Filesystem('v');
        $this->twig = new Twig_Environment($this->loader);
        $this->content = '';
        $this->message = '';
        $this->page = new PageM(); // создается экземпляр модели страницы
    }

    public function render()
    {
        $template = $this->twig->loadTemplate('main.twig');
        echo $template->render([
            'title' => $this->title,
            'content' => $this->content,
        ]);
    }
}
