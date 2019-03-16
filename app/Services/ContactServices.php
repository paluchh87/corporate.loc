<?php

namespace Corp\Services;

class ContactServices extends Services
{
    public function __construct()
    {
        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));
    }
}
