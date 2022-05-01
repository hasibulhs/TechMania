@extends('master')
@section("content")
<div class="container">
    
    <!--  Button to launch the modal -->
    <h3>Launch Modal</h3>
    <p>This example will launch a modal when you click on the button below.</p>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Show Modal</button>
    <button type="button" id="jsModal" class="btn btn-primary">JavaScript Call Modal</button>
    
    <!--  Modal content --> 
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Header -->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Title</h4>
          </div>
          <!--  Body --> 
          <div class="modal-body">
            <p>Modal body text will go here.</p>
          </div>
          <!-- Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div> <!-- Footer End -->
        </div> <!-- Content end -->
       </div> <!-- Dialog end -->
    </div> <!-- Modal end -->
    <!--  End modal content --> 
    
  </div>
@endsection