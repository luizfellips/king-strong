@props(['results', 'percentOfRelativeIntensity'])

<table class="bg-white w-full w-100 shadow-md rounded-xl table-auto">
    <thead>
        <tr class="bg-blue-gray-100 text-xs sm:text-base text-gray-700 table-row">
            <th class="py-3 px-4 text-left">Carga Aprox.</th>
            <th class="py-3 px-4 text-left">Repetições</th>
            <th class="py-3 px-4 text-left">%1RM</th>
        </tr>
    </thead>
    <tbody class="text-blue-gray-900">
        @foreach ($results as $key => $value)
            <tr
                class="border-b text-xs sm:text-base text-center border-blue-gray-200 {{ $key == $percentOfRelativeIntensity ? 'bg-red-500 text-white' : '' }}">
                <td class="py-3 px-4">{{ $value - 1 }}kg - {{ $value + 1 }}kg</td>
                <td class="py-3 px-4">{{ $loop->last ? 15 : $loop->index + 1 }} </td>
                <td class="py-3 px-4">{{ $key }}%</td>
            </tr>
        @endforeach
    </tbody>
</table>
