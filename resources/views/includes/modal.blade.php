<!----  MODAL  ---->

<div class="modal" id="confirm">
        <div class="modal-dialog">
            <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Delete image</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        
            <!-- Modal body -->
            <div class="modal-body">
                Are you sure?
            </div>
        
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancel</button>
                <a href="{{Route('image.delete', ['id' => $image->id])}}" class="btn btn-dark">Delete</a> 
            </div>
        
            </div>
        </div>
    </div>