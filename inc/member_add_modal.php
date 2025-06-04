 <!-- The Modal for add new form -->
              <div class="modal fade bd-example-modal-xl myModal" id="myModal">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary">
                      <h4 class="modal-title">Add New customer</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                      <div class="alert alert-primary alert-dismissible fade show memberFormError" role="alert">
                        <span id="memberFormError"></span>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                        <form id="adMemberForm">
                          <div class="row">
                            <div class="col-md-6 col-md-6">
                          <div class="form-group">
                            <label for="name">Customer Name *:</label>
                            <input type="text" class="form-control add-member" id="name" placeholder="Customer's name" name="name">
                          </div>
                          </div>
                          <div class="col-md-6 col-md-6">
                          <div class="form-group">
                            <label for="company"> Business Name:</label>
                            <input type="text" class="form-control add-member" id="company" placeholder="Customer's Business name" name="company">
                          </div>
                        </div>
                         <div class="col-md-6 col-md-6">
                          <div class="form-group">
                            <label for="contact">Contact number:</label>
                            <input type="text" class="form-control add-member" id="contact" placeholder="Contact number" name="contact">
                          </div>
                        </div>
                        <div class="col-md-6 col-md-6">
                          <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control add-member" id="email" placeholder="Email optional" name="email">
                          </div>
                        </div>
                          <div class="col-md-6 col-lg-6">
                          <div class="form-group">
                          <label for="cus_open_blacnce">Previous due:</label>
                          <input type="number" class="form-control" name="cus_open_blacnce" id="cus_open_blacnce" value="0.00">
                         </div>
                       </div>
                       <div class="col-md-6 col-md-6">
                          <div class="form-group">
                            <label for="reg_date">Registration Date:</label>
                            <input type="date" class="form-control add-member" id="reg_date" name="reg_date">
                          </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                           <div class="form-group">
                            <label for="address">Address:</label>
                            <textarea rows="3" class="form-control" placeholder="Customer's Address" id="address" name="address"></textarea>
                           </div>
                        </div>
                          </div>
                          <button type="submit" class="btn btn-primary btn-block rounded-0">Add customer</button>
                         </form>
                        <!-- </div> -->
                      </div>
                   
                    </div>
                  </div>
                </div>