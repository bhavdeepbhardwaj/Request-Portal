<div class="modal fade" id="revisionModal" tabindex="-1" role="dialog" aria-labelledby="revisionModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="revisionModal">Revision for ADNESEA{{ $num = sprintf('%03d', intval($ticket_detail->no))}}</h5> 

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">

                    <form class="form-horizontal" role="form" method="POST" action="/new_revision/{{$ticket_detail->no}}"  enctype="multipart/form-data" >

                        {!! csrf_field() !!}
                                
                       
                       <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
                            <label for="comments" class="col-md-10 control-label">Comments</label>

                            <div class="col-md-10">
                                <textarea rows="4" id="comments" class="form-control" name="comments"></textarea>

                                @if ($errors->has('comments'))
                                    <span class="help-block">
                                    <strong><span class="error">Comments Brief Field Can Not Be Empty</span></strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                   
                        <div class="form-group{{ $errors->has('reference') ? ' has-error' : '' }}">
                            <label for="reference" class="col-md-10 control-label">Reference File Upload</label>

                            <div class="col-md-10">
                                <input id="reference" type="file" class="form-control" name="reference" value="{{ old('reference') }}">
                                <p class="files">Supported file format: jpg, jpeg, png, pdf, xlsx, xlx, ppt, pptx, csv, zip</p>    
                               @if ($errors->has('reference'))
                                    <span class="help-block">
                                    <strong><span class="error">{{ $errors->first('reference') }}</span></strong>
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