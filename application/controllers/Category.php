<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
    public function index($cid = null, $sid = null, $sort = null, $limit = null)
    {
        // Fallbacks from query string
        $cid   = $cid   ?? $this->input->get('cid');
        $sid   = $sid   ?? $this->input->get('sid');
        $raw   = $sort ?? $this->input->get('sort'); // third argument may be sort or limit
        $limit = $limit ?? $this->input->get('limit') ?? 100;

        // Determine if $raw is numeric or string
        if ($raw !== null) {
            $raw = trim($raw);
            $validSorts = ['A-Z', 'Z-A', 'low', 'high'];
            if (in_array($raw, $validSorts)) {
                $sort = $raw;
                $limit = $limit ?? 100;
            } elseif (ctype_digit($raw)) {
                $limit = (int) $raw;
                $sort = $sort ?? null;
            } else {
                $sort = null;
                $limit = 100;
            }
        }


        // Prepare data
        $data['category_name']       = $cid ? $this->Category_model->get_name($cid) : null;
        $data['subcategory_name']    = $sid ? $this->Category_model->get_sub_name($sid) : null;
        $data['categories']          = $this->Category_model->get_all_with_subcategories();
        $data['products']            = $this->Product_model->get_filtered_products($cid, $sid, $sort, $limit);
        $data['activeCategoryId']    = (int) $cid;
        $data['activeSubCategoryId'] = (int) $sid;
        $data['sort']                = $sort;
        $data['limit']               = $limit;
        $data['flash']               = $this->session->flashdata('flash');

        // Load views
        $this->load->view('header', $data);
        $this->load->view('category', $data);
        $this->load->view('footer');
    }
}
