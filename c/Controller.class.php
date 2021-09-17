<?php


abstract class Controller
{
    protected abstract function before();
    protected abstract function render();

    public function request($method)
    {
        $this->before();
        $this->$method();
        $this->render();
    }
}