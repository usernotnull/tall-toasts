<template x-if="toast.type==='info'">
    <svg
        class="w-8 h-8 text-blue-700"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 192 512"
    >
        <path
            fill="currentColor"
            fill-opacity="0.5"
            d="M20 448h152a20 20 0 0 1 20 20v24a20 20 0 0 1-20 20H20a20 20 0 0 1-20-20v-24a20 20 0 0 1 20-20z"
        />
        <path
            fill="currentColor"
            d="M96 128a64 64 0 1 0-64-64 64 64 0 0 0 64 64zm28 64H20a20 20 0 0 0-20 20v24a20 20 0 0 0 20 20h28v192h96V212a20 20 0 0 0-20-20z"
        />
    </svg>
</template>

<template x-if="toast.type==='success'">
    <svg
        class="w-8 h-8 text-green-700"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 512 512"
    >
        <path
            fill="currentColor"
            d="M435.848 83.466L172.804 346.51l-96.652-96.652c-4.686-4.686-12.284-4.686-16.971 0l-28.284 28.284c-4.686 4.686-4.686 12.284 0 16.971l133.421 133.421c4.686 4.686 12.284 4.686 16.971 0l299.813-299.813c4.686-4.686 4.686-12.284 0-16.971l-28.284-28.284c-4.686-4.686-12.284-4.686-16.97 0z"
        ></path>
    </svg>
</template>

<template x-if="toast.type==='warning'">
    <svg
        class="w-8 h-8 text-yellow-700"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 192 512"
    >
        <path
            fill="currentColor"
            fill-opacity="0.5"
            d="M49.22 0h93.56a24 24 0 0 1 24 25.2l-13.63 272a24 24 0 0 1-24 22.8H62.84a24 24 0 0 1-24-22.8l-13.59-272A24 24 0 0 1 49.22 0z"
        ></path>
        <path
            fill="currentColor"
            d="M96 512a80 80 0 1 1 80-80 80.09 80.09 0 0 1-80 80z"
        ></path>
    </svg>
</template>

<template x-if="toast.type==='danger'">
    <svg
        class="w-8 h-8 text-red-700"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 576 512"
    >
        <path
            fill="currentColor"
            fill-opacity="0.5"
            d="M569.52 440L329.58 24c-18.44-32-64.69-32-83.16 0L6.48 440c-18.42 31.94 4.64 72 41.57 72h479.89c36.87 0 60.06-40 41.58-72zM288 448a32 32 0 1 1 32-32 32 32 0 0 1-32 32zm38.24-238.41l-12.8 128A16 16 0 0 1 297.52 352h-19a16 16 0 0 1-15.92-14.41l-12.8-128A16 16 0 0 1 265.68 192h44.64a16 16 0 0 1 15.92 17.59z"
        ></path>
        <path
            fill="currentColor"
            d="M310.32 192h-44.64a16 16 0 0 0-15.92 17.59l12.8 128A16 16 0 0 0 278.48 352h19a16 16 0 0 0 15.92-14.41l12.8-128A16 16 0 0 0 310.32 192zM288 384a32 32 0 1 0 32 32 32 32 0 0 0-32-32z"
        ></path>
    </svg>
</template>
