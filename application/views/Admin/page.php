<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Assignment</title>
      <?php include 'common/admin_cssfiles.php';?>
   </head>
   <body>
      <br>
      <div id="header_loader"></div>
      <div class="container">
         <h2>Assignment</h2>
         <br>
         <!-- Nav tabs -->
         <!-- Tab panes -->
         <div class="tab-content">
           
            <div >
               <br>
               <h3>Add Product</h3>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <?php echo form_open('admin/add_new_product', array('id' => 'a_add_new_product_form')) ?>
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-4">
                                 <div class="form-group required">
                                    <label
                                       class="form-control-label">Product Name</label>
                                    <input type="text" class="form-control" placeholder="Product Name" name="a_product_name">
                                    <span class="error_msg" id="a_product_name_error"></span>
                                 </div>
                              </div>
                               <div class="col-md-4">
                                 <div class="form-group required">
                                    <label
                                       class="form-control-label">Product Price</label>
                                    <input type="text" class="form-control" placeholder="Product Price" name="a_product_price">
                                    <span class="error_msg" id="a_product_price_error"></span>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group required">
                                    <label
                                       class="form-control-label">Product Description</label>
                                    <textarea class="form-control" name="a_product_description"></textarea>
                                    <span class="error_msg" id="a_product_description_error"></span>
                                  
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group ">
                                    <label class="form-control-label"><?=$this->lang->line('product_image');?></label>
                                    <input class="form-control" type="file" name="images[]" id="images" multiple="multiple" >
                                    <span class="error_msg" id="images_error"></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="card-header text-right">
                           <button class="btn btn-primary" id="hlx_aap_button"
                              data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading"
                              type="submit"><?=$this->lang->line('submit');?></button>
                        </div>
                        <?php echo form_close() ?>
                     </div>
                     <div class="card">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="table-responsive">
                                    <table id="a_product_data" class="table table-striped table-bordered" style="width:100%">
                                       <thead>
                                          <tr>
                                             <th> Sr. No.</th>
                                             <th> Product Name</th>
                                             <th> Product Price</th>
                                             <th> Product Description</th>
                                             <th> Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Modal HTML -->
            <div id="a_category_delete_modal" class="modal fade">
               <div class="modal-dialog modal-confirm">
                  <div class="modal-content">
                     <div class="modal-header flex-column">
                        <!-- <div class="icon-box">
                           <i class="material-icons">&#xE5CD;</i>
                           </div> -->
                        <h4 class="modal-title">Are you sure?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     </div>
                     <div class="modal-body">
                        <p>Do you really want to delete these records? This process cannot be undone.</p>
                     </div>
                     <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <form method="POST" id="delete-form">
                           <input type="hidden" name="delete_domain_id" id="delete_domain_id">
                           <button class="btn btn-primary" id="hlx_addel_button"
                              data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading"
                              type="submit">Delete</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Template Edit Model  -->
            <div class="modal fade" id="a_category_edit_modal">
               <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                     <!-- Modal Header -->
                     <div class="modal-header">
                        <h4 class="modal-title">Edit Category </h4>
                        <button type="button" class="close" id="close_pricing" data-dismiss="modal">&times;</button>
                     </div>
                     <!-- Modal body -->
                     <?php echo form_open('admin/update_new_category', array('id' => 'a_update_new_category_form')) ?>
                     <div class="modal-body">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group required">
                                 <input type="hidden" name="a_edit_category_id" id="a_edit_category_id">
                                 <label
                                    class="form-control-label"><?=$this->lang->line('category_name');?></label>
                                 <input type="text" class="form-control" placeholder="<?=$this->lang->line('category_name');?>" name="a_edit_category_name" id="a_edit_category_name">
                                 <span class="error_msg" id="a_edit_category_name_error"></span>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <div class="kit_img img-thumbnail" id="a_edit_display_category_image"> </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group ">
                                 <label class="form-control-label"><?=$this->lang->line('category_image');?></label>
                                 <input class="form-control" type="file" name="a_edit_category_image" id="a_edit_category_image" >
                                 <span class="error_msg" id="a_edit_category_image_error"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button class="btn btn-primary" id="hlx_acupdate_button"
                           data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading"
                           type="submit"><?=$this->lang->line('submit');?></button>
                     </div>
                     <?php echo form_close() ?>
                  </div>
               </div>
            </div>
            <!-- Model PDF Viewer  -->
            <div class="modal fade" id="a_category_view_modal">
               <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                     <!-- Modal Header -->
                     <div class="modal-header">
                        <h4 class="modal-title">View Category </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <!-- Modal body -->
                     <div class="modal-body">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="form-control-label"><?=$this->lang->line('category_name');?></label>
                                 <br>
                                 <span id="a_view_category_name"></span>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="form-control-label"><?=$this->lang->line('category_image');?></label>
                                 <div class="kit_img img-thumbnail" id="a_view_display_category_image"> </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Modal HTML -->
            <div id="a_product_delete_modal" class="modal fade">
               <div class="modal-dialog modal-confirm">
                  <div class="modal-content">
                     <div class="modal-header flex-column">
                        <!-- <div class="icon-box">
                           <i class="material-icons">&#xE5CD;</i>
                           </div> -->
                        <h4 class="modal-title">Are you sure?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     </div>
                     <div class="modal-body">
                        <p>Do you really want to delete these records? This process cannot be undone.</p>
                     </div>
                     <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <form method="POST" id="delete-form">
                           <input type="hidden" name="delete_domain_id" id="delete_domain_id">
                           <button class="btn btn-primary" id="hlx_addel_button"
                              data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading"
                              type="submit">Delete</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Template Edit Model  -->
            <div class="modal fade" id="a_product_edit_modal">
               <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                     <!-- Modal Header -->
                     <div class="modal-header">
                        <h4 class="modal-title">Edit Product </h4>
                        <button type="button" class="close" id="close_pricing" data-dismiss="modal">&times;</button>
                     </div>
                     <!-- Modal body -->
                     <?php echo form_open('admin/update_product', array('id' => 'a_update_product_form')) ?>
                     <div class="modal-body">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group required">
                                 <input type="hidden" name="a_edit_product_id" id="a_edit_product_id">
                                 <label
                                    class="form-control-label"><?=$this->lang->line('select');?> <?=$this->lang->line('product_name');?></label>
                                 <input type="text" class="form-control" placeholder="<?=$this->lang->line('product_name');?>" name="a_edit_product_name" id="a_edit_product_name">
                                 <span class="error_msg" id="a_edit_product_name_error"></span>
                              </div>
                           </div>
                           <div class="col-md-4">
                                 <div class="form-group required">
                                    <label
                                       class="form-control-label">Product Price</label>
                                    <input type="text" class="form-control" placeholder="Product Price" name="a_edit_product_price"  id="a_edit_product_price">
                                    <span class="error_msg" id="a_edit_product_price_error"></span>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group required">
                                    <label
                                       class="form-control-label">Product Description</label>
                                    <textarea class="form-control" name="a_edit_product_description" id="a_edit_product_description"></textarea>
                                    <span class="error_msg" id="a_edit_product_description_error"></span>
                                  
                                 </div>
                              </div>
                          
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group ">
                                 <label class="form-control-label"><?=$this->lang->line('product_image');?></label>
                                 <input class="form-control" type="file" name="a_edit_product_image[]" id="a_edit_product_image" multiple="multiple">
                                 <span class="error_msg" id="a_edit_product_image_error"></span>
                              </div>
                           </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                 <input type="hidden" name="old_image" id="old_image">
                                 <div id="a_edit_display_product_image"> </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button class="btn btn-primary" id="hlx_apupdate_button"
                           data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading"
                           type="submit"><?=$this->lang->line('submit');?></button>
                     </div>
                     <?php echo form_close() ?>
                  </div>
               </div>
            </div>
            <!-- Model PDF Viewer  -->
            <div class="modal fade" id="a_product_view_modal">
               <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                     <!-- Modal Header -->
                     <div class="modal-header">
                        <h4 class="modal-title">View Product </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <!-- Modal body -->
                     <div class="modal-body">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="form-control-label">Product Name</label>
                                 <br>
                                 <span id="a_view_product_name"></span>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="form-control-label">Product Price</label>
                                 <br>
                                 <span id="a_view_product_price"></span>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="form-control-label">Product Description</label>
                                 <br>
                                 <span id="a_view_product_description"></span>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <label class="form-control-label">Product Image</label>
                              <div id="a_view_display_product_image"> </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php include 'common/admin_jsfiles.php';?>
      <script src="<?= base_url();?>assets/view_js/admin/add_product.js"></script>
   </body>
</html>