import toast from '../resources/js/tall-toast';

document.addEventListener('alpine:initializing', () => {
  toast(window.Alpine);
});
