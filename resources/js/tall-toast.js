export default function (Alpine) {
  Alpine.data('ToastComponent',
    ($wire) => ({
      duration: $wire.duration,
      wireToasts: $wire.entangle('toasts'),
      toasts: [],
      pendingToasts: [],
      pendingRemovals: [],
      count: 0,
      loaded: false,

      init () {
        window.Toast = {
          component: this,

          make: (message, title, type) => ({ title, message, type }),

          info (message, title = '') {
            this.component.add(this.make(message, title, 'info'));
          },

          success (message, title = '') {
            this.component.add(this.make(message, title, 'success'));
          },

          warning (message, title = '') {
            this.component.add(this.make(message, title, 'warning'));
          },

          danger (message, title = '') {
            this.component.add(this.make(message, title, 'danger'));
          }
        };

        addEventListener('toast', (event) => {
          this.add(event.detail);
        });

        this.fetchWireToasts();

        this.$watch('wireToasts', () => {
          this.fetchWireToasts();
        });

        setTimeout(() => {
          this.loaded = true;
          this.pendingToasts.forEach((toast) => {
            this.add(toast);
          });
          this.pendingToasts = null;
        }, $wire.loadDelay);
      },

      fetchWireToasts () {
        this.wireToasts.forEach((toast) => {
          this.add(window.Alpine.raw(toast));
        });
        if (this.wireToasts.length > 0) {
          $wire.set('toasts', []);
        }
      },

      add (toast) {
        if (this.loaded !== true) {
          this.pendingToasts.push(toast);

          return;
        }

        toast.type ??= 'info';
        toast.show = 0;
        toast.index = this.count;

        this.toasts[this.count] = toast;

        this.scheduleRemoval(this.count);

        this.count++;
      },

      scheduleRemoval (toastIndex) {
        if (Object.keys(this.pendingRemovals).includes(toastIndex.toString())) {
          return;
        }

        this.pendingRemovals[toastIndex] = setTimeout(() => {
          this.remove(toastIndex);
        }, this.duration);
      },

      scheduleRemovalWithOlder (toastIndex = this.count) {
        for (let i = 0; i <= toastIndex; i++) {
          this.scheduleRemoval(i);
        }
      },

      cancelRemovalWithNewer (toastIndex) {
        for (let i = this.count - 1; i >= toastIndex; i--) {
          clearTimeout(this.pendingRemovals[i]);
          delete this.pendingRemovals[i];
        }
      },

      remove (index) {
        if (this.toasts[index]) {
          this.toasts[index].show = 0;
        }

        setTimeout(() => {
          this.toasts[index] = '';
          delete this.pendingRemovals[index];
        }, 500);
      }

    })
  );
}
