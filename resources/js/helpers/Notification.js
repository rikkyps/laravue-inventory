class Notification{

  success(msg){
    new Noty({
      type: 'success',
      layout: 'topRight',
      text: msg,
      timeout: 1000
    }).show();
  }

  alert(){
    new Noty({
      type: 'alert',
      layout: 'topRight',
      text: 'Are you sure?',
      timeout: 1000
    }).show();
  }

  error(msg){
    new Noty({
      type: 'error',
      layout: 'topRight',
      text: msg,
      timeout: 1000
    }).show();
  }

  warning(){
    new Noty({
      type: 'warning',
      layout: 'topRight',
      text: 'Opps Wrong',
      timeout: 1000
    }).show();
  }

  imageValidation(){
    new Noty({
      type: 'error',
      layout: 'topRight',
      text: 'Size file lebih dari 1Mb',
      timeout: 1000
    }).show();
  }

}

export default Notification = new Notification()