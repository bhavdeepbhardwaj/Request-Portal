<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="rejectModal">Reject SRN : ADNESEA{{ $num = sprintf('%03d', intval($ticket_detail->no))}}</h5> 

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">

                    <form class="form-horizontal" role="form" method="POST" action="/reject_request/{{$ticket_detail->no}}"  enctype="multipart/form-data" >

                        {!! csrf_field() !!}
                                
                       
                       <div class="form-group{{ $errors->has('reason') ? ' has-error' : '' }}">
                       <input type="hidden" name="reject" value="Rejected">
                            <label for="reason" class="col-md-10 control-label">Please select any one Reason for Reject the Request</label>

                            <div class="col-md-10">
                                  <span><input type="radio" name="reason" group="reject" value="duplicate"/><strong> Duplicate Request</strong> </span><br/>
                                  <span> <input type="radio" name="reason" group="reject" value="out of scope"/><strong> Out of Scope</strong> </span><br/>
                                  <span> <input type="radio" name="reason" group="reject" value="other"/> <strong>Other</strong> </span>
                                @if ($errors->has('reason'))
                                    <span class="help-block">
                                    <strong><span class="error">Reason Can Not Be Empty</span></strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                   
       
                        <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
                            <label for="comments" class="col-md-10 control-label">Please Specify Your Reason</label>

                            <div class="col-md-10">
                                <textarea rows="4" id="comments" class="form-control" name="comments"></textarea>

                                @if ($errors->has('comments'))
                                    <span class="help-block">
                                    <strong><span class="error">Brief Field Can Not Be Empty</span></strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                     
                     
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-ticket"></i> Submit Request
                                </button>
                            </div>
                        </div>
                    </form>
             </div>
        </div>
    </div>
</div>