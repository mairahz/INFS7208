
function urlBase64ToUint8Array(base64String) {
  const padding = '='.repeat((4 - base64String.length % 4) % 4);
  const base64 = (base64String + padding)
      .replace(/\-/g, '+')
      .replace(/_/g, '/');

  const rawData = window.atob(base64);
  const outputArray = new Uint8Array(rawData.length);

  for (var i = 0; i < rawData.length; ++i) {
      outputArray[i] = rawData.charCodeAt(i);
  }
  return outputArray;
} 

function checkPermission() {
  if (Notification.permission !== 'granted') {
    Notification.requestPermission();
  }
}

function onNotifs(){
  checkPermission();
  if (Notification.permission == 'granted') {
    navigator.serviceWorker.ready.then(async function(registration) {
      const response = await fetch('/MeTube/public_key.txt');
      const vapidPublicKey = await response.text();
      const convertedVapidKey = urlBase64ToUint8Array(vapidPublicKey);
      var options = {
        userVisibleOnly: true,
        applicationServerKey: convertedVapidKey
      };
      registration.pushManager.subscribe(options).then(function(subscription){
        // console.log('Subscribed', subscription);
        $.post('subscribe', {subscription: JSON.stringify(subscription)}, function(data){
          return(data);
        });
        new Notification('Notifications turned on!', {
          body: 'Hey there! You have turned on notifications for this site.',
        });
      });
    });
  }
}

function notifyComment(username){
  $.post('../Notification/commentNotif', {username: username}, function(data){
    console.log(data);
    // var subscription = JSON.parse(data);
    // webPush.sendNotification(subscription);
  });
  // webPush.sendNotification(subscription)
}

