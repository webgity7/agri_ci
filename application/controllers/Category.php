<?php
class Category extends CI_Controller
{
    public function index()
    {
 

        $cid = $this->input->get('cid');
        $sid = $this->input->get('sid');
        $sort = $this->input->get('sort');
        $limit = $this->input->get('limit') ?? 100;

        $data['category_name'] = $cid ? $this->Category_model->get_name($cid) : null;
        $data['subcategory_name'] = $sid ? $this->Category_model->get_sub_name($sid) : null;
        $data['categories'] = $this->Category_model->get_all_with_subcategories();
        $data['products'] = $this->Product_model->get_filtered_products($cid, $sid, $sort, $limit);
        $data['activeCategoryId'] = (int)$cid;
        $data['activeSubCategoryId'] = (int)$sid;
        $data['sort'] = $sort;
        $data['limit'] = $limit;
        $data['flash'] = $this->session->flashdata('flash');

        $this->load->view('header', $data);
        $this->load->view('category', $data);
        $this->load->view('footer');
    }
    

}
