
function swal_eliminar(){
swal({   title: "¿Estás seguro?", 
   text: "You will not be able to recover this imaginary file!",  
   type: "warning", 
   showCancelButton: true,  
   confirmButtonColor: "#DD6B55", 
   confirmButtonText: "Si, Eliminar!",   
   cancelButtonText: "No, Cancelar!",   
   closeOnConfirm: false,  
    closeOnCancel: false 
},

 function(isConfirm){ 
   if (isConfirm) {     
   	swal("Deleted!", "Your imaginary file has been deleted.", "success");   
   } else {    
    swal("Cancelled", "Your imaginary file is safe :)", "error"); 
      }
       });

}

