
class Notification{

    success(){
        new Noty({
            type: 'success',
            text: 'Successfully Done',
            layout : "topRight",
            timeout : 1000
           
        }).show();
    }

    alert(){
        new Noty({
            type: 'alert',
            text: 'Are you sure',
            layout : "topRight",
            timeout : 1000
           
        }).show();
    }

    error(){
        new Noty({
            type: 'error',
            text: 'Something went Wrong !',
            layout : "topRight",
            timeout : 1000
           
        }).show();
    }
    
    warning(){
        new Noty({
            type: 'warning',
            text: 'Oops ! wrong',
            layout : "topRight",
            timeout : 1000
           
        }).show();
    }

    image_validation(){
        new Noty({
            type: 'error',
            text: 'Upload image less then 1mb',
            layout : "topRight",
            timeout : 1000
           
        }).show();
    }
   
}
export default Notification=new Notification();