<button class="btn btn-danger delBtn" data-toggle="modal" data-target="#multiDelete"> Delete All</button>
<!-- Modal -->
<div id="multiDelete" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title">Delete All</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger">

       <div class="empty_delete">
         <h3 class="text-center">Not Found Data To Delete</h3>
       </div>

       <div class="full_delete">
            <h3 class="text-center">Do You Suare Delete This Count :  <span class="delete_count"></span></h3>
        </div>

        </div>
      </div>
      <div class="modal-footer">
      <div class="empty_delete">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

  <div class="full_delete">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <input type="submit" name="del_all" value="Yes" class="btn btn-danger del_all">
   </div>

      </div>
    </div>

  </div>
</div>
