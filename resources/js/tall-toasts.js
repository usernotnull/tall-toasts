export default function (Alpine) {
  Alpine.data('ToastComponent',
    ($wire) => ({
      defaultDuration: $wire.defaultDuration,
      wireToasts: $wire.$entangle('toasts'),
      prod: $wire.$entangle('prod'),
      wireToastsIndex: 0,
      toasts: [],
      pendingToasts: [],
      pendingRemovals: [],
      count: 0,
      loaded: false,

      init () {
        window.Toast = {
          component: this,

          make: (message, title, type, duration) => ({ title, message, type, duration }),

          debug (message, title = '', duration = undefined) {
            this.component.add(this.make(message, title, 'debug', duration ?? this.component.defaultDuration));
          },

          info (message, title = '', duration = undefined) {
            this.component.add(this.make(message, title, 'info', duration ?? this.component.defaultDuration));
          },

          success (message, title = '', duration = undefined) {
            this.component.add(this.make(message, title, 'success', duration ?? this.component.defaultDuration));
          },

          warning (message, title = '', duration = undefined) {
            this.component.add(this.make(message, title, 'warning', duration ?? this.component.defaultDuration));
          },

          danger (message, title = '', duration = undefined) {
            this.component.add(this.make(message, title, 'danger', duration ?? this.component.defaultDuration));
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
        this.wireToasts.forEach((toast, i) => {
          if (i < this.wireToastsIndex) {
            return;
          }

          this.add(window.Alpine.raw(toast));

          this.wireToastsIndex++;
        });
      },

      add (toast) {
        if (this.loaded !== true) {
          this.pendingToasts.push(toast);

          return;
        }

        if (toast.type === 'debug') {
          if (this.prod) {
            return;
          }

          console.log(toast.title, toast.message);
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

        if (this.toasts[toastIndex].duration === 0) {
          return;
        }

        this.pendingRemovals[toastIndex] = setTimeout(() => {
          this.remove(toastIndex);
        }, this.toasts[toastIndex].duration);
      },

      scheduleRemovalWithOlder (toastIndex = this.count) {
        for (let i = 0; i < toastIndex; i++) {
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
