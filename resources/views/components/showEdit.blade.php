<!-- resources/views/components/modal.blade.php -->
<div
    x-show="showEdit"
    x-transition
    class="fixed inset-0 z-50 bg-white/30 backdrop-blur-md flex items-center justify-center"
    style="display: none;"
>
    <div
        @click.outside="showEdit = false"
        @keydown.escape.window="showEdit = false"
        class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-[700px] p-8"
    >
        <h2 class="text-lg font-semibold mb-4" x-text="modalTitle"></h2>
        {{ $slot }}

       
    </div>
</div>
