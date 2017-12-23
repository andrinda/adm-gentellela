<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_menus extends CI_Model {

	public function get_list_menus($role, $level = null, $parent = null)
	{
		$this->db->select('m.*')
        			->from('menus as m')
        			->join('user_privileges as up','m.id = up.menu_id')
        			->where('up.role_id', $role)
        			->where('up.priv_read', 1)
        			->where('m.is_published', 1)
        			->order_by('m.menu_order', 'ASC');

        if($level !== null)
            $this->db->where('m.level', $level);

        if($parent !== null)
            $this->db->where('m.parent', $parent);
        
        $query = $this->db->get();

        if($query->num_rows() > 0)
            $result = $query->result_array();
        else
            $result = array();

        return $result;
	}
	

}

/* End of file Model_menus.php */
/* Location: ./application/models/Model_menus.php */