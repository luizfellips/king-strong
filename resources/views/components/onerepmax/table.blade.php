@props(['results', 'percentOfRelativeIntensity'])

<table class="background w-full w-100 shadow-md rounded-2xl table-auto">
    <thead>
        <tr class=" bg-transparent border rounded-xl border-red-500 text-red-500 text-center text-xs sm:text-base table-row">
            <th class="py-3 px-4 text-center">Carga Aprox.</th>
            <th class="py-3 px-4 text-center">Repetições</th>
            <th class="py-3 px-4 text-center">%1RM</th>
        </tr>
    </thead>
    <tbody class="text-blue-gray-900">
        @foreach ($results as $key => $value)
            <tr
                class="text-white text-xs sm:text-base text-center border-blue-gray-200 {{ $key == $percentOfRelativeIntensity ? 'bg-red-700 text-white' : 'bg-transparent' }}">
                <td class="py-3 px-4">{{ $value - 1 }}kg - {{ $value + 1 }}kg</td>
                <td class="py-3 px-4">{{ $loop->last ? 15 : $loop->index + 1 }} </td>
                <td class="py-3 px-4">{{ $key }}%</td>
            </tr>
        @endforeach
    </tbody>
</table>
