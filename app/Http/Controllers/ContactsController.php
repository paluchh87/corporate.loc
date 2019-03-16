<?php

namespace Corp\Http\Controllers;

use Corp\Services\ContactServices;

class ContactsController extends SiteController
{
    public function __construct(ContactServices $contactServices)
    {
        parent::__construct();

        $this->service = $contactServices;
        $this->bar = 'left';
        $this->template = config('settings.theme') . '.contacts';
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index()
    {
        $this->title = 'Контакты';
        $this->contentLeftBar = view(config('settings.theme') . '.contact_bar')->render();

        return $this->renderOutput();
    }
}
