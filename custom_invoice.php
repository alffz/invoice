<?php 
   session_start();
   include('header.php');
   include 'Invoice.php';
   $invoice = new Invoice();
   $invoice->checkLoggedIn();
   if(!empty($_POST['companyName']) && $_POST['companyName']) {	
   	$invoice->saveInvoice($_POST);
   	header("Location:invoice_list.php");	
   }
   ?>
<title>Invoice System</title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>
<div class="container-fluid">
   <div class="cards">
     <div class="card-bodys">
       <form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate="">
      <div class="load-animate animated fadeInUp">
         <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
               <h2 class="title">PHP Invoice System</h2>
               <?php include('menu.php');?> 
            </div>
         </div>
         <input id="currency" type="hidden" value="$">
         <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
               <h3>From,</h3>
               <?php echo $_SESSION['user']; ?><br> 
               <?php echo $_SESSION['address']; ?><br>  
               <?php echo $_SESSION['mobile']; ?><br>
               <?php echo $_SESSION['email']; ?><br>  
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
               <h3>To,</h3>
               <div class="form-group">
                  <input type="text" class="form-control" name="companyName" id="companyName" placeholder="Company Name" autocomplete="off">
               </div>
               <div class="form-group">
                  <textarea class="form-control" rows="3" name="address" id="address" placeholder="Your Address"></textarea>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
               <table class="table table-condensed table-striped" id="invoiceItem">
                  <tr>
                  <th width="2%">
                      <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="checkAll" name="checkAll">
                        <label class="custom-control-label" for="checkAll"></label>
                        </div>
                    </th>
                     <th width="20%">Pelanggan</th>
                     <th width="5%">Bayar</th>
                     <th width="5%">Bayar Hutang</th>
                     <th width="5%">Hutang</th>
                     <th width="5%">Bayar Kupon</th>
                     <th width="5%">BHK</th>
                     <th width="11%">Harga</th>
                     <th width="11%">Rp</th>
                  </tr>
                  <tr>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="itemRow custom-control-input" id="itemRow_1">
                        <label class="custom-control-label" for="itemRow_1"></label>
                        </div></td>
                     <td><input type="text"   name="pelanggan[]" id="pelanggan_1" class="form-control pelanggan" autocomplete="off" ></td>
                     <td><input type="number" name="bayar[]"     id="bayar_1"     class="form-control" autocomplete="off" value="0"></td>
                     <td><input type="number" name="bHutang[]"   id="bHutang_1"   class="form-control" autocomplete="off" value="0"></td>
                     <td><input type="number" name="hutang[]"    id="hutang_1"    class="form-control" autocomplete="off" value="0"></td>
                     <td><input type="number" name="bKupon[]"    id="bKupon_1"    class="form-control" autocomplete="off" value="0"></td>
                     <td><input type="number" name="BHK[]"       id="BHK_1"       class="form-control" autocomplete="off" value="0"></td>
                     <td><input type="number" disabled name="harga[]"     id="harga_1"     class="form-control" value="0"></td>
                     <td><input type="number" name="total[]"     id="total_1"     class="form-control" autocomplete="off" value="0"></td>
                  </tr>
               </table>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-12">
               <button class="btn btn-danger delete" id="removeRows" type="button">- Delete</button>
               <button class="btn btn-success" id="addRows" type="button">+ Add More</button>
            </div>
         </div>
         <div class="row">
          <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
            <div class="form-group mt-3 mb-3 ">
              <label>Kupon: &nbsp;</label>
                 <div class="input-group mb-3">
            <input value="" type="number" class="form-control" name="kupon" id="kupon" >
          </div>
              </div>
          </div>
          <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
            <div class="form-group mt-3 mb-3 ">
              <label>Galon: &nbsp;</label>
                 <div class="input-group mb-3">
           <input value="" type="number" class="form-control" name="galon" id="galon" >
          </div>
              </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
            <div class="form-group mt-3 mb-3 ">
              <label>Total Rp : &nbsp;</label>
              <div class="input-group mb-3">
                <input value="" type="number" class="form-control" name="total" id="total" >
              </div>
            </div>
          </div>
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
               <h3>Notes: </h3>
               <div class="form-group">
                  <textarea class="form-control txt" rows="2" name="notes" id="notes" placeholder="Your Notes"></textarea>
               </div>
               <br>
               <div class="form-group">
                  <input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
                  <input data-loading-text="Saving Invoice..." type="submit" name="invoice_btn" value="Save Invoice" class="btn btn-success submit_btn invoice-save-btm">           
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
      </div>
   </form>
     </div>
   </div>
</div>
</div>	
<?php include('footer.php');?>