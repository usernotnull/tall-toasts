import toast from '../resources/js/tall-toasts';

document.addEventListener('alpine:initializing', () => {
  toast(window.Alpine);
});
