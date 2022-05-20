<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
	
	public $data=array();
	public $statusCode=200;

	public function __construct(){
		parent::__construct();		
		$this->load->model(array('products_model','common_model'));		
	}

	public function c($slug='no_slug'){

		//Pagination
		$config["base_url"] = base_url().'index.php/products/c/'.$slug.'/';
		$config["total_rows"] = $this->products_model->record_count($slug);
		$config["per_page"] = 20;
		$config["uri_segment"] = 4;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$this->data["products"] = $this->products_model->getData_products($config["per_page"], $page, $slug);
		$this->data["links"] = $this->pagination->create_links();
		//End Pagination
		
		$this->data["slug"] = $slug;
		$this->data["meta_title"] = $this->data["products"][0]->meta_title;
		$this->data["meta_description"] = $this->data["products"][0]->meta_description;
		$this->data["meta_keywords"] = $this->data["products"][0]->meta_keywords;
		
		$this->load->template('products/list', $this->data);
	}

	public function details($slug='no_slug'){
		$product_id = $this->products_model->get_ProductID_bySlug($slug);
		$this->data["product_details"] = $this->products_model->getData_productDetails($slug);
		$this->data["product_images"] = $this->products_model->getData_productImages($slug);
		$this->data['result_product_option_groups'] = $this->products_model->getData_product_options_groups($product_id);
		$this->data['result_product_options'] = $this->products_model->getData_product_options($product_id);
		$this->data['stock_status'] = $this->products_model->get_stock_status($product_id);
		$this->data['other_products'] = $this->products_model->getData_Other_products($slug, $this->data["product_details"][0]->category_id);
		
		$this->data["meta_title"] = $this->data["product_details"][0]->meta_title;
		$this->data["meta_description"] = $this->data["product_details"][0]->meta_description;
		$this->data["meta_keywords"] = $this->data["product_details"][0]->meta_keywords;
		
		$this->load->template('products/details', $this->data);
	}

	public function search(){
		$search_keyword = $this->security->xss_clean($this->input->get('q'));
		$this->data["search_keyword"] = $search_keyword;
		$this->data["products"] = $this->products_model->getData_products_BySearch($search_keyword);
		$this->load->template('products/search', $this->data);
	}

	public function set_sort_option(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('sort_option','Sort Option','trim|required|xss_clean');

		if($this->form_validation->run()==FALSE){
			$this->statusCode=400;

			$form_error_array = array(
				'sort_option'=>form_error('sort_option','<span>','</span>')
			);

			$response_array['error_type'] = 'form';
			$response_array['errors'] = $form_error_array;
			$response_array['message'] = 'Invalid Inputs';
			$response=array('error'=>$response_array);

		}else{			
			$response=$this->products_model->set_sort_option_method();
			if(array_key_exists('error', $response)){
				$this->statusCode=400;
			}			
		}

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));

	}
}
