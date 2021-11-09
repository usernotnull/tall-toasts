<div
    class="overflow-hidden z-50 p-5 bg-white rounded-md border-l-8 shadow cursor-pointer pointer-events-auto select-none hover:bg-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800"
    x-bind:class="{
                    'border-blue-700': toast.type === 'info',
                    'border-green-700': toast.type === 'success',
                    'border-yellow-700': toast.type === 'warning',
                    'border-red-700': toast.type === 'danger'
                }"
>
    <div class="flex justify-between items-center space-x-5">
        <div class="flex-1 mr-2">
            <div
                class="mb-1 font-black text-lg tracking-widest text-gray-900 uppercase font-large dark:text-gray-100"
                x-html="toast.title"
            ></div>

            <div
                class="text-gray-900 dark:text-gray-200" x-html="toast.message"
            ></div>
        </div>

        @include('tall-toasts::includes.icon')
    </div>
</div>
