<?php


class LikeC extends BaseC
{

    public function add()
    {
        $this->like->add($_GET['id'], getIp());
    }
}