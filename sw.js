self.addEventListener('push', function(event) {
    event.waitUntil(self.registration.showNotification('ServiceWorker Cookbook', {
        body: 'A user has commented on your video.',
      })
    );
  });