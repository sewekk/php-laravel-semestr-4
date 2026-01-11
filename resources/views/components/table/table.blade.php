<div class="w-full overflow-hidden rounded-lg">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
            <tr class="text-xs font-semibold text-left! tracking-wide text-gray-500 uppercase border-b border-gray-100 bg-gray-50/50">
                {{ $header }}
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
            {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
