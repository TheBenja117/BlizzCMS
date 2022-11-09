<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class armory extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('armory_model');
    }

    public function index($id)
    {
        if (empty($id) || is_null($id) || $id==NULL) redirect(base_url(), 'refresh');
        $data = array(
            'id' => $id,
            'pagetitle' => $this->lang->line('tab_armory_player'),
            'lang' => $this->lang->lang(),
            'realms' => $this->wowrealm->getRealms()->result()
        );
        $this->template->build('index', $data);
    }

    public function search()
    {
        $data = array(
            'pagetitle' => $this->lang->line('tab_armory'),
            'lang' => $this->lang->lang(),
            'realms' => $this->wowrealm->getRealms()->result()
        );
        $this->template->build('search', $data);
    }

    public function result()
    {
        $search = $this->input->get('search');
        $realm = $this->input->get('realm');
        $data = array(
            'pagetitle' => $this->lang->line('tab_armory'),
            'lang' => $this->lang->lang(),
            'search' => $search,
            'realms' => $this->wowrealm->getRealms()->result()
        );
        if (!empty($search) && !empty($realm)) 
        {
            $MultiRealm = $this->wowrealm->getRealmConnectionData($realm);
            $data['chars'] = $this->armory_model->searchChars($MultiRealm, $search);
        }
        $this->template->build('result', $data);
    }
}