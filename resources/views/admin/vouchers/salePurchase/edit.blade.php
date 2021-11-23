<div class="modal-header">
    <h5 class="modal-title">Update Sale/Purchase Voucher</h5>
    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
    </button>
</div>


    <div class="modal-body px-5">
        <div class="form-validation my-5">
            <form class="form-valide" id="update-form">
                @csrf
                @method('put')
                 <div class="row m-0 justify-content-between">
                     <div class="col-5 pl-0">
                         <div class="form-group row m-0 align-items-center">
                             <label class="col-lg-2 col-form-label px-0" for="val-date">Date<span class="text-danger">*</span></label>
                             <div class="col-lg-10">
                                 <input type="date" class="form-control" id="val-date" name="date" value="">
                             </div>
                         </div>
                     </div>
                 </div>


                 <div  id="editRow">
                
                    @if($voucher->voucherDetails->count()>0)

                        <div class="row mx-0 justify-content-between pt-5">
                            <div class="col-3 px-0">
                                <div class="form-group row m-0 align-items-center">
                                    <label class="col-lg-12 col-form-label px-0" for="val-account">Select Sub Account<span class="text-danger">*</span></label>
                                </div>
                            </div>
        
                            <div class="col-3 pr-0">
                                <div class="form-group row m-0 align-items-center">
                                    <label class="col-lg-12 col-form-label px-0" for="val-naration">Naration<span class="text-danger">*</span></label>
                                </div>
                            </div>
        
                            <div class="col-2 pr-0">
                                <div class="form-group row m-0 align-items-center">
                                    <label class="col-lg-12 col-form-label px-0" for="val-transaction-type">Transaction Type<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-2 pr-0">
                                <div class="form-group row m-0 align-items-center">
                                    <label class="col-lg-12 col-form-label px-0">Debit<span class="text-danger">*</span></label>
                                </div>
                            </div>
        
                            <div class="col-2 pr-0">
                                <div class="form-group row m-0 align-items-center">
                                    <label class="col-lg-12 col-form-label px-0">Credit<span class="text-danger">*</span></label>
                                </div>
                            </div>
        
                        </div>
    
                        @foreach ($voucher->voucherDetails as $key=>$detail)
                            
                            <div class="row mt-3 mx-0 justify-content-between position-relative w-100">
                                <input type="hidden" name="voucher_detail_ids[]" value="{{$detail->id}}">
                                <div class="col-3 px-0">
                                    <div class="form-group row m-0 align-items-center">
                                        <label></label>
                                        <div class="col-lg-12 pl-0 pr-2">
                                            <select name="accounts[]" id="val-account" class="form-control">
                                                <option disabled>Select sub account</option>
                                                @foreach ($subAccounts as $subAccount)
                                                    <option @if($subAccount->id==$detail->sub_account_id) selected @endif value="{{$subAccount->id}}">{{$subAccount->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="col-3 pr-0">
                                    <div class="form-group row m-0 align-items-center">
                                        <label class="col-lg-12 col-form-label px-0" for="val-balance">Product<span class="text-danger">*</span></label>
                                        <div class="col-lg-12 px-0">
                                            <select name="products[]" id="val-balance" class="form-control">
                                                <option disabled>Product</option>
                                                @foreach ($products as $product)
                                                    <option @if($detail->product_id==$product->id) selected @endif value="{{$product->id}}">{{$product->title."-".$product->narration}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="col-2 pr-0">
                                    <div class="form-group row m-0 align-items-center">
                                        <label></label>
                                        <div class="col-lg-12 pl-0 pr-2">
                                            <select name="transaction_types[]" id="val-transaction-type" class="form-control">
                                                <option disabled>Transaction type</option>
                                                <option @if($detail->transaction_type=="cash") selected @endif value="cash">Cash</option>
                                                <option @if($detail->transaction_type=="check") selected @endif value="check">Check</option>
                                                <option @if($detail->transaction_type=="bank_transfer") selected @endif value="bank_transfer">Bank transfer</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 pr-0">
                                    <div class="form-group row m-0 align-items-center">
                                        <label></label>
                                        <div class="col-lg-12 pl-0 pr-2 ">
                                            <input type="number" class="form-control commonDebit" @if($detail->debit_amount==0) readonly @endif value="{{$detail->debit_amount}}" oninput="disableCreditInput(this)" name="debits[]" placeholder="Debit...">
                                        </div>
                                    </div>
                                </div>
                
                                <div class="col-2 pr-0">
                                    <div class="form-group row m-0 align-items-center">
                                        <label></label>
                                        <div class="col-lg-12 pl-0 pr-2 ">
                                            <input type="number" class="form-control commonCredit" @if($detail->credit_amount==0) readonly @endif value="{{$detail->credit_amount}}" oninput="disableDebitInput(this)" name="credits[]" placeholder="Credit...">
                                        </div>
                                    </div>
                                </div>
            
                                @if($loop->iteration!=1 && $loop->iteration!=2)
                                    <div class="position-absolute" style="right:-44px;">
                                        <button type="button" onclick="removeParentElement(this)" class="btn btn-danger text-white">x</button>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                @endif

                 </div>



                 <div class="text-right pl-2 mt-3">
                     <button onclick="addNewRow('#editRow')" class="btn btn-light" type="button">Add more +</button>
                 </div>



                 <div class="row m-0 justify-content-end  mt-5">
                     <div class="col-4 px-0">
                         <div class="row m-0">
                             <div class="col-6 pr-0">
                                 <div class="form-group row m-0 align-items-center">
                                     <label class="col-lg-12 col-form-label px-0" for="debit-amount">Total Debit<span class="text-danger">*</span></label>
                                     <div class="col-lg-12 pl-0 pr-2 ">
                                         <input type="number" class="form-control" id="debit-amount" name="debit_total" value="0" readonly>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-6 pr-0">
                                 <div class="form-group row m-0 align-items-center">
                                     <label class="col-lg-12 col-form-label px-0" for="credit-amount">Total Credit<span class="text-danger">*</span></label>
                                     <div class="col-lg-12 pl-0 pr-2 ">
                                         <input type="number" class="form-control" id="credit-amount" name="credit_total" value="0" readonly>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>


            </form>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger text-white" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="commonFunction(false,'{{ route('salePurchase.update',$sale_purchase_voucher->id) }}','{{route('salePurchase.index')}}','post','','update-form');">Update</button>
     </div>

<script>



</script>
