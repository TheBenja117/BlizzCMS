<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->auth = $this->load->database('auth', TRUE);
    }

    public function getShopTop10()
    {
        return $this->db->select('id_store')
                ->order_by('id', "DESC")
                ->limit('10')
                ->get('store_top'); 
    }

    public function getShopTop()
    {
        return $this->db->select('*')
                ->order_by('id', 'ASC')
                ->get('store_top');
    }

    public function getExistItem($id)
    {
        return $this->db->select('*')
                ->where('id', $id)
                ->get('store')
                ->num_rows();
    }

    public function getType($id)
    {
        return $this->db->select('type')
                ->where('id', $id)
                ->get('store')
                ->row('type');
    }

    public function getItem($id)
    {
        return $this->db->select('itemid')
                ->where('id', $id)
                ->get('store')
                ->row('itemid');
    }

    public function getQuery($id)
    {
        return $this->db->select('qquery')
                ->where('id', $id)
                ->get('store')
                ->row('qquery');
    }

    public function getIcon($id)
    {
        return $this->db->select('iconname')
                ->where('id', $id)
                ->get('store')
                ->row('iconname');
    }

    public function getName($id)
    {
        return $this->db->select('name')
                ->where('id', $id)
                ->get('store')
                ->row_array()['name'];
    }

    public function getImage($id)
    {
        return $this->db->select('image')
                ->where('id', $id)
                ->get('store')
                ->row_array()['image'];
    }

    public function getGroup($id)
    {
        return $this->db->select('groups')
                ->where('id', $id)
                ->get('store')
                ->row('groups');
    }

    public function getPriceType($id, $type)
    {
        if ($type == "dp")
            return $this->db->select('price_dp')
                    ->where('id', $id)
                    ->get('store')
                    ->row('price_dp');

        if ($type == "vp")
            return $this->db->select('price_vp')
                    ->where('id', $id)
                    ->get('store')
                    ->row('price_vp');
    }

    public function getVPTrue($id)
    {
        $qq = $this->db->select('price_vp')
                    ->where('id', $id)
                    ->get('store')
                    ->row('price_vp');

        if (!is_null($qq) && $qq > 0)
            return true;
        else
            redirect(base_url('store'),'refresh');
    }

    public function getDPTrue($id)
    {
        $qq = $this->db->select('price_dp')
                    ->where('id', $id)
                    ->get('store')
                    ->row('price_dp');

        if (!is_null($qq) && $qq > 0)
            return true;
        else
            redirect(base_url('store'),'refresh');
    }

    public function getShopGeneral($id)
    {
        if($id != '' && $id != '0') {
            return $this->db->select('*')
                ->where('groups', $id)
                ->get('store');
        } else {
            return $this->db->select('*')
                ->get('store');
        }
    }

    public function getShopGeneralGP($id)
    {
        return $this->db->select('*')
                ->where('groups', $id)
                ->get('store');
    }

    public function getGroups()
    {
        return $this->db->select('*')
                ->get('store_groups');
    }

    public function getSpecifyGroup($id)
    {
        return $this->db->select('name')
                ->where('id', $id)
                ->get('store_groups')
                ->row_array()['name'];
    }

    public function insertHistory($idstore, $itemid, $accountid, $charid, $method, $price, $soapUser, $soapPass, $soapHost, $soapPort, $soap_uri, $multirealm)
    {
        $date = $this->m_data->getTimestamp();

        $multirealm = $this->m_data->getRealmConnectionData($multirealm);
        $getCharName = $this->m_characters->getNameCharacterSpecifyGuid($multirealm, $charid);
        
        $subject = $this->lang->line('store_senditem_subject');
        $message = $this->lang->line('store_senditem_text');

        $this->m_soap->commandSoap('.send items '.$getCharName.' "'.$subject.'" "'.$message.'" '.$itemid, $soapUser, $soapPass, $soapHost, $soapPort, $soap_uri);

        $data = array(
            'idstore' => $idstore,
            'itemid' => $itemid,
            'date' => $date,
            'accountid' => $accountid,
            'charid' => $charid,
            'method' => $method,
            );

        $this->db->insert('store_history', $data);

        if ($method == "dp")
            $this->db->query("UPDATE credits SET dp = (dp-$price) WHERE accountid = $accountid");
        else
            $this->auth->query("UPDATE account SET game_point = (game_point-$price) WHERE id = $accountid");

        redirect(base_url('store?complete'),'refresh');
    }
}
