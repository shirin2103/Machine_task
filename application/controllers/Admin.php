<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
        parent::__construct(); 
        header('Access-Control-Allow-Origin: *');
    }
	
	public function index(){
		$this->load->view('Admin/page');
	}	
	public function add_new_product(){
			$this->form_validation->set_rules('a_product_name', 'Product Name', 'trim|required|alpha',
				array(
					'required' => '%s is required',
				)
			);
			$this->form_validation->set_rules('a_product_price', 'Product Price', 'trim|required',
				array(
					'required' => '%s is required',
				)
			);			
			$this->form_validation->set_rules('a_product_description', 'Product Description', 'trim|required',
				array(
					'required' => '%s is required',
				)
			);	
			if ($this->form_validation->run() == FALSE) {
				$response['status'] = 'failure';
				$response['error'] = array(
					'a_product_name' => strip_tags(form_error('a_product_name')),			
					'a_product_price' => strip_tags(form_error('a_product_price')),			
					'a_product_description' => strip_tags(form_error('a_product_description'))			
				);
			} else {
				$this->load->library('upload');
			    $dataInfo = array();
			    $files = $_FILES;
				$is_file=true;
			    $cpt = count($_FILES['images']['name']);
			    for($i=0; $i<$cpt; $i++){ 
			        $_FILES['images']['name'] = $files['images']['name'][$i];
			        $_FILES['images']['type']= $files['images']['type'][$i];
			        $_FILES['images']['tmp_name']= $files['images']['tmp_name'][$i];
			        $_FILES['images']['error']= $files['images']['error'][$i];
			        $_FILES['images']['size']= $files['images']['size'][$i];
			        $this->upload->initialize($this->set_upload_options($files['images']['name'][$i]));
			        if (!$this->upload->do_upload('images')){
			        	$is_file = false;					
	                    $response['status'] = 'failure_img';
	                    $response['message'] = $this->upload->display_errors();					
	                } else {
	                	$image_info = $this->upload->data();
	                	$dataInfo[] = base_url().'uploads/products/'.$image_info['file_name'];
	                }
			    }
				if($is_file){

					$product_name = $this->input->post('a_product_name');

					$product_price = $this->input->post('a_product_price');
					
					$product_desccription = $this->input->post('a_product_description');


					$check_problems_count = $this->model->CountWhereRecord('tbl_product', array('product_name'=>$product_name,'del_status'=>'1'));
	                if ($check_problems_count > 0) {
	                     $response['status'] = 'failure';
                    	 $response['error'] = array(
                        		'a_product_name'=>"Product Already exist",
                    	);
	                    
	                } else {
						$insert_data = array(
							'product_name'=>$product_name,
							'product_price'=>$product_price,
							'product_desccription'=>$product_desccription,
							'product_image'=>implode(",", $dataInfo),
							
						);
						$this->model->insertData('tbl_product',$insert_data);
						$response['status']='success';
					}
				}
			}
		echo json_encode($response);
	}

	public function display_product_datatable()
	{
		$this->load->model('admin_product_model');
        $all_product_info = $this->admin_product_model->get_datatables();              
       	$count = $this->admin_product_model->count_all();
        $count_filtered = $this->admin_product_model->count_filtered();
		$data = array();
		$no = @$_POST['start'];
		foreach ($all_product_info as $all_product_info_key => $all_product_info_row) {
			$no++;
			$row = array();
			$row[] = $no;	
			$row[] = $all_product_info_row['product_name'];
			$row[] = $all_product_info_row['product_price'];
			$row[] = $all_product_info_row['product_desccription'];
			$row[] = '<span> <a href="javascript:void(0);" data-toggle="tooltip" title="View Details">
			<i class="fa fa-eye m-l-10 a_product_view" aria-hidden="true" data-toggle="modal" 
			data-target="#a_product_view_modal" id="'.$all_product_info_row['id'].'"></i> </a> <a href="javascript:void(0);" data-toggle="tooltip" title="Edit Details"><i class="fa fa-pencil m-l-10 a_product_edit" aria-hidden="true" data-toggle="modal" data-target="#a_product_edit_modal" id="'.$all_product_info_row['id'].'"></i> </a><a href="javascript:void(0);" data-toggle="tooltip" title="Delete Details"><i class="fa fa-trash m-l-10 a_product_delete" id="'.$all_product_info_row['id'].'"></i> </a> </span>';
			$data[] = $row;
		}
		$output = array("draw" => @$_POST['draw'], "recordsTotal" => $count, "recordsFiltered" => $count_filtered, "data" => $data);
		echo json_encode($output);
	}

	public function get_product_edit_info()
	{
			$product_id = $this->input->post('id');
			$product_info = $this->users_model->get_product_edit_info($product_id);
			$response['status']='success';
			$response['product_info']=$product_info;
		
			echo json_encode($response);
	}

	function update_product(){
		$is_file = true;
			$this->form_validation->set_rules('a_edit_product_name', 'Product Name', 'trim|required',
				array(
					'required' => '%s is required',
				)
			);
			$this->form_validation->set_rules('a_edit_product_price', 'Product Price', 'trim|required',
				array(
					'required' => '%s is required',
				)
			);
			$this->form_validation->set_rules('a_edit_product_description', 'Product Description', 'trim|required',
				array(
					'required' => '%s is required',
				)
			);
			if ($this->form_validation->run() == FALSE) {
				$response['status'] = 'failure';
				$response['error'] = array(
					'a_edit_product_name' => strip_tags(form_error('a_edit_product_name')),			
					'a_edit_product_price' => strip_tags(form_error('a_edit_product_price')),			
					'a_edit_product_description' => strip_tags(form_error('a_edit_product_description'))			
				);
			} else {
				$this->load->library('upload');
				$dataInfo = array();
				if(!empty($_FILES['a_edit_product_image']['name'][0])){
					$_FILES['a_edit_product_image']['name'] = array_values(array_filter($_FILES['a_edit_product_image']['name']));
					$files = $_FILES;
					$cpt = count($_FILES['a_edit_product_image']['name']);
					for($i=0; $i<$cpt; $i++){ 
						$_FILES['a_edit_product_image']['name'] = $files['a_edit_product_image']['name'][$i];
						$_FILES['a_edit_product_image']['type']= $files['a_edit_product_image']['type'][$i];
						$_FILES['a_edit_product_image']['tmp_name']= $files['a_edit_product_image']['tmp_name'][$i];
						$_FILES['a_edit_product_image']['error']= $files['a_edit_product_image']['error'][$i];
						$_FILES['a_edit_product_image']['size']= $files['a_edit_product_image']['size'][$i];
						$this->upload->initialize($this->set_upload_options($files['a_edit_product_image']['name'][$i]));
						if (!$this->upload->do_upload('a_edit_product_image')){
							$is_file = false;
							$response['status'] = 'failure';
							$response['message'] = $this->upload->display_errors();
						} else {
							$image_info = $this->upload->data();
							$dataInfo[] = base_url().'uploads/products/'.$image_info['file_name'];
							
						}
					}
				}
				if($is_file){
					$product_id = $this->input->post('a_edit_product_id');
					$product_name = $this->input->post('a_edit_product_name');
					$price = $this->input->post('a_edit_product_price');
					$description = $this->input->post('a_edit_product_description');
					$old_image = $this->input->post('old_image');
					$product_images =implode(",", $dataInfo);
					$update_data = array(
						'product_name'=>$product_name,
						'product_price'=>$price,
						'product_desccription'=>$description,
						'product_image'=>$product_images.",".$old_image,

					);
				// echo "<pre>";print_r($update_data);die;
					$this->model->updateData('tbl_product',$update_data,array('id'=>$product_id));
					$response['status']='success';
				}
			}
		echo json_encode($response);
	}

	public function delete_product()
	{
			$delete_id = $this->input->post('id');
			$update_array = array(
                'del_status' => '0',
            );
            $this->model->updateData('tbl_product',$update_array,array('id'=>$delete_id));
			$response['status']='success';
		echo json_encode($response);
	}
	private function set_upload_options($provided_file_name=''){   
	    //upload an image options
	    $config = array();
	    if(!empty($provided_file_name)){
	    	$extension = pathinfo($provided_file_name, PATHINFO_EXTENSION);
	    	$unique_no = uniqid();
	    	$filename = $unique_no.'.'.$extension;
	    	$config['file_name'] = $filename;
	    }
	    $config['upload_path'] = './uploads/products/';
	    $config['allowed_types'] = get_allowed_file_type();
	    $config['max_size']      = '0';
	    $config['overwrite']     = TRUE;
	    return $config;
	}
}